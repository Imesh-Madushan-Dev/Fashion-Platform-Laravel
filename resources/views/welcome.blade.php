<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DesignSphere - Fashion Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        backgroundImage: {
                            'hero-pattern': "url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%239C92AC\" fill-opacity=\"0.1\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')",
                            'grid-pattern': "url('data:image/svg+xml,%3Csvg width=\"40\" height=\"40\" viewBox=\"0 0 40 40\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23f3f4f6\" fill-opacity=\"0.4\" fill-rule=\"evenodd\"%3E%3Cpath d=\"m0 40 40-40h20v20l-20 20z\"/%3E%3Cpath d=\"m0 20 20-20h20v20l-20 20z\"/%3E%3C/g%3E%3C/svg%3E')",
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="antialiased bg-white">
        @include('components.navigation')

        <!-- Hero Section -->
        <section class="relative pt-24 pb-20 min-h-screen flex items-center overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/20 via-pink-900/20 to-indigo-900/20"></div>
            <div class="absolute inset-0 bg-hero-pattern"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-purple-50/80 via-white/90 to-pink-50/80"></div>
            
            <!-- Floating Elements -->
            <div class="absolute top-20 left-10 w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-400 rounded-full opacity-20 animate-pulse delay-1000"></div>
            <div class="absolute bottom-40 left-20 w-12 h-12 bg-gradient-to-br from-pink-400 to-red-400 rounded-full opacity-20 animate-pulse delay-2000"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="mb-8">
                    <div class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm rounded-full border border-purple-200 mb-6">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        <span class="text-sm font-medium text-gray-700">Live Fashion Marketplace</span>
                    </div>
                </div>
                
                <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold text-gray-900 mb-8 leading-tight">
                    Where Fashion
                    <span class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 bg-clip-text text-transparent block">
                        Dreams
                    </span>
                    <span class="text-5xl md:text-6xl lg:text-7xl">Come True</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-gray-600 mb-12 max-w-4xl mx-auto leading-relaxed">
                    Connect talented fashion designers with buyers worldwide. Upload, discover, and purchase unique fashion designs in our exclusive marketplace.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center mb-16">
                    <a href="{{ route('marketplace.index') }}" class="group bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-10 py-5 rounded-2xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                        <span class="flex items-center justify-center">
                            Browse Designs
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </span>
                    </a>
                    <a href="{{ url('/designer/register') }}" class="group bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-10 py-5 rounded-2xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                        <span class="flex items-center justify-center">
                            Start as Designer
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>
                </div>

                <!-- Hero Stats with Enhanced Design -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <div class="text-5xl font-bold bg-gradient-to-r from-purple-600 to-purple-700 bg-clip-text text-transparent mb-3">{{ $stats['designers_count'] ?? 0 }}+</div>
                        <div class="text-gray-600 font-medium">Fashion Designers</div>
                        <div class="w-12 h-1 bg-gradient-to-r from-purple-600 to-purple-700 rounded-full mx-auto mt-3"></div>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <div class="text-5xl font-bold bg-gradient-to-r from-pink-600 to-pink-700 bg-clip-text text-transparent mb-3">{{ $stats['designs_count'] ?? 0 }}+</div>
                        <div class="text-gray-600 font-medium">Unique Designs</div>
                        <div class="w-12 h-1 bg-gradient-to-r from-pink-600 to-pink-700 rounded-full mx-auto mt-3"></div>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <div class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent mb-3">{{ $stats['buyers_count'] ?? 0 }}+</div>
                        <div class="text-gray-600 font-medium">Happy Buyers</div>
                        <div class="w-12 h-1 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full mx-auto mt-3"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="py-24 bg-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full mb-6">
                        <span class="text-sm font-semibold bg-gradient-to-r from-purple-700 to-pink-700 bg-clip-text text-transparent">Featured Designs</span>
                    </div>
                    <h2 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">Trending Fashion</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Discover the latest fashion trends from our talented designers
                    </p>
                </div>

                <!-- Product Grid -->
                <div id="featured-products" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                    @forelse($featuredDesigns as $design)
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 overflow-hidden">
                        <div class="aspect-square bg-gradient-to-br from-purple-100 to-pink-100 relative overflow-hidden">
                            @if($design->image_url)
                                <img src="{{ $design->image_url }}" alt="{{ $design->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-200 to-pink-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3">
                                <button class="wishlist-btn w-8 h-8 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors duration-200" data-design-id="{{ $design->id }}">
                                    <svg class="w-4 h-4 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </div>
                            @if($design->is_featured)
                            <div class="absolute top-3 left-3">
                                <span class="bg-yellow-400 text-yellow-900 text-xs font-semibold px-2 py-1 rounded-full">Featured</span>
                            </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <a href="{{ route('marketplace.design.show', $design) }}" class="block group-hover:text-purple-600 transition-colors">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $design->title }}</h3>
                            </a>
                            <p class="text-gray-600 text-sm mb-3">by {{ $design->designer->name }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-md font-bold text-purple-600">LKR {{ number_format($design->price, 2) }}</span>
                                <button class="add-to-cart-btn bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-purple-700 hover:to-pink-700 transition-all duration-200 transform hover:scale-105"
                                        data-design-id="{{ $design->id }}" 
                                        data-name="{{ $design->title }}" 
                                        data-price="{{ $design->price }}" 
                                        data-image="{{ $design->image_url }}" 
                                        data-designer="{{ $design->designer->name }}">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- No designs available -->
                    <div class="col-span-full text-center py-12">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Featured Designs Yet</h3>
                        <p class="text-gray-600">New designs will appear here once designers start uploading.</p>
                    </div>
                    @endforelse
                </div>

                <!-- View All Button -->
                <div class="text-center">
                    <a href="{{ route('marketplace.index') }}" class="group bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-10 py-4 rounded-2xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl inline-flex items-center">
                        View All Designs
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-24 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-grid-pattern opacity-30"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 bg-purple-100 rounded-full mb-6">
                        <span class="text-sm font-semibold text-purple-700">Platform Features</span>
                    </div>
                    <h2 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">Why Choose DesignSphere?</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Our platform bridges the gap between creative designers and fashion enthusiasts worldwide with cutting-edge features
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- For Designers -->
                    <div class="group relative bg-gradient-to-br from-blue-50 to-blue-100 p-10 rounded-3xl border border-blue-200/50 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105 overflow-hidden">
                        <!-- Background Image -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/5 to-blue-800/10 group-hover:from-blue-600/10 group-hover:to-blue-800/20 transition-all duration-500"></div>
                        
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center mb-8 shadow-lg group-hover:shadow-xl transition-all duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5H9a2 2 0 00-2 2v12a4 4 0 004 4h6a2 2 0 002-2V7a2 2 0 00-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">For Designers</h3>
                            <ul class="text-gray-600 space-y-4">
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Upload your fashion designs</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Set your own prices</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Manage your portfolio</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Track sales & earnings</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- For Buyers -->
                    <div class="group relative bg-gradient-to-br from-purple-50 to-purple-100 p-10 rounded-3xl border border-purple-200/50 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105 overflow-hidden">
                        <!-- Background Image -->
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-600/5 to-purple-800/10 group-hover:from-purple-600/10 group-hover:to-purple-800/20 transition-all duration-500"></div>
                        
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-3xl flex items-center justify-center mb-8 shadow-lg group-hover:shadow-xl transition-all duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">For Buyers</h3>
                            <ul class="text-gray-600 space-y-4">
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Browse unique designs</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Filter by category & price</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Secure payment process</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Order history & tracking</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Platform Features -->
                    <div class="group relative bg-gradient-to-br from-pink-50 to-pink-100 p-10 rounded-3xl border border-pink-200/50 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105 overflow-hidden">
                        <!-- Background Image -->
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-600/5 to-pink-800/10 group-hover:from-pink-600/10 group-hover:to-pink-800/20 transition-all duration-500"></div>
                        
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-600 rounded-3xl flex items-center justify-center mb-8 shadow-lg group-hover:shadow-xl transition-all duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Platform Benefits</h3>
                            <ul class="text-gray-600 space-y-4">
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-pink-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Modern, responsive design</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-pink-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Secure authentication</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-pink-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Easy-to-use interface</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-6 h-6 bg-pink-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">24/7 support</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute top-0 left-0 w-72 h-72 bg-gradient-to-br from-purple-200 to-pink-200 rounded-full opacity-20 -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-br from-blue-200 to-purple-200 rounded-full opacity-20 translate-x-1/2 translate-y-1/2"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full mb-6">
                        <span class="text-sm font-semibold bg-gradient-to-r from-purple-700 to-pink-700 bg-clip-text text-transparent">Simple Process</span>
                    </div>
                    <h2 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">How It Works</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Simple steps to start your fashion journey with our intuitive platform
                    </p>
                </div>

                <!-- For Designers -->
                <div class="mb-20">
                    <h3 class="text-3xl font-bold text-center bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent mb-12">For Fashion Designers</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="group text-center">
                            <div class="relative mb-8">
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                                    <span class="text-3xl font-bold text-white">1</span>
                                </div>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-full opacity-80"></div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Sign Up</h4>
                            <p class="text-gray-600 leading-relaxed">Create your designer account and set up your professional profile</p>
                        </div>
                        <div class="group text-center">
                            <div class="relative mb-8">
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                                    <span class="text-3xl font-bold text-white">2</span>
                                </div>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-green-400 to-emerald-400 rounded-full opacity-80"></div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Upload Designs</h4>
                            <p class="text-gray-600 leading-relaxed">Add your fashion designs with high-quality images, descriptions, and competitive prices</p>
                        </div>
                        <div class="group text-center">
                            <div class="relative mb-8">
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                                    <span class="text-3xl font-bold text-white">3</span>
                                </div>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-80"></div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Get Discovered</h4>
                            <p class="text-gray-600 leading-relaxed">Buyers browse and discover your unique creations through our marketplace</p>
                        </div>
                        <div class="group text-center">
                            <div class="relative mb-8">
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                                    <span class="text-3xl font-bold text-white">4</span>
                                </div>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-red-400 to-pink-400 rounded-full opacity-80"></div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Earn Money</h4>
                            <p class="text-gray-600 leading-relaxed">Receive instant payments when buyers purchase your designs</p>
                        </div>
                    </div>
                </div>

                <!-- For Buyers -->
                <div>
                    <h3 class="text-3xl font-bold text-center bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-12">For Fashion Buyers</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="group text-center">
                            <div class="relative mb-8">
                                <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                                    <span class="text-3xl font-bold text-white">1</span>
                                </div>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-full opacity-80"></div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Create Account</h4>
                            <p class="text-gray-600 leading-relaxed">Sign up as a buyer and complete your shopping profile</p>
                        </div>
                        <div class="group text-center">
                            <div class="relative mb-8">
                                <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                                    <span class="text-3xl font-bold text-white">2</span>
                                </div>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-green-400 to-emerald-400 rounded-full opacity-80"></div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Browse Designs</h4>
                            <p class="text-gray-600 leading-relaxed">Explore thousands of unique fashion designs from talented creators</p>
                        </div>
                        <div class="group text-center">
                            <div class="relative mb-8">
                                <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                                    <span class="text-3xl font-bold text-white">3</span>
                                </div>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-blue-400 to-purple-400 rounded-full opacity-80"></div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Make Purchase</h4>
                            <p class="text-gray-600 leading-relaxed">Select and buy your favorite designs with secure payment processing</p>
                        </div>
                        <div class="group text-center">
                            <div class="relative mb-8">
                                <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                                    <span class="text-3xl font-bold text-white">4</span>
                                </div>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-red-400 to-pink-400 rounded-full opacity-80"></div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Enjoy Fashion</h4>
                            <p class="text-gray-600 leading-relaxed">Track your orders and enjoy your unique fashion pieces</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative py-24 overflow-hidden">
            <!-- Background with Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900 via-pink-900 to-indigo-900"></div>
            <div class="absolute inset-0 bg-black/20"></div>
            
            <!-- Animated Background Elements -->
            <div class="absolute top-10 left-10 w-32 h-32 bg-gradient-to-br from-white/10 to-white/5 rounded-full animate-pulse"></div>
            <div class="absolute top-20 right-20 w-24 h-24 bg-gradient-to-br from-white/10 to-white/5 rounded-full animate-pulse delay-1000"></div>
            <div class="absolute bottom-20 left-20 w-20 h-20 bg-gradient-to-br from-white/10 to-white/5 rounded-full animate-pulse delay-2000"></div>
            <div class="absolute bottom-10 right-10 w-28 h-28 bg-gradient-to-br from-white/10 to-white/5 rounded-full animate-pulse delay-500"></div>
            
            <div class="relative max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-8">
                        <span class="text-sm font-semibold text-white">Join Thousands of Users</span>
                    </div>
                </div>
                
                <h2 class="text-5xl md:text-6xl font-bold text-white mb-8 leading-tight">
                    Ready to Join the Fashion
                    <span class="block bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">
                        Revolution?
                    </span>
                </h2>
                
                <p class="text-xl md:text-2xl text-purple-100 mb-12 max-w-4xl mx-auto leading-relaxed">
                    Whether you're a designer looking to showcase your talent or a buyer seeking unique fashion pieces, 
                    DesignSphere is your perfect platform to connect, create, and thrive.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center mb-12">
                    <a href="{{ url('/designer/register') }}" class="group bg-white text-purple-900 px-10 py-5 rounded-2xl text-lg font-bold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-2xl">
                        <span class="flex items-center justify-center">
                            Join as Designer
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>
                    <a href="{{ url('/buyer/register') }}" class="group bg-transparent border-2 border-white text-white px-10 py-5 rounded-2xl text-lg font-bold hover:bg-white hover:text-purple-900 transition-all duration-300 transform hover:scale-105 shadow-2xl">
                        <span class="flex items-center justify-center">
                            Start Shopping
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </span>
                    </a>
                </div>
                
                <!-- Trust Indicators -->
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-8 text-white/80">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Secure Platform</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Instant Payments</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">24/7 Support</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-16 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
            <div class="absolute inset-0 opacity-10 bg-grid-pattern"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                    <div class="lg:col-span-2">
                        <div class="flex items-center mb-6">
                            <span class="text-3xl font-bold bg-gradient-to-r from-purple-400 via-pink-400 to-indigo-400 bg-clip-text text-transparent">
                                DesignSphere
                            </span>
                        </div>
                        <p class="text-gray-300 mb-8 text-lg leading-relaxed max-w-md">
                            The ultimate fashion marketplace connecting talented designers with fashion enthusiasts worldwide. Join our community and be part of the fashion revolution.
                        </p>
                        <div class="flex space-x-6">
                            <a href="#" class="group w-12 h-12 bg-gray-800 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="group w-12 h-12 bg-gray-800 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="group w-12 h-12 bg-gray-800 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </a>
                            <a href="#" class="group w-12 h-12 bg-gray-800 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.5.75C6.146.75 1 5.896 1 12.25c0 5.089 3.292 9.387 7.863 10.91.575-.105.79-.251.79-.546 0-.273-.014-1.178-.014-2.142-2.889.532-3.636-.704-3.866-1.35-.13-.331-.69-1.352-1.18-1.625-.402-.216-.977-.748-.014-.762.906-.014 1.553.834 1.769 1.179 1.035 1.74 2.688 1.25 3.349.948.1-.747.402-1.25.733-1.538-2.559-.287-5.232-1.279-5.232-5.678 0-1.25.445-2.285 1.178-3.09-.115-.288-.517-1.467.115-3.048 0 0 .963-.302 3.163 1.179.92-.259 1.897-.388 2.875-.388.977 0 1.955.129 2.875.388 2.2-1.495 3.162-1.179 3.162-1.179.633 1.581.23 2.76.115 3.048.733.805 1.179 1.825 1.179 3.09 0 4.413-2.688 5.39-5.247 5.678.417.36.776 1.05.776 2.128 0 1.538-.014 2.774-.014 3.162 0 .302.216.662.79.547C20.709 21.637 24 17.324 24 12.25 24 5.896 18.854.75 12.5.75Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-xl font-bold mb-6 text-white">For Designers</h4>
                        <ul class="space-y-4">
                            <li><a href="{{ url('/designer/register') }}" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Sign Up
                            </a></li>
                            <li><a href="{{ url('/designer/login') }}" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Login
                            </a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-xl font-bold mb-6 text-white">For Buyers</h4>
                        <ul class="space-y-4">
                            <li><a href="{{ url('/buyer/register') }}" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Sign Up
                            </a></li>
                            <li><a href="{{ url('/buyer/login') }}" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Login
                            </a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-12 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-400 text-center md:text-left mb-4 md:mb-0">
                            © 2024 DesignSphere Fashion Platform. All rights reserved.
                        </p>
                        <p class="text-gray-500 text-sm">
                            <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent font-semibold">
                                Built with Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Smooth Scrolling Script -->
        <script>
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add scroll effect to navigation
            window.addEventListener('scroll', function() {
                const nav = document.querySelector('nav');
                if (window.scrollY > 100) {
                    nav.classList.add('bg-white/95');
                    nav.classList.remove('bg-white/80');
                } else {
                    nav.classList.add('bg-white/80');
                    nav.classList.remove('bg-white/95');
                }
            });

            // Shopping Cart functionality
            let cart = JSON.parse(localStorage.getItem('designCart')) || [];
            let wishlist = JSON.parse(localStorage.getItem('designWishlist')) || [];

            function updateCartCount() {
                const cartCount = document.getElementById('cart-count');
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                if (totalItems > 0) {
                    cartCount.textContent = totalItems;
                    cartCount.classList.remove('hidden');
                } else {
                    cartCount.classList.add('hidden');
                }
            }

            function addToCart(productId, productName, productPrice, productImage, designerName, buttonElement) {
                const existingItem = cart.find(item => item.id === productId);
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        image: productImage,
                        designer: designerName,
                        quantity: 1
                    });
                }
                localStorage.setItem('designCart', JSON.stringify(cart));
                updateCartCount();
                
                // Update button text and style
                if (buttonElement) {
                    const originalText = buttonElement.innerHTML;
                    buttonElement.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Added';
                    buttonElement.classList.add('bg-green-600', 'hover:bg-green-700');
                    buttonElement.classList.remove('bg-gradient-to-r', 'from-purple-600', 'to-pink-600', 'hover:from-purple-700', 'hover:to-pink-700');
                    
                    // Reset button after 2 seconds
                    setTimeout(() => {
                        buttonElement.innerHTML = originalText;
                        buttonElement.classList.remove('bg-green-600', 'hover:bg-green-700');
                        buttonElement.classList.add('bg-gradient-to-r', 'from-purple-600', 'to-pink-600', 'hover:from-purple-700', 'hover:to-pink-700');
                    }, 2000);
                }
                
                // Show success message
                showNotification('Added to cart successfully!', 'success');
            }

            function toggleWishlist(productId, productName, productPrice, productImage, designerName) {
                const existingIndex = wishlist.findIndex(item => item.id === productId);
                if (existingIndex !== -1) {
                    wishlist.splice(existingIndex, 1);
                    showNotification('Removed from wishlist', 'info');
                } else {
                    wishlist.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        image: productImage,
                        designer: designerName
                    });
                    showNotification('Added to wishlist!', 'success');
                }
                localStorage.setItem('designWishlist', JSON.stringify(wishlist));
                updateWishlistIcons();
            }

            function updateWishlistIcons() {
                document.querySelectorAll('.wishlist-btn').forEach((btn) => {
                    const designId = btn.getAttribute('data-design-id');
                    if (designId) {
                        const isInWishlist = wishlist.some(item => item.id === designId);
                        const icon = btn.querySelector('svg');
                        if (isInWishlist) {
                            icon.setAttribute('fill', 'currentColor');
                            icon.classList.add('text-red-500');
                        } else {
                            icon.setAttribute('fill', 'none');
                            icon.classList.remove('text-red-500');
                        }
                    }
                });
            }

            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ${
                    type === 'success' ? 'bg-green-500 text-white' :
                    type === 'error' ? 'bg-red-500 text-white' :
                    'bg-blue-500 text-white'
                }`;
                notification.textContent = message;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 3000);
            }

            // Profile dropdown functionality handled by Alpine.js

            // Add event listeners to cart buttons
            document.addEventListener('DOMContentLoaded', function() {
                updateCartCount();
                updateWishlistIcons();

                // Add to cart buttons
                document.querySelectorAll('.add-to-cart-btn').forEach((btn) => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const designId = btn.getAttribute('data-design-id');
                        const designName = btn.getAttribute('data-name');
                        const designPrice = parseFloat(btn.getAttribute('data-price'));
                        const designImage = btn.getAttribute('data-image');
                        const designerName = btn.getAttribute('data-designer');
                        
                        addToCart(designId, designName, designPrice, designImage, designerName, btn);
                    });
                });

                // Wishlist buttons
                document.querySelectorAll('.wishlist-btn').forEach((btn) => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const designId = btn.getAttribute('data-design-id');
                        const productCard = btn.closest('.group');
                        const productName = productCard.querySelector('h3').textContent;
                        const productPrice = parseFloat(productCard.querySelector('.text-2xl').textContent.replace('$', ''));
                        const productImage = productCard.querySelector('img')?.src || '';
                        const designerName = productCard.querySelector('.text-gray-600').textContent.replace('by ', '');
                        
                        toggleWishlist(designId, productName, productPrice, productImage, designerName);
                    });
                });

                // Cart button functionality is now handled by the link href
            });
        </script>
    </body>
</html>