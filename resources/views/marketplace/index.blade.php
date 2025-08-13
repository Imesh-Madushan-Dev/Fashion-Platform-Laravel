<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Marketplace - DesignSphere</title>
        
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
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="antialiased bg-gray-50">
        @include('components.navigation')

        <!-- Search Bar Section -->
        <div class="bg-white shadow-sm border-b border-gray-100 pt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-center">
                    <form method="GET" class="w-full max-w-2xl">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search designs..." 
                                   class="w-full px-4 py-3 pl-12 pr-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent text-lg">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <span class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors">
                                    Search
                                </span>
                            </button>
                        </div>
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    </form>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Categories Filter -->
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-medium text-gray-700">Category:</label>
                        <form method="GET" class="inline-block">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                            <select name="category" onchange="this.form.submit()" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="">All Categories</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <!-- Sort Filter -->
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-medium text-gray-700">Sort by:</label>
                        <form method="GET" class="inline-block">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <select name="sort" onchange="this.form.submit()" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Popular</option>
                            </select>
                        </form>
                    </div>
                    
                    <!-- Results count -->
                    <div class="ml-auto text-sm text-gray-600">
                        {{ $designs->total() }} designs found
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Designs Section (only show if no filters applied) -->
        @if(!request('search') && !request('category') && !request('sort') && $featuredDesigns->count() > 0)
        <section class="py-12 bg-gradient-to-r from-purple-50 to-pink-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Featured Designs</h2>
                    <p class="text-gray-600 mt-2">Hand-picked designs from our top creators</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredDesigns as $design)
                    <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 overflow-hidden">
                        <div class="aspect-square bg-gray-100 relative overflow-hidden">
                            @if($design->image_url)
                                <img src="{{ $design->image_url }}" alt="{{ $design->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                                    <span class="text-gray-400 text-lg">No Image</span>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="bg-yellow-400 text-yellow-900 text-xs font-semibold px-2 py-1 rounded-full">Featured</span>
                            </div>
                            <div class="absolute top-3 right-3">
                                <button class="wishlist-btn w-8 h-8 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors duration-200" data-design-id="{{ $design->id }}">
                                    <svg class="w-4 h-4 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <a href="{{ route('marketplace.design.show', $design) }}" class="block">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors">{{ $design->title }}</h3>
                            </a>
                            <p class="text-gray-600 text-sm mb-2">by {{ $design->designer->name }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-bold text-purple-600">LKR {{ number_format($design->price, 2) }}</span>
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
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- Main Products Section -->
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($designs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($designs as $design)
                        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 overflow-hidden">
                            <div class="aspect-square bg-gray-100 relative overflow-hidden">
                                @if($design->image_url)
                                    <img src="{{ $design->image_url }}" alt="{{ $design->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                                        <span class="text-gray-400 text-lg">No Image</span>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <button class="wishlist-btn w-8 h-8 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors duration-200" data-design-id="{{ $design->id }}">
                                        <svg class="w-4 h-4 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </button>
                                </div>
                                @if($design->category)
                                <div class="absolute bottom-3 left-3">
                                    <span class="bg-white/90 text-gray-800 text-xs font-medium px-2 py-1 rounded-full">{{ $design->category }}</span>
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <a href="{{ route('marketplace.design.show', $design) }}" class="block">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors">{{ $design->title }}</h3>
                                </a>
                                <p class="text-gray-600 text-sm mb-2">by {{ $design->designer->name }}</p>
                                <p class="text-gray-500 text-xs mb-3 line-clamp-2">{{ Str::limit($design->description, 80) }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-purple-600">LKR {{ number_format($design->price, 2) }}</span>
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
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $designs->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No designs found</h3>
                        <p class="text-gray-600 mb-4">Try adjusting your search or filters to find what you're looking for.</p>
                        <a href="{{ route('marketplace.index') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg font-medium hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                            Browse All Designs
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- JavaScript for cart and wishlist functionality -->
        <script>
            // Shopping Cart functionality
            let wishlist = JSON.parse(localStorage.getItem('designWishlist')) || [];

            function toggleWishlist(designId, name, price, image, designer) {
                const existingIndex = wishlist.findIndex(item => item.id === designId);
                if (existingIndex !== -1) {
                    wishlist.splice(existingIndex, 1);
                    showCartNotification('Removed from wishlist', 'info');
                } else {
                    wishlist.push({
                        id: designId,
                        name: name,
                        price: parseFloat(price),
                        image: image,
                        designer: designer
                    });
                    showCartNotification('Added to wishlist!', 'success');
                }
                localStorage.setItem('designWishlist', JSON.stringify(wishlist));
                updateWishlistIcons();
            }

            function updateWishlistIcons() {
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    const designId = btn.getAttribute('data-design-id');
                    const isInWishlist = wishlist.some(item => item.id === designId);
                    const icon = btn.querySelector('svg');
                    if (isInWishlist) {
                        icon.setAttribute('fill', 'currentColor');
                        icon.classList.add('text-red-500');
                    } else {
                        icon.setAttribute('fill', 'none');
                        icon.classList.remove('text-red-500');
                    }
                });
            }

            // Initialize
            document.addEventListener('DOMContentLoaded', function() {
                updateCartCount(); // Use global function from navigation
                updateWishlistIcons();

                // Add to cart buttons
                document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const designId = btn.getAttribute('data-design-id');
                        const quantity = 1; // Default quantity
                        
                        addToCart(designId, quantity); // Use global function from navigation
                    });
                });

                // Wishlist buttons
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const designId = btn.getAttribute('data-design-id');
                        const productCard = btn.closest('.group');
                        const name = productCard.querySelector('h3').textContent;
                        const priceText = productCard.querySelector('.text-2xl').textContent;
                        const price = parseFloat(priceText.replace('$', ''));
                        const image = productCard.querySelector('img')?.src || '';
                        const designer = productCard.querySelector('.text-gray-600').textContent.replace('by ', '');
                        
                        toggleWishlist(designId, name, price, image, designer);
                    });
                });

                // Cart button functionality is now handled by the link href
            });
        </script>
    </body>
</html>