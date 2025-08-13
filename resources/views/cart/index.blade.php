<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Shopping Cart - DesignSphere</title>
        
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
                    <span class="text-gray-900 font-medium">Shopping Cart</span>
                </div>
            </div>
        </div>

        <!-- Cart Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
                <p class="text-gray-600 mt-2">Review your items before checkout</p>
            </div>

            <div id="cart-content">
                <!-- Loading state -->
                <div id="loading-state" class="text-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600 mx-auto mb-4"></div>
                    <p class="text-gray-600">Loading your cart...</p>
                </div>

                <!-- Empty cart state -->
                <div id="empty-cart" class="text-center py-12 hidden">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Your cart is empty</h3>
                    <p class="text-gray-600 mb-6">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('marketplace.index') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-3 rounded-lg font-medium hover:from-purple-700 hover:to-pink-700 transition-all duration-200 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                        </svg>
                        Continue Shopping
                    </a>
                </div>

                <!-- Cart items -->
                <div id="cart-items" class="hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Items list -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="p-6 border-b border-gray-200">
                                    <h2 class="text-xl font-semibold text-gray-900">Cart Items</h2>
                                </div>
                                <div id="cart-items-list" class="divide-y divide-gray-200">
                                    <!-- Cart items will be populated here -->
                                </div>
                            </div>
                        </div>

                        <!-- Order summary -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-4">
                                <h2 class="text-xl font-semibold text-gray-900 mb-6">Order Summary</h2>
                                
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Subtotal</span>
                                        <span id="subtotal" class="text-gray-900 font-medium">LKR 0.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Shipping</span>
                                        <span class="text-gray-900 font-medium">Free</span>
                                    </div>
                                    <div class="border-t border-gray-200 pt-4">
                                        <div class="flex justify-between text-lg font-semibold">
                                            <span class="text-gray-900">Total</span>
                                            <span id="total" class="text-purple-600">LKR0.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 space-y-3">
                                    <button id="checkout-btn" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-4 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        Proceed to Checkout
                                    </button>
                                    <a href="{{ route('marketplace.index') }}" class="w-full block text-center text-purple-600 hover:text-purple-700 py-2 font-medium transition-colors">
                                        Continue Shopping
                                    </a>
                                </div>

                                <!-- Login prompt (only show if not logged in) -->
                                @if(!auth('buyer')->check() && !auth('designer')->check())
                                <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <p class="text-sm text-blue-800 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Login to save your cart and complete checkout
                                    </p>
                                    <a href="{{ url('/buyer/login') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                        Login as Buyer →
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript -->
        <script>
            let cart = JSON.parse(localStorage.getItem('designCart')) || [];

            // Use global updateCartCount from navigation

            async function normalizeCart() {
                // Clean and normalize cart data structure
                let normalizedCart = cart.map(item => {
                    return {
                        id: item.id ? item.id.toString() : item.design_id ? item.design_id.toString() : null,
                        quantity: parseInt(item.quantity) || 1
                    };
                }).filter(item => item.id !== null);
                
                // Remove duplicates by ID
                const uniqueCart = [];
                const seenIds = new Set();
                
                for (const item of normalizedCart) {
                    if (!seenIds.has(item.id)) {
                        seenIds.add(item.id);
                        uniqueCart.push(item);
                    } else {
                        // If duplicate, add quantities
                        const existingItem = uniqueCart.find(i => i.id === item.id);
                        if (existingItem) {
                            existingItem.quantity += item.quantity;
                        }
                    }
                }
                
                cart = uniqueCart;
                localStorage.setItem('designCart', JSON.stringify(cart));
                
                console.log('Normalized cart:', cart);
            }

            function removeFromCart(designId) {
                cart = cart.filter(item => item.id !== designId);
                localStorage.setItem('designCart', JSON.stringify(cart));
                updateCartCount(); // Use global function
                loadCartData();
                showCartNotification('Item removed from cart', 'info'); // Use global function
            }

            function updateQuantity(designId, newQuantity) {
                if (newQuantity <= 0) {
                    removeFromCart(designId);
                    return;
                }
                
                const item = cart.find(item => item.id === designId);
                if (item) {
                    item.quantity = parseInt(newQuantity);
                    localStorage.setItem('designCart', JSON.stringify(cart));
                    updateCartCount(); // Use global function
                    loadCartData();
                }
            }

            // Use global showCartNotification from navigation

            async function loadCartData() {
                const loadingState = document.getElementById('loading-state');
                const emptyCart = document.getElementById('empty-cart');
                const cartItems = document.getElementById('cart-items');

                if (cart.length === 0) {
                    loadingState.classList.add('hidden');
                    emptyCart.classList.remove('hidden');
                    cartItems.classList.add('hidden');
                    return;
                }

                try {
                    console.log('Sending cart data:', cart);
                    const response = await fetch('{{ route("cart.data") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ cartItems: cart })
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    console.log('Received cart data:', data);
                    
                    // Check if we received fewer designs than requested - means some were invalid
                    if (data.designs && data.designs.length < cart.length) {
                        console.log('Some cart items were invalid, cleaning cart...');
                        const validIds = data.designs.map(d => d.id.toString());
                        cart = cart.filter(item => validIds.includes(item.id.toString()));
                        localStorage.setItem('designCart', JSON.stringify(cart));
                        updateCartCount();
                        showCartNotification('Some invalid items were removed from your cart', 'info');
                    }
                    
                    loadingState.classList.add('hidden');
                    emptyCart.classList.add('hidden');
                    cartItems.classList.remove('hidden');

                    if (data.designs && data.designs.length > 0) {
                        renderCartItems(data.designs);
                        updateSummary(data.total);
                    } else {
                        // Show empty cart if no designs found
                        loadingState.classList.add('hidden');
                        emptyCart.classList.remove('hidden');
                        cartItems.classList.add('hidden');
                        cart = []; // Clear invalid cart
                        localStorage.setItem('designCart', JSON.stringify(cart));
                        updateCartCount();
                    }

                } catch (error) {
                    console.error('Error loading cart data:', error);
                    loadingState.classList.add('hidden');
                    emptyCart.classList.remove('hidden');
                    cartItems.classList.add('hidden');
                    showCartNotification('Error loading cart data: ' + error.message, 'error');
                }
            }

            function renderCartItems(designs) {
                const container = document.getElementById('cart-items-list');
                
                container.innerHTML = designs.map(design => `
                    <div class="p-6 cart-item" data-design-id="${design.id}">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img src="${design.image_url || 'https://via.placeholder.com/80x80/8B5CF6/FFFFFF?text=No+Image'}" 
                                     alt="${design.title}" 
                                     class="w-20 h-20 object-cover rounded-lg">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">${design.title}</h3>
                                <p class="text-gray-600">by ${design.designer}</p>
                                <p class="text-purple-600 font-semibold">LKR ${design.price.toFixed(2)}</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button onclick="updateQuantity('${design.id}', ${design.quantity - 1})" 
                                            class="px-3 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </button>
                                    <input type="number" min="1" value="${design.quantity}" 
                                           onchange="updateQuantity('${design.id}', this.value)"
                                           class="w-16 px-2 py-2 text-center border-0 focus:ring-0 focus:outline-none">
                                    <button onclick="updateQuantity('${design.id}', ${design.quantity + 1})" 
                                            class="px-3 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-gray-900">LKR ${design.subtotal.toFixed(2)}</p>
                                </div>
                                <button onclick="removeFromCart('${design.id}')" 
                                        class="text-red-500 hover:text-red-700 p-2 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                `).join('');
            }

            function updateSummary(total) {
                document.getElementById('subtotal').textContent = `LKR ${total.toFixed(2)}`;
                document.getElementById('total').textContent = `LKR ${total.toFixed(2)}`;
            }

            // Initialize
            document.addEventListener('DOMContentLoaded', async function() {
                // Normalize cart data on page load
                await normalizeCart();
                updateCartCount();
                loadCartData();

                // Checkout button
                document.getElementById('checkout-btn').addEventListener('click', async function() {
                    if (cart.length === 0) {
                        showCartNotification('Your cart is empty', 'error');
                        return;
                    }
                    
                    @if(auth('buyer')->check())
                        // User is logged in as buyer, proceed to checkout
                        this.disabled = true;
                        this.innerHTML = '<div class="animate-spin rounded-full h-6 w-6 border-b-2 border-white mx-auto"></div>';
                        
                        try {
                            // Normalize cart data before sending
                            await normalizeCart();
                            console.log('Cart data being sent:', cart);
                            const response = await fetch('{{ route("cart.checkout") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ cartItems: cart })
                            });

                            const data = await response.json();
                            
                            if (response.ok && data.success) {
                                showCartNotification('Orders created successfully! Redirecting to payment...', 'success');
                                setTimeout(() => {
                                    window.location.href = data.redirect_url;
                                }, 1500);
                            } else {
                                console.error('Checkout failed:', data);
                                let errorMessage = data.message || 'Checkout failed';
                                if (data.errors) {
                                    errorMessage += ': ' + Object.values(data.errors).flat().join(', ');
                                }
                                showCartNotification(errorMessage, 'error');
                                this.disabled = false;
                                this.innerHTML = 'Proceed to Checkout';
                            }
                        } catch (error) {
                            console.error('Checkout error:', error);
                            showCartNotification('Checkout failed. Please try again.', 'error');
                            this.disabled = false;
                            this.innerHTML = 'Proceed to Checkout';
                        }
                    @elseif(auth('designer')->check())
                        // Designer cannot checkout, they need buyer account
                        showCartNotification('Please use a buyer account to purchase designs', 'error');
                    @else
                        // Not logged in, redirect to login
                        showCartNotification('Please login to proceed with checkout', 'info');
                        setTimeout(() => {
                            window.location.href = '{{ url("/buyer/login") }}';
                        }, 2000);
                    @endif
                });
            });
        </script>
    </body>
</html>