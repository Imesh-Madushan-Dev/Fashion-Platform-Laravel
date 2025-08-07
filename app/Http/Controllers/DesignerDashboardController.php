<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DesignerDashboardController extends Controller
{
    /**
     * Display the designer dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $designer = Auth::guard('designer')->user();
        
        $designCount = $designer->designs()->count();
        $totalOrders = Order::whereHas('design', function ($query) use ($designer) {
            $query->where('designer_id', $designer->id);
        })->count();
        
        $totalRevenue = Order::whereHas('design', function ($query) use ($designer) {
            $query->where('designer_id', $designer->id);
        })->where('status', '!=', Order::STATUS_CANCELLED)->sum('total_amount');

        return view('designer.dashboard', compact('designCount', 'totalOrders', 'totalRevenue'));
    }

    /**
     * Display orders for the designer.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function orders(Request $request)
    {
        $designer = Auth::guard('designer')->user();
        $status = $request->get('status');

        // Get orders for designs belonging to this designer
        $ordersQuery = Order::with(['buyer', 'design'])
            ->whereHas('design', function ($query) use ($designer) {
                $query->where('designer_id', $designer->id);
            })
            ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($status && in_array($status, array_keys(Order::getStatuses()))) {
            $ordersQuery->where('status', $status);
        }

        $orders = $ordersQuery->paginate(10);

        // Calculate statistics
        $stats = $this->calculateOrderStats($designer);

        return view('designer.orders', compact('orders', 'stats', 'status'));
    }

    /**
     * Calculate order statistics for the designer.
     *
     * @param \App\Models\Designer $designer
     * @return array
     */
    private function calculateOrderStats($designer)
    {
        $baseQuery = Order::whereHas('design', function ($query) use ($designer) {
            $query->where('designer_id', $designer->id);
        });

        return [
            'total_orders' => $baseQuery->count(),
            'pending_orders' => $baseQuery->where('status', Order::STATUS_PENDING)->count(),
            'completed_orders' => $baseQuery->where('status', Order::STATUS_COMPLETED)->count(),
            'total_revenue' => $baseQuery->where('status', '!=', Order::STATUS_CANCELLED)->sum('total_amount'),
        ];
    }

    /**
     * Update order status (for designers to manage their orders).
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $designer = Auth::guard('designer')->user();

        // Verify the order belongs to one of the designer's designs
        if ($order->design->designer_id !== $designer->id) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Order::getStatuses())),
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Show the designer profile page.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        $designer = Auth::guard('designer')->user();
        return view('designer.profile', compact('designer'));
    }

    /**
     * Update the designer profile.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $designer = Auth::guard('designer')->user();

        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('designers')->ignore($designer->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'brand_name' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($designer->profile_picture) {
                Storage::delete('public/profile_pictures/' . $designer->profile_picture);
            }

            // Store new profile picture
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->storeAs('public/profile_pictures', $filename);
            $validatedData['profile_picture'] = $filename;
        }

        // Remove password from validated data if not provided
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            // Hash the new password
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        // Update the designer profile
        $designer->update($validatedData);

        return redirect()->route('designer.profile')->with('success', 'Profile updated successfully!');
    }
}