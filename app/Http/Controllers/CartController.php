<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Models\Order;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Get cart data as JSON
     */
    public function getCartData(Request $request)
    {
        try {
            $cartItems = $request->input('cartItems', []);
            $designIds = array_column($cartItems, 'id');
            
            if (empty($designIds)) {
                return response()->json([
                    'designs' => [],
                    'total' => 0
                ]);
            }

            $designs = Design::with('designer')
                ->whereIn('id', $designIds)
                ->active()
                ->get()
                ->keyBy('id');

            $cartData = [];
            $total = 0;

            foreach ($cartItems as $item) {
                $design = $designs->get($item['id']);
                if ($design) {
                    $subtotal = floatval($design->price) * intval($item['quantity']);
                    $cartData[] = [
                        'id' => $design->id,
                        'title' => $design->title,
                        'designer' => $design->designer ? $design->designer->name : 'Unknown Designer',
                        'price' => floatval($design->price),
                        'image_url' => $design->image_url,
                        'quantity' => intval($item['quantity']),
                        'subtotal' => $subtotal
                    ];
                    $total += $subtotal;
                }
            }

            return response()->json([
                'designs' => $cartData,
                'total' => $total
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Cart data error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load cart data',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process cart checkout - create orders for all cart items
     */
    public function processCheckout(Request $request)
    {
        try {
            // Validate buyer is authenticated
            if (!auth('buyer')->check()) {
                return response()->json([
                    'error' => 'Authentication required',
                    'message' => 'You must be logged in as a buyer to checkout'
                ], 401);
            }

            // Debug: Log the incoming cart data
            \Log::info('Cart checkout data received:', $request->all());

            $validator = \Validator::make($request->all(), [
                'cartItems' => 'required|array|min:1',
                'cartItems.*.id' => 'required|string',
                'cartItems.*.quantity' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                \Log::error('Cart validation failed:', $validator->errors()->toArray());
                return response()->json([
                    'error' => 'Validation failed',
                    'message' => 'Invalid cart data',
                    'errors' => $validator->errors()
                ], 422);
            }

            $cartItems = $request->input('cartItems', []);
            $buyer = auth('buyer')->user();
            $orders = [];
            $totalAmount = 0;
            $skippedItems = [];

            DB::beginTransaction();

            foreach ($cartItems as $item) {
                $designId = intval($item['id']);
                $design = Design::with('designer')->find($designId);
                
                if (!$design) {
                    $skippedItems[] = "Design with ID '{$designId}' not found";
                    \Log::warning("Skipped invalid design ID: {$designId}");
                    continue; // Skip this item instead of failing
                }
                
                if (!$design->is_active) {
                    $skippedItems[] = "Design '{$design->title}' is not available";
                    \Log::warning("Skipped inactive design: {$design->title} (ID: {$designId})");
                    continue; // Skip this item instead of failing
                }

                $quantity = intval($item['quantity']);
                $unitPrice = floatval($design->price);
                $subtotal = $quantity * $unitPrice;

                // Create order for each design
                $order = Order::create([
                    'buyer_id' => $buyer->id,
                    'design_id' => $design->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_amount' => $subtotal,
                    'status' => Order::STATUS_PENDING,
                    'ordered_at' => now(),
                    'notes' => $request->input('notes', null)
                ]);

                $orders[] = $order;
                $totalAmount += $subtotal;
            }

            // Check if we have any valid orders
            if (empty($orders)) {
                DB::rollback();
                return response()->json([
                    'error' => 'No valid items',
                    'message' => 'No valid designs found in cart',
                    'skipped_items' => $skippedItems
                ], 422);
            }

            DB::commit();

            $response = [
                'success' => true,
                'message' => 'Orders created successfully',
                'orders' => collect($orders)->map(function($order) {
                    return [
                        'id' => $order->id,
                        'total_amount' => $order->total_amount,
                        'status' => $order->status
                    ];
                }),
                'total_amount' => $totalAmount,
                'redirect_url' => route('buyer.payment.cart', ['orders' => collect($orders)->pluck('id')->implode(',')])
            ];

            // Include skipped items info if any
            if (!empty($skippedItems)) {
                $response['skipped_items'] = $skippedItems;
                $response['message'] .= '. Some items were skipped: ' . implode(', ', $skippedItems);
            }

            return response()->json($response);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Cart checkout validation error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Cart checkout error: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Checkout failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show cart payment page for multiple orders
     */
    public function showCartPayment(Request $request)
    {
        try {
            if (!auth('buyer')->check()) {
                return redirect()->route('buyer.login')
                    ->with('error', 'Please login to continue with payment.');
            }

            $orderIds = explode(',', $request->input('orders', ''));
            
            if (empty($orderIds)) {
                return redirect()->route('cart.index')
                    ->with('error', 'No orders found for payment.');
            }

            $orders = Order::with(['design', 'design.designer'])
                ->whereIn('id', $orderIds)
                ->where('buyer_id', auth('buyer')->id())
                ->where('status', Order::STATUS_PENDING)
                ->get();

            if ($orders->isEmpty()) {
                return redirect()->route('cart.index')
                    ->with('error', 'No valid orders found for payment.');
            }

            $totalAmount = $orders->sum('total_amount');

            return view('buyer.cart-payment', compact('orders', 'totalAmount'));

        } catch (\Exception $e) {
            \Log::error('Cart payment page error: ' . $e->getMessage());
            
            return redirect()->route('cart.index')
                ->with('error', 'Failed to load payment page.');
        }
    }

    /**
     * Process cart payment with dummy Stripe gateway
     */
    public function processCartPayment(Request $request)
    {
        try {
            if (!auth('buyer')->check()) {
                return redirect()->route('buyer.login')
                    ->with('error', 'Please login to continue with payment.');
            }

            $request->validate([
                'order_ids' => 'required|array|min:1',
                'order_ids.*' => 'exists:orders,id',
                'confirm_payment' => 'required|accepted',
            ]);

            $orderIds = $request->input('order_ids', []);
            
            $orders = Order::with(['design', 'design.designer'])
                ->whereIn('id', $orderIds)
                ->where('buyer_id', auth('buyer')->id())
                ->where('status', Order::STATUS_PENDING)
                ->get();

            if ($orders->isEmpty()) {
                return redirect()->route('cart.index')
                    ->with('error', 'No valid orders found for payment.');
            }

            DB::beginTransaction();

            // Simulate Stripe payment processing
            sleep(1); // Simulate processing time

            // Update all orders to paid status
            foreach ($orders as $order) {
                $order->update(['status' => Order::STATUS_PAID]);
            }

            DB::commit();

            // Clear cart from session/localStorage will be handled by frontend
            $totalAmount = $orders->sum('total_amount');

            return redirect()->route('buyer.payment.cart-success', [
                'orders' => $orders->pluck('id')->implode(',')
            ])->with('success', "Payment of $" . number_format($totalAmount, 2) . " processed successfully!");

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Cart payment processing error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Payment processing failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Show cart payment success page
     */
    public function showCartPaymentSuccess(Request $request)
    {
        try {
            if (!auth('buyer')->check()) {
                return redirect()->route('buyer.login');
            }

            $orderIds = explode(',', $request->input('orders', ''));
            
            if (empty($orderIds)) {
                return redirect()->route('buyer.orders.index')
                    ->with('error', 'No orders found.');
            }

            $orders = Order::with(['design', 'design.designer'])
                ->whereIn('id', $orderIds)
                ->where('buyer_id', auth('buyer')->id())
                ->where('status', Order::STATUS_PAID)
                ->get();

            if ($orders->isEmpty()) {
                return redirect()->route('buyer.orders.index')
                    ->with('error', 'No paid orders found.');
            }

            $totalAmount = $orders->sum('total_amount');

            return view('buyer.cart-payment-success', compact('orders', 'totalAmount'));

        } catch (\Exception $e) {
            \Log::error('Cart payment success page error: ' . $e->getMessage());
            
            return redirect()->route('buyer.orders.index')
                ->with('error', 'Failed to load success page.');
        }
    }
}