@extends('layouts.app')

@section('nav-links')
    <a href="{{ route('buyer.dashboard') }}" class="text-gray-700 hover:text-blue-500">Dashboard</a>
    <a href="{{ route('buyer.marketplace') }}" class="text-gray-700 hover:text-blue-500">Marketplace</a>
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
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-7xl mx-auto">
            <!-- Professional Header Bar -->
            <div class="flex items-center justify-between mb-6 bg-white rounded-lg shadow-sm border border-gray-200 px-6 py-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('buyer.marketplace') }}" class="flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Marketplace
                    </a>
                    <div class="h-5 w-px bg-gray-300"></div>
                    <nav class="flex items-center space-x-2 text-sm text-gray-600">
                        <a href="{{ route('buyer.marketplace') }}" class="hover:text-blue-600 transition-colors">Marketplace</a>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-blue-600 font-medium">{{ $design->title }}</span>
                    </nav>
                </div>
                <div class="flex items-center space-x-2">
                    @if($design->is_featured)
                        <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-sm flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            Featured Design
                        </span>
                    @endif
                </div>
            </div>

            <!-- Professional Product Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Product Image Gallery - 2/3 width -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="aspect-video lg:aspect-[4/3] relative bg-gray-50">
                            @if($design->image_path)
                                <img src="{{ $design->image_url }}" 
                                     alt="{{ $design->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-gray-500 font-medium">No Image Available</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Details Sidebar - 1/3 width -->
                <div class="space-y-6">
                    <!-- Product Info Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <!-- Category Badge -->
                        @if($design->category)
                            <div class="mb-4">
                                <span class="inline-flex items-center bg-blue-50 text-blue-700 px-3 py-1 rounded-md text-sm font-medium border border-blue-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ ucfirst($design->category) }}
                                </span>
                            </div>
                        @endif

                        <!-- Title -->
                        <h1 class="text-2xl font-bold text-gray-900 mb-4 leading-tight">{{ $design->title }}</h1>
                        
                        <!-- Designer Info -->
                        <div class="flex items-center space-x-3 mb-6 pb-6 border-b border-gray-100">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">{{ substr($design->designer->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Created by</p>
                                <p class="font-semibold text-gray-900">{{ $design->designer->name }}</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex items-center text-green-600 bg-green-50 rounded-full px-2 py-0.5 text-xs font-medium border border-green-200">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Verified
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="mb-6">
                            <div class="flex items-baseline space-x-2 mb-2">
                                <span class="text-3xl font-bold text-gray-900">${{ number_format($design->price, 2) }}</span>
                                <span class="text-gray-600 text-sm">USD</span>
                            </div>
                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    One-time purchase
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Commercial license
                                </div>
                            </div>
                        </div>

                        <!-- Purchase Actions -->
                        <div class="space-y-3">
                            <!-- Quick Buy Button -->
                            <form method="POST" action="{{ route('buyer.orders.quick-buy', $design) }}" class="w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3 px-6 rounded-lg text-sm shadow-sm hover:shadow-md transition-all duration-200"
                                        onclick="return confirm('Purchase {{ $design->title }} for ${{ number_format($design->price, 2) }}?')">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        Buy Now - ${{ number_format($design->price, 2) }}
                                    </span>
                                </button>
                            </form>

                            <!-- Custom Order Button -->
                            <a href="{{ route('buyer.orders.create', $design) }}" 
                               class="w-full bg-white hover:bg-gray-50 text-gray-900 font-semibold py-3 px-6 rounded-lg text-sm text-center block transition-all duration-200 border border-gray-300 hover:border-gray-400">
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                    </svg>
                                    Customize Order
                                </span>
                            </a>
                        </div>

                        <!-- Security Badges -->
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="grid grid-cols-2 gap-3 text-xs">
                                <div class="flex items-center text-green-600 bg-green-50 rounded-md px-2 py-1 border border-green-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Secure Payment
                                </div>
                                <div class="flex items-center text-blue-600 bg-blue-50 rounded-md px-2 py-1 border border-blue-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Instant Download
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Design Stats
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Created:</span>
                                <span class="font-medium text-gray-900">{{ $design->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sales:</span>
                                <span class="font-medium text-gray-900">{{ $design->sales_count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Content Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Description Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Description
                    </h3>
                    <p class="text-gray-700 leading-relaxed">{{ $design->description }}</p>
                </div>

                <!-- Tags & Designer Info Card -->
                <div class="space-y-6">
                    <!-- Tags -->
                    @if($design->tags && count($design->tags) > 0)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Tags
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($design->tags as $tag)
                                    <span class="bg-gray-50 text-gray-700 px-3 py-1 rounded-md text-sm font-medium border border-gray-200">
                                        #{{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Designer Contact Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Designer Contact
                        </h3>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-600 rounded-full flex items-center justify-center shadow-sm">
                                <span class="text-white font-bold text-lg">
                                    {{ substr($design->designer->name, 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $design->designer->name }}</p>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $design->designer->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Related Designs Section -->
            @if($relatedDesigns->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 00-2 2v2a2 2 0 002 2m0 0h14m-14 0a2 2 0 002 2v2a2 2 0 01-2 2m12 0a2 2 0 01-2-2v-2a2 2 0 012-2"></path>
                            </svg>
                            More from {{ $design->designer->name }}
                        </h2>
                        <a href="{{ route('buyer.marketplace') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center transition-colors duration-200">
                            View All
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($relatedDesigns as $relatedDesign)
                            <div class="group bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-300 overflow-hidden">
                                <!-- Image Container -->
                                <div class="aspect-video relative bg-white">
                                    @if($relatedDesign->image_path)
                                        <img src="{{ $relatedDesign->image_url }}" 
                                             alt="{{ $relatedDesign->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Quick View Overlay -->
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                        <a href="{{ route('buyer.designs.show', $relatedDesign) }}" 
                                           class="bg-white text-gray-900 px-4 py-2 rounded-lg font-medium text-sm opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:shadow-xl">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="p-4 bg-white">
                                    <!-- Category -->
                                    @if($relatedDesign->category)
                                        <span class="inline-block bg-blue-50 text-blue-700 text-xs font-medium px-2 py-1 rounded-md mb-2 border border-blue-200">
                                            {{ ucfirst($relatedDesign->category) }}
                                        </span>
                                    @endif
                                    
                                    <!-- Title -->
                                    <h3 class="font-semibold text-gray-900 text-sm mb-1 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                        {{ $relatedDesign->title }}
                                    </h3>
                                    
                                    <!-- Price and Actions -->
                                    <div class="flex items-center justify-between mt-3">
                                        <span class="text-lg font-bold text-gray-900">${{ number_format($relatedDesign->price, 2) }}</span>
                                        <a href="{{ route('buyer.designs.show', $relatedDesign) }}" 
                                           class="bg-gray-100 hover:bg-blue-100 text-gray-700 hover:text-blue-700 px-3 py-1 rounded-md text-xs font-medium transition-all duration-200 border border-gray-200 hover:border-blue-300">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Professional Similar Designs Section -->
            @if($similarDesigns->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            You Might Also Like
                        </h2>
                        <a href="{{ route('buyer.marketplace') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center transition-colors duration-200">
                            Explore More
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($similarDesigns as $similarDesign)
                            <div class="group bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-300 overflow-hidden">
                                <!-- Image Container -->
                                <div class="aspect-video relative bg-white">
                                    @if($similarDesign->image_path)
                                        <img src="{{ $similarDesign->image_url }}" 
                                             alt="{{ $similarDesign->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Quick View Overlay -->
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                        <a href="{{ route('buyer.designs.show', $similarDesign) }}" 
                                           class="bg-white text-gray-900 px-4 py-2 rounded-lg font-medium text-sm opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:shadow-xl">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="p-4 bg-white">
                                    <!-- Category -->
                                    @if($similarDesign->category)
                                        <span class="inline-block bg-green-50 text-green-700 text-xs font-medium px-2 py-1 rounded-md mb-2 border border-green-200">
                                            {{ ucfirst($similarDesign->category) }}
                                        </span>
                                    @endif
                                    
                                    <!-- Title -->
                                    <h3 class="font-semibold text-gray-900 text-sm mb-1 line-clamp-2 group-hover:text-green-600 transition-colors duration-200">
                                        {{ $similarDesign->title }}
                                    </h3>
                                    
                                    <!-- Designer -->
                                    <div class="flex items-center mb-2">
                                        <div class="w-3 h-3 bg-gradient-to-r from-green-500 to-blue-500 rounded-full mr-2"></div>
                                        <p class="text-xs text-gray-600 truncate">{{ $similarDesign->designer->name }}</p>
                                    </div>
                                    
                                    <!-- Price and Actions -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-bold text-gray-900">${{ number_format($similarDesign->price, 2) }}</span>
                                        <a href="{{ route('buyer.designs.show', $similarDesign) }}" 
                                           class="bg-gray-100 hover:bg-green-100 text-gray-700 hover:text-green-700 px-3 py-1 rounded-md text-xs font-medium transition-all duration-200 border border-gray-200 hover:border-green-300">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection