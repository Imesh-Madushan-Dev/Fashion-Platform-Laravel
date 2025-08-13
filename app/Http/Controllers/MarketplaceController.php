<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    /**
     * Display the welcome page with featured designs
     */
    public function welcome()
    {
        // Get featured designs for homepage
        $featuredDesigns = Design::with('designer')->active()->featured()->take(4)->get();
        
        // Get recent designs if no featured designs exist
        if ($featuredDesigns->isEmpty()) {
            $featuredDesigns = Design::with('designer')->active()->latest()->take(4)->get();
        }

        // Get statistics
        $stats = [
            'designers_count' => \App\Models\Designer::count(),
            'designs_count' => Design::active()->count(),
            'buyers_count' => \App\Models\Buyer::count(),
        ];

        return view('welcome', compact('featuredDesigns', 'stats'));
    }

    /**
     * Display the public marketplace with designs
     */
    public function index(Request $request)
    {
        $query = Design::with('designer')->active();

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Apply category filter
        if ($request->has('category') && $request->category) {
            $query->byCategory($request->category);
        }

        // Apply price sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'popular':
                    // You can add a view count or sales count later
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $designs = $query->paginate(12);
        $categories = $this->getCategories();
        $featuredDesigns = Design::with('designer')->active()->featured()->take(4)->get();

        return view('marketplace.index', compact('designs', 'categories', 'featuredDesigns'));
    }

    /**
     * Show a specific design
     */
    public function show(Design $design)
    {
        if (!$design->is_active) {
            abort(404);
        }

        $design->load('designer');
        $relatedDesigns = Design::with('designer')
            ->active()
            ->where('id', '!=', $design->id)
            ->where('category', $design->category)
            ->take(4)
            ->get();

        return view('marketplace.show', compact('design', 'relatedDesigns'));
    }

    /**
     * Get available design categories.
     */
    private function getCategories()
    {
        return [
            'Clothing' => 'Clothing',
            'Accessories' => 'Accessories',
            'Shoes' => 'Shoes',
            'Bags' => 'Bags',
            'Jewelry' => 'Jewelry',
            'Home & Living' => 'Home & Living',
            'Beauty' => 'Beauty',
            'Other' => 'Other',
        ];
    }
}