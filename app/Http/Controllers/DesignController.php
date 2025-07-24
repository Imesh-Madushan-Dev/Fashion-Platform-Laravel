<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DesignController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:designer');
    }

    /**
     * Display a listing of the designer's designs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Auth::guard('designer')->user()->designs();

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Apply category filter
        if ($request->has('category') && $request->category) {
            $query->byCategory($request->category);
        }

        // Apply status filter
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $designs = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('designer.designs.index', compact('designs'));
    }

    /**
     * Show the form for creating a new design.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategories();
        return view('designer.designs.create', compact('categories'));
    }

    /**
     * Store a newly created design in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:500',
        ]);

        // Handle image upload
        $imagePath = $this->uploadImage($request->file('image'));

        // Process tags
        $tags = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];

        // Create design
        $design = Auth::guard('designer')->user()->designs()->create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image_path' => $imagePath,
            'category' => $request->category,
            'tags' => $tags,
            'is_active' => true,
        ]);

        return redirect()->route('designer.designs.show', $design)
                        ->with('success', 'Design uploaded successfully!');
    }

    /**
     * Display the specified design.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function show(Design $design)
    {
        // Ensure the design belongs to the authenticated designer
        if ($design->designer_id !== Auth::guard('designer')->id()) {
            abort(403, 'Unauthorized access to this design.');
        }

        return view('designer.designs.show', compact('design'));
    }

    /**
     * Show the form for editing the specified design.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(Design $design)
    {
        // Ensure the design belongs to the authenticated designer
        if ($design->designer_id !== Auth::guard('designer')->id()) {
            abort(403, 'Unauthorized access to this design.');
        }

        $categories = $this->getCategories();
        return view('designer.designs.edit', compact('design', 'categories'));
    }

    /**
     * Update the specified design in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Design $design)
    {
        // Ensure the design belongs to the authenticated designer
        if ($design->designer_id !== Auth::guard('designer')->id()) {
            abort(403, 'Unauthorized access to this design.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:500',
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'tags' => $request->tags ? array_map('trim', explode(',', $request->tags)) : [],
        ];

        // Handle new image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image
            $this->deleteImage($design->image_path);
            
            // Upload new image
            $updateData['image_path'] = $this->uploadImage($request->file('image'));
        }

        $design->update($updateData);

        return redirect()->route('designer.designs.show', $design)
                        ->with('success', 'Design updated successfully!');
    }

    /**
     * Remove the specified design from storage.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {
        // Ensure the design belongs to the authenticated designer
        if ($design->designer_id !== Auth::guard('designer')->id()) {
            abort(403, 'Unauthorized access to this design.');
        }

        // Delete the image file
        $this->deleteImage($design->image_path);

        // Soft delete the design
        $design->delete();

        return redirect()->route('designer.designs.index')
                        ->with('success', 'Design deleted successfully!');
    }

    /**
     * Toggle the active status of the design.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus(Design $design)
    {
        // Ensure the design belongs to the authenticated designer
        if ($design->designer_id !== Auth::guard('designer')->id()) {
            abort(403, 'Unauthorized access to this design.');
        }

        $design->update(['is_active' => !$design->is_active]);

        $status = $design->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()
                        ->with('success', "Design {$status} successfully!");
    }

    /**
     * Upload design image to the public/designs directory.
     *
     * @param  \Illuminate\Http\UploadedFile  $image
     * @return string
     */
    private function uploadImage($image)
    {
        // Create unique filename
        $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        
        // Ensure the designs directory exists
        $designsPath = public_path('designs');
        if (!file_exists($designsPath)) {
            mkdir($designsPath, 0755, true);
        }

        // Move the image to public/designs directory
        $image->move($designsPath, $filename);

        return $filename;
    }

    /**
     * Delete design image from the public/designs directory.
     *
     * @param  string  $imagePath
     * @return void
     */
    private function deleteImage($imagePath)
    {
        if ($imagePath) {
            $fullPath = public_path('designs/' . $imagePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }

    /**
     * Get available design categories.
     *
     * @return array
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