<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $design->title }} - DesignSphere</title>
        
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

        <!-- Breadcrumb -->
        <div class="bg-white shadow-sm border-b border-gray-100 pt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center space-x-4 text-sm">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-purple-600 transition-colors">Home</a>
                    <span class="text-gray-400">/</span>
                    <a href="{{ route('marketplace.index') }}" class="text-gray-600 hover:text-purple-600 transition-colors">Marketplace</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-900 font-medium">{{ Str::limit($design->title, 30) }}</span>
                </div>
            </div>
        </div>

        <!-- Product Detail Section -->
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Product Image -->
                    <div class="space-y-4">
                        <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden">
                            @if($design->image_url)
                                <img src="{{ $design->image_url }}" alt="{{ $design->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                                    <span class="text-gray-400 text-2xl">No Image Available</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="space-y-6">
                        <!-- Title and Designer -->
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $design->title }}</h1>
                            <p class="text-lg text-gray-600 mb-4">by <span class="font-semibold text-purple-600">{{ $design->designer->name }}</span></p>
                            
                            <!-- Category Badge -->
                            @if($design->category)
                            <div class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">
                                {{ $design->category }}
                            </div>
                            @endif
                        </div>

                        <!-- Price -->
                        <div class="border-t border-gray-200 pt-6">
                            <div class="flex items-center space-x-4">
                                <span class="text-2xl font-bold text-purple-600">LKR {{ number_format($design->price, 2) }}</span>
                                @if($design->is_featured)
                                <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">Featured</span>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $design->description }}</p>
                        </div>

                        <!-- Tags -->
                        @if($design->tags && count($design->tags) > 0)
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($design->tags as $tag)
                                <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Actions -->
                        <div class="border-t border-gray-200 pt-6">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <button class="add-to-cart-btn flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center"
                                        data-design-id="{{ $design->id }}" 
                                        data-name="{{ $design->title }}" 
                                        data-price="{{ $design->price }}" 
                                        data-image="{{ $design->image_url }}" 
                                        data-designer="{{ $design->designer->name }}">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    Add to Cart
                                </button>
                                
                                <button class="wishlist-btn px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:border-red-500 hover:text-red-500 transition-all duration-200 flex items-center justify-center"
                                        data-design-id="{{ $design->id }}">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    Wishlist
                                </button>
                            </div>
                        </div>

                        <!-- Designer Info -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">About the Designer</h3>
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-lg">{{ substr($design->designer->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $design->designer->name }}</p>
                                    <p class="text-gray-600 text-sm">Fashion Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Products -->
        @if($relatedDesigns->count() > 0)
        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Related Designs</h2>
                    <p class="text-gray-600 mt-2">More from the same category</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedDesigns as $relatedDesign)
                    <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 overflow-hidden border border-gray-100">
                        <div class="aspect-square bg-gray-100 relative overflow-hidden">
                            @if($relatedDesign->image_url)
                                <img src="{{ $relatedDesign->image_url }}" alt="{{ $relatedDesign->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3">
                                <button class="wishlist-btn w-8 h-8 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors duration-200" data-design-id="{{ $relatedDesign->id }}">
                                    <svg class="w-4 h-4 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <a href="{{ route('marketplace.design.show', $relatedDesign) }}" class="block">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors">{{ $relatedDesign->title }}</h3>
                            </a>
                            <p class="text-gray-600 text-sm mb-2">by {{ $relatedDesign->designer->name }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-purple-600">LKR {{ number_format($relatedDesign->price, 2) }}</span>
                                <button class="add-to-cart-btn bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:from-purple-700 hover:to-pink-700 transition-all duration-200 transform hover:scale-105" 
                                        data-design-id="{{ $relatedDesign->id }}" 
                                        data-name="{{ $relatedDesign->title }}" 
                                        data-price="{{ $relatedDesign->price }}" 
                                        data-image="{{ $relatedDesign->image_url }}" 
                                        data-designer="{{ $relatedDesign->designer->name }}">
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

        <!-- JavaScript for cart and wishlist functionality -->
        <script>
            // Shopping Cart functionality
            let wishlist = JSON.parse(localStorage.getItem('designWishlist')) || [];

            function addToCartWithButton(designId, buttonElement) {
                // Use global addToCart function from navigation
                addToCart(designId, 1);
                
                // Update button text and style
                if (buttonElement) {
                    const originalText = buttonElement.innerHTML;
                    const originalClasses = buttonElement.className;
                    buttonElement.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Added';
                    buttonElement.className = buttonElement.className.replace('from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700', 'from-green-600 to-green-600 hover:from-green-700 hover:to-green-700');
                    
                    // Reset button after 2 seconds
                    setTimeout(() => {
                        buttonElement.innerHTML = originalText;
                        buttonElement.className = originalClasses;
                    }, 2000);
                }
            }

            function toggleWishlist(designId, name, price, image, designer) {
                const existingIndex = wishlist.findIndex(item => item.id === designId);
                const btn = document.querySelector(`.wishlist-btn[data-design-id="${designId}"]`);
                
                if (existingIndex !== -1) {
                    wishlist.splice(existingIndex, 1);
                    showCartNotification('Removed from wishlist', 'info');
                    // Update button appearance
                    btn.classList.remove('border-red-500', 'text-red-500');
                    btn.classList.add('border-gray-300', 'text-gray-700');
                    const icon = btn.querySelector('svg');
                    icon.setAttribute('fill', 'none');
                    icon.classList.remove('text-red-500');
                } else {
                    wishlist.push({
                        id: designId,
                        name: name,
                        price: parseFloat(price),
                        image: image,
                        designer: designer
                    });
                    showCartNotification('Added to wishlist!', 'success');
                    // Update button appearance
                    btn.classList.remove('border-gray-300', 'text-gray-700');
                    btn.classList.add('border-red-500', 'text-red-500');
                    const icon = btn.querySelector('svg');
                    icon.setAttribute('fill', 'currentColor');
                    icon.classList.add('text-red-500');
                }
                localStorage.setItem('designWishlist', JSON.stringify(wishlist));
            }

            function updateWishlistIcons() {
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    const designId = btn.getAttribute('data-design-id');
                    const isInWishlist = wishlist.some(item => item.id === designId);
                    const icon = btn.querySelector('svg');
                    if (isInWishlist) {
                        if (btn.classList.contains('px-8')) { // Main wishlist button
                            btn.classList.remove('border-gray-300', 'text-gray-700');
                            btn.classList.add('border-red-500', 'text-red-500');
                        }
                        icon.setAttribute('fill', 'currentColor');
                        icon.classList.add('text-red-500');
                    } else {
                        if (btn.classList.contains('px-8')) { // Main wishlist button
                            btn.classList.remove('border-red-500', 'text-red-500');
                            btn.classList.add('border-gray-300', 'text-gray-700');
                        }
                        icon.setAttribute('fill', 'none');
                        icon.classList.remove('text-red-500');
                    }
                });
            }


            // Initialize
            document.addEventListener('DOMContentLoaded', function() {
                updateCartCount();
                updateWishlistIcons();

                // Add to cart buttons
                document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const designId = btn.getAttribute('data-design-id');
                        const name = btn.getAttribute('data-name');
                        const price = btn.getAttribute('data-price');
                        const image = btn.getAttribute('data-image');
                        const designer = btn.getAttribute('data-designer');
                        
                        addToCartWithButton(designId, btn);
                    });
                });

                // Wishlist buttons
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const designId = btn.getAttribute('data-design-id');
                        
                        // Get product info from the main product or card
                        let name, price, image, designer;
                        if (btn.classList.contains('px-8')) {
                            // Main product wishlist button
                            name = "{{ $design->title }}";
                            price = "{{ $design->price }}";
                            image = "{{ $design->image_url }}";
                            designer = "{{ $design->designer->name }}";
                        } else {
                            // Related product wishlist button
                            const productCard = btn.closest('.group');
                            name = productCard.querySelector('h3').textContent;
                            const priceText = productCard.querySelector('.text-xl').textContent;
                            price = parseFloat(priceText.replace('$', ''));
                            image = productCard.querySelector('img')?.src || '';
                            designer = productCard.querySelector('.text-gray-600').textContent.replace('by ', '');
                        }
                        
                        toggleWishlist(designId, name, price, image, designer);
                    });
                });

                // Cart button functionality is now handled by the link href
            });
        </script>
    </body>
</html>