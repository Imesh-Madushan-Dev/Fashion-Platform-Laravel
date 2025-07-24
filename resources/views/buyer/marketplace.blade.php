@extends('layouts.app')

@section('nav-links')
    <a href="{{ route('buyer.dashboard') }}" class="text-gray-700 hover:text-blue-500">Dashboard</a>
    <a href="{{ route('buyer.marketplace') }}" class="text-blue-500 font-semibold">Marketplace</a>
    <a href="{{ route('buyer.orders.index') }}" class="text-gray-700 hover:text-blue-500">My Orders</a>
    <span class="text-gray-700">Welcome, {{ Auth::guard('buyer')->user()->name }}</span>
    <form method="POST" action="{{ route('buyer.logout') }}" class="inline">
        @csrf
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm">
            Logout
        </button>
    </form>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('buyer.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            <!-- Compact Header -->
            <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-lg mb-6">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative p-6">
                    <div class="text-center">
                        <h1 class="text-3xl font-bold text-white mb-2">Design Marketplace</h1>
                        <p class="text-indigo-100 max-w-2xl mx-auto">Discover amazing designs from talented creators</p>
                    </div>
                </div>
            </div>

            <!-- Compact Search and Filter Bar -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 mb-6">
                <div class="p-4">
                    <form method="GET" action="{{ route('buyer.marketplace') }}" class="space-y-4">
                        <!-- Search Bar with Filter Dropdown -->
                        <div class="flex flex-col lg:flex-row gap-4">
                            <!-- Search Input -->
                            <div class="flex-1">
                                <div class="relative">
                                    <input type="text" 
                                           id="search" 
                                           name="search" 
                                           value="{{ request('search') }}"
                                           placeholder="Search designs, designers, or categories..."
                                           class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Dropdown Button -->
                            <div class="relative">
                                <button type="button" 
                                        id="filterDropdownButton"
                                        class="flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg border border-gray-200 transition-all duration-200 min-w-[140px]">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                                    </svg>
                                    Filters
                                    <svg class="w-4 h-4 ml-2 transition-transform duration-200" id="filterDropdownIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- Filter Dropdown Content -->
                                <div id="filterDropdownContent" class="hidden absolute top-full mt-2 right-0 bg-white rounded-lg shadow-xl border border-gray-200 z-50 min-w-[500px]">
                                    <div class="p-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <!-- Category Filter -->
                                            <div>
                                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                                <select name="category" id="category" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white">
                                                    <option value="">All Categories</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                                            {{ ucfirst($category) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Sort By -->
                                            <div>
                                                <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                                                <select name="sort_by" id="sort_by" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white">
                                                    <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                                    <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                                    <option value="price_low" {{ request('sort_by') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                                    <option value="price_high" {{ request('sort_by') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                                    <option value="popular" {{ request('sort_by') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                                                </select>
                                            </div>

                                            <!-- Min Price -->
                                            <div>
                                                <label for="min_price" class="block text-sm font-medium text-gray-700 mb-2">Min Price</label>
                                                <input type="number" 
                                                       id="min_price" 
                                                       name="min_price" 
                                                       value="{{ request('min_price') }}"
                                                       placeholder="$0"
                                                       min="0"
                                                       step="0.01"
                                                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                            </div>

                                            <!-- Max Price -->
                                            <div>
                                                <label for="max_price" class="block text-sm font-medium text-gray-700 mb-2">Max Price</label>
                                                <input type="number" 
                                                       id="max_price" 
                                                       name="max_price" 
                                                       value="{{ request('max_price') }}"
                                                       placeholder="$1000"
                                                       min="0"
                                                       step="0.01"
                                                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                            </div>
                                        </div>

                                        <!-- Filter Action Buttons -->
                                        <div class="flex gap-3 mt-6 pt-4 border-t border-gray-200">
                                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
                                                Apply Filters
                                            </button>
                                            <a href="{{ route('buyer.marketplace') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg text-center transition-all duration-200">
                                                Clear All
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Search Button -->
                            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const dropdownButton = document.getElementById('filterDropdownButton');
                    const dropdownContent = document.getElementById('filterDropdownContent');
                    const dropdownIcon = document.getElementById('filterDropdownIcon');

                    dropdownButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        dropdownContent.classList.toggle('hidden');
                        dropdownIcon.style.transform = dropdownContent.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!dropdownButton.contains(e.target) && !dropdownContent.contains(e.target)) {
                            dropdownContent.classList.add('hidden');
                            dropdownIcon.style.transform = 'rotate(0deg)';
                        }
                    });
                });
            </script>

            <!-- Results Info with Compact Styling -->
            <div class="mb-4 flex items-center justify-between bg-white rounded-lg shadow-sm border border-gray-100 px-4 py-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-700 font-medium text-sm">
                            Showing <span class="font-bold text-blue-600">{{ $designs->firstItem() ?? 0 }}</span> to <span class="font-bold text-blue-600">{{ $designs->lastItem() ?? 0 }}</span> of <span class="font-bold text-blue-600">{{ $designs->total() }}</span> designs
                        </p>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-2">
                    <div class="flex items-center text-green-600 bg-green-100 rounded-full px-3 py-1">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-xs font-medium">Quality Verified</span>
                    </div>
                </div>
            </div>

            <!-- Modern Designs Grid -->
            @if($designs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach($designs as $design)
                        <div class="group bg-white overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                            <!-- Modern Design Image -->
                            <div class="relative overflow-hidden">
                                @if($design->image_path)
                                    <img src="{{ $design->image_url }}" 
                                         alt="{{ $design->title }}" 
                                         class="w-full h-55 object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-55 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Modern Featured Badge -->
                                @if($design->is_featured)
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            Featured
                                        </span>
                                    </div>
                                @endif
                                
                             
                            </div>

                            <!-- Modern Design Info -->
                            <div class="p-5">
                                <div class="mb-3">
                                    <h3 class="text-lg font-bold text-gray-800 line-clamp-1 group-hover:text-blue-600 transition-colors duration-200">{{ $design->title }}</h3>
                                    <div class="flex items-center mt-1">
                                        <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-2">
                                            <span class="text-white text-xs font-bold">{{ substr($design->designer->name, 0, 1) }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 font-medium">{{ $design->designer->name }}</p>
                                    </div>
                                </div>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">{{ $design->description }}</p>

                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <span class="text-2xl font-bold text-blue-600">${{ number_format($design->price, 2) }}</span>
                                        <span class="text-sm text-gray-500 ml-1">USD</span>
                                    </div>
                                    @if($design->category)
                                        <span class="bg-gradient-to-r from-purple-100 to-blue-100 text-purple-800 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ ucfirst($design->category) }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Modern Action Buttons -->
                                <div class="space-y-3">
                                    <a href="{{ route('buyer.designs.show', $design) }}" 
                                       class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-4 rounded-xl text-center block transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        <span class="flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View Details
                                        </span>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('buyer.orders.quick-buy', $design) }}" class="w-full">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                                                onclick="return confirm('Purchase {{ $design->title }} for ${{ number_format($design->price, 2) }}?')">
                                            <span class="flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                </svg>
                                                Quick Buy - ${{ number_format($design->price, 2) }}
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Modern Pagination -->
                <div class="flex justify-center mt-12">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
                        {{ $designs->links() }}
                    </div>
                </div>
            @else
                <!-- Modern No Results -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                    <div class="p-16 text-center">
                        <div class="mx-auto w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">No designs found</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">We couldn't find any designs matching your criteria. Try adjusting your filters or browse our entire collection.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('buyer.marketplace') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m15.357 2H15"></path>
                                    </svg>
                                    View All Designs
                                </span>
                            </a>
                            <button onclick="history.back()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Go Back
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection