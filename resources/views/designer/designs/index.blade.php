@extends('layouts.app')

@section('title', 'My Designs')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Back Button & Header -->
        <div class="flex items-center mb-8">
            <a href="{{ route('designer.dashboard') }}" 
               class="flex items-center justify-center w-12 h-12 bg-white/80 backdrop-blur-sm rounded-xl shadow-lg hover:bg-white transition-all duration-300 mr-4 group">
                <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">My Designs</h1>
                        <p class="text-gray-600 text-lg">Manage your design portfolio</p>
                    </div>
                    <a href="{{ route('designer.designs.create') }}" 
                       class="group relative overflow-hidden px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <span class="relative flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Upload New Design
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Modern Filters -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-8 mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter & Search
            </h3>
            <form method="GET" action="{{ route('designer.designs.index') }}" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-3">Search Designs</label>
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   id="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search by title or description..."
                                   class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-3">Category</label>
                        <select name="category" 
                                id="category"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all">
                            <option value="">All Categories</option>
                            <option value="Clothing" {{ request('category') == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                            <option value="Accessories" {{ request('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                            <option value="Shoes" {{ request('category') == 'Shoes' ? 'selected' : '' }}>Shoes</option>
                            <option value="Bags" {{ request('category') == 'Bags' ? 'selected' : '' }}>Bags</option>
                            <option value="Jewelry" {{ request('category') == 'Jewelry' ? 'selected' : '' }}>Jewelry</option>
                            <option value="Home & Living" {{ request('category') == 'Home & Living' ? 'selected' : '' }}>Home & Living</option>
                            <option value="Beauty" {{ request('category') == 'Beauty' ? 'selected' : '' }}>Beauty</option>
                            <option value="Other" {{ request('category') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-3">Status</label>
                        <select name="status" 
                                id="status"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="md:col-span-3 flex items-end gap-4">
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-lg hover:shadow-xl">
                            Apply Filters
                        </button>
                        <a href="{{ route('designer.designs.index') }}" 
                           class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all">
                            Clear All
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200/50 text-green-800 px-6 py-4 rounded-2xl mb-8 shadow-lg">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Modern Designs Grid -->
        @if($designs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-8">
                @foreach($designs as $design)
                    <div class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <!-- Design Image -->
                        <div class="relative aspect-square overflow-hidden">
                            <img src="{{ $design->image_url }}" 
                                 alt="{{ $design->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="px-3 py-1 text-xs font-bold rounded-full backdrop-blur-sm {{ $design->is_active ? 'bg-green-500/90 text-white' : 'bg-red-500/90 text-white' }} shadow-lg">
                                    {{ $design->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            @if($design->is_featured)
                                <div class="absolute top-3 left-3">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-amber-500/90 text-white backdrop-blur-sm shadow-lg flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Featured
                                    </span>
                                </div>
                            @endif

                            <!-- Quick Actions Overlay -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="flex space-x-3">
                                    <a href="{{ route('designer.designs.show', $design) }}" 
                                       class="px-4 py-2 bg-white/90 text-gray-800 rounded-xl font-medium hover:bg-white transition-colors shadow-lg backdrop-blur-sm">
                                        View
                                    </a>
                                    <a href="{{ route('designer.designs.edit', $design) }}" 
                                       class="px-4 py-2 bg-blue-600/90 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors shadow-lg backdrop-blur-sm">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Design Info -->
                        <div class="p-6">
                            <h3 class="font-bold text-xl text-gray-900 mb-2 truncate">{{ $design->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($design->description, 80) }}</p>
                            
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">${{ number_format($design->price, 2) }}</span>
                                @if($design->category)
                                    <span class="text-xs px-3 py-1 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-full font-medium">{{ $design->category }}</span>
                                @endif
                            </div>

                            <!-- Tags -->
                            @if($design->tags && count($design->tags) > 0)
                                <div class="mb-4">
                                    @foreach(array_slice($design->tags, 0, 2) as $tag)
                                        <span class="inline-block text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full mr-1 mb-1 font-medium">#{{ $tag }}</span>
                                    @endforeach
                                    @if(count($design->tags) > 2)
                                        <span class="text-xs text-gray-500 font-medium">+{{ count($design->tags) - 2 }} more</span>
                                    @endif
                                </div>
                            @endif

                            <!-- Bottom Actions -->
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <div class="text-xs text-gray-500 font-medium">
                                    {{ $design->created_at->format('M j, Y') }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('designer.designs.toggle-status', $design) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to {{ $design->is_active ? 'deactivate' : 'activate' }} this design?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="text-{{ $design->is_active ? 'amber' : 'green' }}-600 hover:text-{{ $design->is_active ? 'amber' : 'green' }}-800 text-sm font-bold transition-colors">
                                            {{ $design->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Modern Pagination -->
            <div class="flex justify-center">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-4">
                    {{ $designs->appends(request()->query())->links() }}
                </div>
            </div>
        @else
            <!-- Modern Empty State -->
            <div class="text-center py-16">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-lg border border-white/20 p-12 max-w-lg mx-auto">
                    <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No designs found</h3>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                        @if(request()->hasAny(['search', 'category', 'status']))
                            Try adjusting your filters or search terms to find what you're looking for.
                        @else
                            Start building your amazing portfolio by uploading your first design and showcase your creativity to the world.
                        @endif
                    </p>
                    <a href="{{ route('designer.designs.create') }}" 
                       class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                        <span class="relative flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Upload Your First Design
                        </span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection