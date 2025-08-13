<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Designer Dashboard - DesignSphere</title>
    
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
        <div class="bg-gradient-to-r from-blue-600 via-indigo-700 to-purple-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-white mb-4">Welcome back, {{ auth('designer')->user()->name }}! 🎨</h1>
                    <p class="text-xl text-blue-100 mb-8">Create, manage, and showcase your amazing designs</p>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white">
                            <div class="text-xl font-bold">{{ $designCount ?? 0 }}</div>
                            <div class="text-blue-100">Total Designs</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white">
                            <div class="text-xl font-bold">{{ $activeDesigns ?? 0 }}</div>
                            <div class="text-blue-100">Active Designs</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white">
                            <div class="text-xl font-bold">{{ $totalOrders ?? 0 }}</div>
                            <div class="text-blue-100">Total Orders</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-white">
                            <div class="text-xl font-bold">LKR {{ number_format($totalRevenue ?? 0, 2) }}</div>
                            <div class="text-blue-100">Revenue</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <a href="{{ route('designer.designs.create') }}" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl hover:shadow-2xl transition-all duration-200 transform hover:scale-105 group">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4 group-hover:bg-white/30 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Upload Design</h3>
                            <p class="text-green-100 text-sm">Add new creation</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('designer.designs.index') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-2xl hover:shadow-2xl transition-all duration-200 transform hover:scale-105 group">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4 group-hover:bg-white/30 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Manage Designs</h3>
                            <p class="text-blue-100 text-sm">Edit portfolio</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('designer.orders') }}" class="bg-gradient-to-r from-purple-500 to-pink-600 text-white p-6 rounded-2xl hover:shadow-2xl transition-all duration-200 transform hover:scale-105 group">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4 group-hover:bg-white/30 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">View Orders</h3>
                            <p class="text-purple-100 text-sm">Track sales</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('designer.profile') }}" class="bg-gradient-to-r from-orange-500 to-red-600 text-white p-6 rounded-2xl hover:shadow-2xl transition-all duration-200 transform hover:scale-105 group">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4 group-hover:bg-white/30 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Edit Profile</h3>
                            <p class="text-orange-100 text-sm">Update info</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Design Management Section -->
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
                            <input type="text" id="search-input" placeholder="Search your designs..." 
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <!-- Filter Options -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Status Filter -->
                        <select id="status-filter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="featured">Featured</option>
                        </select>
                        
                        <!-- Category Filter -->
                        <select id="category-filter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Categories</option>
                            <option value="casual">Casual Wear</option>
                            <option value="formal">Formal Wear</option>
                            <option value="evening">Evening Wear</option>
                            <option value="sports">Sports Wear</option>
                            <option value="accessories">Accessories</option>
                        </select>
                        
                        <!-- Sort Filter -->
                        <select id="sort-filter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="popular">Most Popular</option>
                        </select>
                        
                        <!-- Clear Filters -->
                        <button id="clear-filters" class="px-6 py-3 text-gray-600 hover:text-blue-600 border border-gray-300 rounded-xl hover:border-blue-500 transition-colors">
                            Clear All
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Designs Section -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Your Designs</h2>
                    <div class="flex items-center space-x-4">
                        <span id="results-count" class="text-gray-600">{{ $recentDesigns->count() }} designs</span>
                        <div class="flex items-center space-x-2">
                            <button id="grid-view" class="p-2 text-blue-600 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm0 11h7v7h-7v-7z"/>
                                </svg>
                            </button>
                            <button id="list-view" class="p-2 text-gray-400 hover:text-blue-600 rounded-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Designs Container -->
                <div id="designs-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($recentDesigns as $design)
                    <div class="design-card bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100" 
                         data-category="{{ strtolower($design->category ?? 'general') }}" 
                         data-price="{{ $design->price }}" 
                         data-created="{{ $design->created_at->timestamp }}"
                         data-status="{{ $design->is_active ? 'active' : 'inactive' }}"
                         data-featured="{{ $design->is_featured ? 'featured' : '' }}">
                        
                        <div class="relative aspect-square overflow-hidden">
                            @if($design->image_url)
                                <img src="{{ $design->image_url }}" alt="{{ $design->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Overlay Actions -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="{{ route('designer.designs.edit', $design) }}" class="bg-white text-gray-800 p-3 rounded-full hover:bg-gray-100 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <button class="toggle-status-btn bg-white text-gray-800 p-3 rounded-full hover:bg-gray-100 transition-colors" 
                                            data-design-id="{{ $design->id }}" 
                                            data-status="{{ $design->is_active ? 'active' : 'inactive' }}">
                                        @if($design->is_active)
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                            </svg>
                                        @endif
                                    </button>
                                </div>
                            </div>

                            <!-- Status Badges -->
                            <div class="absolute top-3 left-3 flex flex-col gap-1">
                                @if($design->is_featured)
                                    <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full">FEATURED</span>
                                @endif
                                @if($design->is_active)
                                    <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">ACTIVE</span>
                                @else
                                    <span class="bg-gray-500 text-white text-xs font-bold px-2 py-1 rounded-full">INACTIVE</span>
                                @endif
                            </div>

                            <!-- Sales Badge -->
                            <div class="absolute top-3 right-3">
                                @if($design->orders_count ?? 0 > 0)
                                    <span class="bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ $design->orders_count }} sold</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="mb-3">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">
                                    <a href="{{ route('designer.designs.show', $design) }}">{{ $design->title }}</a>
                                </h3>
                                @if($design->category)
                                    <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full mt-1">{{ $design->category }}</span>
                                @endif
                                <p class="text-sm text-gray-600 mt-2">Created {{ $design->created_at->diffForHumans() }}</p>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="text-md font-bold text-blue-600">LKR{{ number_format($design->price, 2) }}</div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('designer.designs.edit', $design) }}" 
                                       class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                        Edit
                                    </a>
                                    <a href="{{ route('marketplace.design.show', $design) }}" target="_blank"
                                       class="bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-700 transition-colors">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No designs yet</h3>
                        <p class="text-gray-600 mb-4">Start creating your first design to showcase your talent</p>
                        <a href="{{ route('designer.designs.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Upload Your First Design
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Orders Section -->
            @if($recentOrders && $recentOrders->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Recent Orders</h3>
                    <a href="{{ route('designer.orders') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">View All</a>
                </div>
                <div class="space-y-4">
                    @foreach($recentOrders->take(5) as $order)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $order->design->title ?? 'Design' }}</p>
                                <p class="text-sm text-gray-600">by {{ $order->buyer->name ?? 'Unknown Buyer' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900">LKR {{ number_format($order->total_amount ?? 0, 2) }}</p>
                            <p class="text-sm text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- JavaScript -->
    <script>
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
        function filterDesigns() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const statusFilter = document.getElementById('status-filter').value;
            const categoryFilter = document.getElementById('category-filter').value;
            const sortFilter = document.getElementById('sort-filter').value;
            
            let designs = Array.from(document.querySelectorAll('.design-card'));
            let filteredDesigns = designs;

            // Search filter
            if (searchTerm) {
                filteredDesigns = filteredDesigns.filter(design => {
                    const title = design.querySelector('h3').textContent.toLowerCase();
                    return title.includes(searchTerm);
                });
            }

            // Status filter
            if (statusFilter) {
                filteredDesigns = filteredDesigns.filter(design => {
                    if (statusFilter === 'featured') {
                        return design.dataset.featured === 'featured';
                    }
                    return design.dataset.status === statusFilter;
                });
            }

            // Category filter
            if (categoryFilter) {
                filteredDesigns = filteredDesigns.filter(design => {
                    return design.dataset.category === categoryFilter;
                });
            }

            // Sort designs
            filteredDesigns.sort((a, b) => {
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

            // Hide all designs
            designs.forEach(design => design.style.display = 'none');
            
            // Show filtered designs
            filteredDesigns.forEach(design => design.style.display = 'block');

            // Update results count
            document.getElementById('results-count').textContent = `${filteredDesigns.length} designs`;
        }

        function clearAllFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('status-filter').value = '';
            document.getElementById('category-filter').value = '';
            document.getElementById('sort-filter').value = 'newest';
            filterDesigns();
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Event listeners for filters
            document.getElementById('search-input').addEventListener('input', filterDesigns);
            document.getElementById('status-filter').addEventListener('change', filterDesigns);
            document.getElementById('category-filter').addEventListener('change', filterDesigns);
            document.getElementById('sort-filter').addEventListener('change', filterDesigns);
            document.getElementById('clear-filters').addEventListener('click', clearAllFilters);

            // Toggle status buttons
            document.querySelectorAll('.toggle-status-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const designId = this.dataset.designId;
                    const currentStatus = this.dataset.status;
                    
                    // TODO: Implement AJAX call to toggle status
                    showNotification('Status toggle feature coming soon!', 'info');
                });
            });

            // View toggle buttons
            document.getElementById('grid-view').addEventListener('click', function() {
                document.getElementById('designs-grid').className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6';
                this.classList.add('text-blue-600', 'bg-blue-100');
                this.classList.remove('text-gray-400');
                document.getElementById('list-view').classList.add('text-gray-400');
                document.getElementById('list-view').classList.remove('text-blue-600', 'bg-blue-100');
            });

            document.getElementById('list-view').addEventListener('click', function() {
                document.getElementById('designs-grid').className = 'grid grid-cols-1 gap-4';
                this.classList.add('text-blue-600', 'bg-blue-100');
                this.classList.remove('text-gray-400');
                document.getElementById('grid-view').classList.add('text-gray-400');
                document.getElementById('grid-view').classList.remove('text-blue-600', 'bg-blue-100');
            });
        });
    </script>
</body>
</html>