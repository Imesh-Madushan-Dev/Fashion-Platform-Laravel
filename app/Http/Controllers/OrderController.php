<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Design;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of orders for the authenticated buyer.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $buyer = Auth::guard('buyer')->user();
        $orders = $buyer->orders()
            ->with(['design', 'design.designer'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('buyer.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\View\View
     */
    public function create(Design $design)
    {
        // Ensure the design is active and available
        if (!$design->is_active) {
            return redirect()->back()->with('error', 'This design is not available for purchase.');
        }

        $design->load('designer');
        
        return view('buyer.order-create', compact('design'));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'design_id' => 'required|exists:designs,id',
            'quantity' => 'required|integer|min:1|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        $design = Design::findOrFail($request->design_id);
        $buyer = Auth::guard('buyer')->user();

        // Check if design is still active
        if (!$design->is_active) {
            return redirect()->back()->with('error', 'This design is no longer available for purchase.');
        }

        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'buyer_id' => $buyer->id,
                'design_id' => $design->id,
                'quantity' => $request->quantity,
                'unit_price' => $design->price,
                'total_amount' => $design->price * $request->quantity,
                'status' => Order::STATUS_PENDING,
                'notes' => $request->notes,
                'ordered_at' => now(),
            ]);

            DB::commit();

            return redirect()
                ->route('buyer.orders.show', $order)
                ->with('success', 'Order placed successfully! Your order is now pending confirmation.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to place order. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $buyer = Auth::guard('buyer')->user();

        // Ensure the order belongs to the authenticated buyer
        if ($order->buyer_id !== $buyer->id) {
            abort(403, 'Unauthorized access to this order.');
        }

        $order->load(['design', 'design.designer']);

        return view('buyer.order-detail', compact('order'));
    }

    /**
     * Cancel the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Order $order)
    {
        $buyer = Auth::guard('buyer')->user();

        // Ensure the order belongs to the authenticated buyer
        if ($order->buyer_id !== $buyer->id) {
            abort(403, 'Unauthorized access to this order.');
        }

        // Only allow cancellation of pending orders
        if ($order->status !== Order::STATUS_PENDING) {
            return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
        }

        try {
            $order->update(['status' => Order::STATUS_CANCELLED]);

            return redirect()
                ->route('buyer.orders.show', $order)
                ->with('success', 'Order cancelled successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel order. Please try again.');
        }
    }

    /**
     * Quick buy - directly create an order with default quantity.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quickBuy(Design $design)
    {
        $buyer = Auth::guard('buyer')->user();

        // Check if design is active
        if (!$design->is_active) {
            return redirect()->back()->with('error', 'This design is not available for purchase.');
        }

        try {
            DB::beginTransaction();

            // Create the order with quantity 1
            $order = Order::create([
                'buyer_id' => $buyer->id,
                'design_id' => $design->id,
                'quantity' => 1,
                'unit_price' => $design->price,
                'total_amount' => $design->price,
                'status' => Order::STATUS_PENDING,
                'ordered_at' => now(),
            ]);

            DB::commit();

            return redirect()
                ->route('buyer.orders.show', $order)
                ->with('success', 'Order placed successfully! Your order is now pending confirmation.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    /**
     * Get order statistics for the authenticated buyer.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStats()
    {
        $buyer = Auth::guard('buyer')->user();

        $stats = [
            'total_orders' => $buyer->orders()->count(),
            'pending_orders' => $buyer->orders()->where('status', Order::STATUS_PENDING)->count(),
            'completed_orders' => $buyer->orders()->where('status', Order::STATUS_COMPLETED)->count(),
            'total_spent' => $buyer->orders()->where('status', '!=', Order::STATUS_CANCELLED)->sum('total_amount'),
        ];

        return response()->json($stats);
    }
}