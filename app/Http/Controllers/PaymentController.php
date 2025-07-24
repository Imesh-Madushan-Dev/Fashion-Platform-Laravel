<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Show the payment page for a specific order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $buyer = Auth::guard('buyer')->user();

        // Ensure the order belongs to the authenticated buyer
        if ($order->buyer_id !== $buyer->id) {
            abort(403, 'Unauthorized access to this payment page.');
        }

        // Check if the order can be paid
        if (!$order->canBePaid()) {
            return redirect()
                ->route('buyer.orders.show', $order)
                ->with('error', 'This order cannot be paid. It may have already been paid or cancelled.');
        }

        // Load related data
        $order->load(['design', 'design.designer']);

        return view('buyer.payment', compact('order'));
    }

    /**
     * Process the dummy payment for an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(Request $request, Order $order)
    {
        $buyer = Auth::guard('buyer')->user();

        // Ensure the order belongs to the authenticated buyer
        if ($order->buyer_id !== $buyer->id) {
            abort(403, 'Unauthorized access to this payment.');
        }

        // Check if the order can be paid
        if (!$order->canBePaid()) {
            return redirect()
                ->route('buyer.orders.show', $order)
                ->with('error', 'This order cannot be paid. It may have already been paid or cancelled.');
        }

        // Validate the payment confirmation
        $request->validate([
            'confirm_payment' => 'required|accepted',
        ], [
            'confirm_payment.accepted' => 'You must confirm the payment to proceed.',
        ]);

        try {
            DB::beginTransaction();

            // Process the dummy payment by updating the order status
            $paymentSuccessful = $order->markAsPaid();

            if (!$paymentSuccessful) {
                throw new \Exception('Failed to process payment');
            }

            DB::commit();

            // Add debug info
            \Log::info('Payment processed successfully for order: ' . $order->id);

            // Redirect to success page
            return redirect()
                ->route('buyer.payment.success', $order)
                ->with('success', 'Payment processed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Add debug info
            \Log::error('Payment processing failed for order: ' . $order->id . ' - Error: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->with('error', 'Payment processing failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Show the payment success page.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function success(Order $order)
    {
        $buyer = Auth::guard('buyer')->user();

        // Ensure the order belongs to the authenticated buyer
        if ($order->buyer_id !== $buyer->id) {
            abort(403, 'Unauthorized access to this page.');
        }

        // Ensure the order has been paid
        if ($order->status !== Order::STATUS_PAID) {
            return redirect()
                ->route('buyer.orders.show', $order)
                ->with('error', 'Payment information not found for this order.');
        }

        // Load related data
        $order->load(['design', 'design.designer']);

        return view('buyer.payment-success', compact('order'));
    }
}