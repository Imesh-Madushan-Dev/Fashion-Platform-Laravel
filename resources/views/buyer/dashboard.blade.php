<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buyer Dashboard - DesignSphere</title>
    
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

    <!-- Main Content -->
    <div class="pt-16 min-h-screen">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-purple-600 via-purple-700 to-indigo-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-white mb-4">Welcome back, {{ auth('buyer')->user()->name }}! 👋</h1>
                    <p class="text-xl text-purple-100 mb-8">Discover amazing fashion designs from talented creators</p>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white">
                            <div class="text-3xl font-bold">{{ $stats['total_orders'] ?? 0 }}</div>
                            <div class="text-purple-100">Total Orders</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white">
                            <div class="text-3xl font-bold">LKR {{ number_format($stats['total_spent'] ?? 0, 2) }}</div>
                            <div class="text-purple-100">Total Spent</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white">
                            <div class="text-3xl font-bold">{{ $featuredDesigns->count() }}</div>
                            <div class="text-purple-100">Available Designs</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" id="search-input" placeholder="Search designs, designers, categories..." 
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>
                    
                    <!-- Filter Options -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Category Filter -->
                        <select id="category-filter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">All Categories</option>
                            <option value="casual">Casual Wear</option>
                            <option value="formal">Formal Wear</option>
                            <option value="evening">Evening Wear</option>
                            <option value="sports">Sports Wear</option>
                            <option value="accessories">Accessories</option>
                        </select>
                        
                        <!-- Price Filter -->
                        <select id="price-filter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">All Prices</option>
                            <option value="0-50">$0 - $50</option>
                            <option value="50-100">$50 - $100</option>
                            <option value="100-200">$100 - $200</option>
                            <option value="200+">$200+</option>
                        </select>
                        
                        <!-- Sort Filter -->
                        <select id="sort-filter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="popular">Most Popular</option>
                        </select>
                        
                        <!-- Clear Filters -->
                        <button id="clear-filters" class="px-6 py-3 text-gray-600 hover:text-purple-600 border border-gray-300 rounded-xl hover:border-purple-500 transition-colors">
                            Clear All
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Action Buttons -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <button data-filter="featured" class="quick-filter-btn bg-gradient-to-r from-yellow-400 to-orange-500 text-white p-4 rounded-xl hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Featured
                </button>
                <button data-filter="trending" class="quick-filter-btn bg-gradient-to-r from-red-400 to-pink-500 text-white p-4 rounded-xl hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    Trending
                </button>
                <button data-filter="new" class="quick-filter-btn bg-gradient-to-r from-green-400 to-blue-500 text-white p-4 rounded-xl hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    New Arrivals
                </button>
                <button data-filter="sale" class="quick-filter-btn bg-gradient-to-r from-purple-400 to-indigo-500 text-white p-4 rounded-xl hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    On Sale
                </button>
            </div>

            <!-- Active Filters Display -->
            <div id="active-filters" class="mb-6 hidden">
                <div class="flex items-center space-x-2 mb-4">
                    <span class="text-sm font-medium text-gray-700">Active filters:</span>
                    <div id="filter-tags" class="flex flex-wrap gap-2"></div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Fashion Designs</h2>
                    <div class="flex items-center space-x-4">
                        <span id="results-count" class="text-gray-600">{{ $featuredDesigns->count() }} designs found</span>
                        <div class="flex items-center space-x-2">
                            <button id="grid-view" class="p-2 text-purple-600 bg-purple-100 rounded-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm0 11h7v7h-7v-7z"/>
                                </svg>
                            </button>
                            <button id="list-view" class="p-2 text-gray-400 hover:text-purple-600 rounded-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Products Loading State -->
                <div id="loading-state" class="hidden text-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600 mx-auto mb-4"></div>
                    <p class="text-gray-600">Loading designs...</p>
                </div>

                <!-- Products Container -->
                <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($featuredDesigns as $design)
                    <div class="product-card bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100" 
                         data-category="{{ strtolower($design->category ?? 'general') }}" 
                         data-price="{{ $design->price }}" 
                         data-created="{{ $design->created_at->timestamp }}"
                         data-featured="{{ $design->is_featured ? 'true' : 'false' }}">
                        
                        <div class="relative aspect-square overflow-hidden">
                            @if($design->image_url)
                                <img src="{{ $design->image_url }}" alt="{{ $design->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Overlay Actions -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <button class="quick-view-btn bg-white text-gray-800 p-3 rounded-full hover:bg-gray-100 transition-colors" 
                                            data-design-id="{{ $design->id }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <button class="wishlist-btn bg-white text-red-500 p-3 rounded-full hover:bg-red-50 transition-colors" 
                                            data-design-id="{{ $design->id }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Badges -->
                            <div class="absolute top-3 left-3">
                                @if($design->is_featured)
                                    <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full">FEATURED</span>
                                @endif
                            </div>
                            <div class="absolute top-3 right-3">
                                @if($design->created_at->diffInDays() < 7)
                                    <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">NEW</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="mb-3">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors">
                                    <a href="{{ route('marketplace.design.show', $design) }}">{{ $design->title }}</a>
                                </h3>
                                <p class="text-sm text-gray-600">by {{ $design->designer->name ?? 'Unknown' }}</p>
                                @if($design->category)
                                    <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full mt-1">{{ $design->category }}</span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="text-xl font-bold text-purple-600">LKR{{ number_format($design->price, 2) }}</div>
                                <button class="text-sm add-to-cart-btn bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg font-medium hover:from-purple-700 hover:to-pink-700 transition-all duration-200 transform hover:scale-105" 
                                        data-design-id="{{ $design->id }}" 
                                        data-name="{{ $design->title }}" 
                                        data-price="{{ $design->price }}" 
                                        data-image="{{ $design->image_url }}" 
                                        data-designer="{{ $design->designer->name ?? 'Unknown' }}">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No designs found</h3>
                        <p class="text-gray-600">Try adjusting your search or filter criteria</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div id="quick-view-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div id="quick-view-content">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Shopping Cart functionality
        let cart = JSON.parse(localStorage.getItem('designCart')) || [];
        let wishlist = JSON.parse(localStorage.getItem('designWishlist')) || [];

        function updateCartCount() {
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                if (totalItems > 0) {
                    cartCount.textContent = totalItems;
                    cartCount.classList.remove('hidden');
                } else {
                    cartCount.classList.add('hidden');
                }
            }
        }

        function addToCart(designId, name, price, image, designer, buttonElement) {
            const existingItem = cart.find(item => item.id === designId);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: designId,
                    name: name,
                    price: parseFloat(price),
                    image: image,
                    designer: designer,
                    quantity: 1
                });
            }
            localStorage.setItem('designCart', JSON.stringify(cart));
            updateCartCount();
            
            // Update button text and style
            if (buttonElement) {
                const originalText = buttonElement.innerHTML;
                buttonElement.innerHTML = '<svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Added';
                buttonElement.className = buttonElement.className.replace('from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700', 'from-green-600 to-green-600 hover:from-green-700 hover:to-green-700');
                
                // Reset button after 2 seconds
                setTimeout(() => {
                    buttonElement.innerHTML = originalText;
                    buttonElement.className = buttonElement.className.replace('from-green-600 to-green-600 hover:from-green-700 hover:to-green-700', 'from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700');
                }, 2000);
            }
            
            showNotification('Added to cart successfully!', 'success');
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

        // Filter and Search functionality
        function filterProducts() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const categoryFilter = document.getElementById('category-filter').value;
            const priceFilter = document.getElementById('price-filter').value;
            const sortFilter = document.getElementById('sort-filter').value;
            
            let products = Array.from(document.querySelectorAll('.product-card'));
            let filteredProducts = products;

            // Search filter
            if (searchTerm) {
                filteredProducts = filteredProducts.filter(product => {
                    const title = product.querySelector('h3').textContent.toLowerCase();
                    const designer = product.querySelector('.text-gray-600').textContent.toLowerCase();
                    return title.includes(searchTerm) || designer.includes(searchTerm);
                });
            }

            // Category filter
            if (categoryFilter) {
                filteredProducts = filteredProducts.filter(product => {
                    return product.dataset.category === categoryFilter;
                });
            }

            // Price filter
            if (priceFilter) {
                filteredProducts = filteredProducts.filter(product => {
                    const price = parseFloat(product.dataset.price);
                    if (priceFilter === '0-50') return price <= 50;
                    if (priceFilter === '50-100') return price > 50 && price <= 100;
                    if (priceFilter === '100-200') return price > 100 && price <= 200;
                    if (priceFilter === '200+') return price > 200;
                    return true;
                });
            }

            // Sort products
            filteredProducts.sort((a, b) => {
                const priceA = parseFloat(a.dataset.price);
                const priceB = parseFloat(b.dataset.price);
                const createdA = parseInt(a.dataset.created);
                const createdB = parseInt(b.dataset.created);

                switch (sortFilter) {
                    case 'price-low': return priceA - priceB;
                    case 'price-high': return priceB - priceA;
                    case 'oldest': return createdA - createdB;
                    case 'newest': 
                    default: return createdB - createdA;
                }
            });

            // Hide all products
            products.forEach(product => product.style.display = 'none');
            
            // Show filtered products
            filteredProducts.forEach(product => product.style.display = 'block');

            // Update results count
            document.getElementById('results-count').textContent = `${filteredProducts.length} designs found`;

            updateActiveFilters();
        }

        function updateActiveFilters() {
            const activeFiltersDiv = document.getElementById('active-filters');
            const filterTags = document.getElementById('filter-tags');
            const tags = [];

            const searchTerm = document.getElementById('search-input').value;
            const categoryFilter = document.getElementById('category-filter').value;
            const priceFilter = document.getElementById('price-filter').value;
            const sortFilter = document.getElementById('sort-filter').value;

            if (searchTerm) tags.push({ label: `Search: ${searchTerm}`, type: 'search' });
            if (categoryFilter) tags.push({ label: `Category: ${categoryFilter}`, type: 'category' });
            if (priceFilter) tags.push({ label: `Price: ${priceFilter}`, type: 'price' });
            if (sortFilter !== 'newest') tags.push({ label: `Sort: ${sortFilter}`, type: 'sort' });

            if (tags.length > 0) {
                activeFiltersDiv.classList.remove('hidden');
                filterTags.innerHTML = tags.map(tag => 
                    `<span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium flex items-center">
                        ${tag.label}
                        <button onclick="clearFilter('${tag.type}')" class="ml-2 hover:text-purple-600">×</button>
                    </span>`
                ).join('');
            } else {
                activeFiltersDiv.classList.add('hidden');
            }
        }

        function clearFilter(type) {
            switch (type) {
                case 'search': document.getElementById('search-input').value = ''; break;
                case 'category': document.getElementById('category-filter').value = ''; break;
                case 'price': document.getElementById('price-filter').value = ''; break;
                case 'sort': document.getElementById('sort-filter').value = 'newest'; break;
            }
            filterProducts();
        }

        function clearAllFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('category-filter').value = '';
            document.getElementById('price-filter').value = '';
            document.getElementById('sort-filter').value = 'newest';
            filterProducts();
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();

            // Event listeners for filters
            document.getElementById('search-input').addEventListener('input', filterProducts);
            document.getElementById('category-filter').addEventListener('change', filterProducts);
            document.getElementById('price-filter').addEventListener('change', filterProducts);
            document.getElementById('sort-filter').addEventListener('change', filterProducts);
            document.getElementById('clear-filters').addEventListener('click', clearAllFilters);

            // Quick filter buttons
            document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const filter = this.dataset.filter;
                    
                    // Reset all filters first
                    clearAllFilters();
                    
                    // Apply specific filter
                    if (filter === 'featured') {
                        // Show only featured products
                        document.querySelectorAll('.product-card').forEach(product => {
                            product.style.display = product.dataset.featured === 'true' ? 'block' : 'none';
                        });
                    } else if (filter === 'new') {
                        document.getElementById('sort-filter').value = 'newest';
                        filterProducts();
                    } else if (filter === 'trending') {
                        document.getElementById('sort-filter').value = 'popular';
                        filterProducts();
                    }
                });
            });

            // Add to cart buttons
            document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const designId = btn.getAttribute('data-design-id');
                    const name = btn.getAttribute('data-name');
                    const price = btn.getAttribute('data-price');
                    const image = btn.getAttribute('data-image');
                    const designer = btn.getAttribute('data-designer');
                    
                    addToCart(designId, name, price, image, designer, btn);
                });
            });

            // Quick view functionality
            document.querySelectorAll('.quick-view-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const designId = btn.getAttribute('data-design-id');
                    // TODO: Implement quick view modal
                    showNotification('Quick view coming soon!', 'info');
                });
            });

            // Wishlist buttons
            document.querySelectorAll('.wishlist-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // TODO: Implement wishlist functionality
                    showNotification('Wishlist feature coming soon!', 'info');
                });
            });

            // View toggle buttons
            document.getElementById('grid-view').addEventListener('click', function() {
                document.getElementById('products-grid').className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6';
                this.classList.add('text-purple-600', 'bg-purple-100');
                this.classList.remove('text-gray-400');
                document.getElementById('list-view').classList.add('text-gray-400');
                document.getElementById('list-view').classList.remove('text-purple-600', 'bg-purple-100');
            });

            document.getElementById('list-view').addEventListener('click', function() {
                document.getElementById('products-grid').className = 'grid grid-cols-1 gap-4';
                this.classList.add('text-purple-600', 'bg-purple-100');
                this.classList.remove('text-gray-400');
                document.getElementById('grid-view').classList.add('text-gray-400');
                document.getElementById('grid-view').classList.remove('text-purple-600', 'bg-purple-100');
            });
        });
    </script>
</body>
</html>