<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Design;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class BuyerDashboardController extends Controller
{
    /**
     * Display the buyer dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $buyer = Auth::guard('buyer')->user();
        
        // Get buyer statistics
        $stats = [
            'total_orders' => $buyer->orders()->count(),
            'total_spent' => $buyer->orders()->where('status', '!=', Order::STATUS_CANCELLED)->sum('total_amount'),
            'pending_orders' => $buyer->orders()->where('status', Order::STATUS_PENDING)->count(),
        ];

        return view('buyer.dashboard', compact('stats'));
    }

    /**
     * Display the marketplace with all available designs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function marketplace(Request $request)
    {
        $query = Design::with('designer')->active();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->withCount('orders')->orderBy('orders_count', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy($sortBy, $sortOrder);
        }

        $designs = $query->paginate(12)->withQueryString();

        // Get available categories for filter
        $categories = Design::active()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->sort();

        return view('buyer.marketplace', compact('designs', 'categories'));
    }

    /**
     * Display a specific design with details.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\View\View
     */
    public function showDesign(Design $design)
    {
        // Ensure the design is active
        if (!$design->is_active) {
            abort(404, 'Design not found or not available.');
        }

        // Load designer relationship
        $design->load('designer');

        // Get related designs from the same designer
        $relatedDesigns = Design::where('designer_id', $design->designer_id)
            ->where('id', '!=', $design->id)
            ->active()
            ->take(4)
            ->get();

        // Get similar designs in the same category
        $similarDesigns = Design::where('category', $design->category)
            ->where('id', '!=', $design->id)
            ->active()
            ->take(4)
            ->get();

        return view('buyer.design-detail', compact('design', 'relatedDesigns', 'similarDesigns'));
    }

    /**
     * Display the buyer's order history.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function orderHistory(Request $request)
    {
        $buyer = Auth::guard('buyer')->user();
        
        $query = $buyer->orders()->with(['design', 'design.designer']);

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('ordered_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('ordered_at', '<=', $request->date_to);
        }

        $orders = $query->orderBy('ordered_at', 'desc')->paginate(10)->withQueryString();

        // Get available statuses for filter
        $statuses = Order::getStatuses();

        return view('buyer.orders', compact('orders', 'statuses'));
    }

    /**
     * Display a specific order details.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function showOrder(Order $order)
    {
        $buyer = Auth::guard('buyer')->user();

        // Ensure the order belongs to the authenticated buyer
        if ($order->buyer_id !== $buyer->id) {
            abort(403, 'Unauthorized access to order.');
        }

        // Load relationships
        $order->load(['design', 'design.designer']);

        return view('buyer.order-detail', compact('order'));
    }
}