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
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-50">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('buyer.orders.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to My Orders
                </a>
            </div>

            <!-- Modern Success Header -->
            <div class="relative overflow-hidden bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl shadow-2xl mb-8">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                <div class="relative p-12">
                    <div class="text-center">
                        <!-- Modern Success Icon -->
                        <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-white bg-opacity-20 mb-8 shadow-xl">
                            <svg class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        
                        <h1 class="text-5xl font-bold text-white mb-4">Payment Successful!</h1>
                        <p class="text-2xl text-green-100 mb-3">Thank you for your purchase</p>
                        <p class="text-green-200 text-lg">Your {{ $orders->count() }} orders have been paid and are now being processed</p>
                        
                        <!-- Celebration Animation -->
                        <div class="mt-8 flex justify-center space-x-2">
                            <div class="w-3 h-3 bg-white rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                            <div class="w-3 h-3 bg-white rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                            <div class="w-3 h-3 bg-white rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
                <!-- Display any session messages -->
                @if(session('success'))
                    <div class="xl:col-span-4 mb-6">
                        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Order Confirmation Details -->
                <div class="xl:col-span-3">
                    <!-- Modern Order Information -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl mb-8 border border-gray-100">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                                    <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Orders Confirmation ({{ $orders->count() }} items)
                                </h2>
                            </div>
                            
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 p-8 mb-8 rounded-2xl shadow-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-bold text-green-800 mb-2">
                                            Payment Processed Successfully
                                        </h3>
                                        <div class="text-green-700">
                                            <p class="leading-relaxed">Your payment of <strong class="text-green-800">LKR {{ number_format($totalAmount, 2) }}</strong> has been processed successfully. All designers will begin working on your orders shortly.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modern Design Information for each order -->
                            <div class="space-y-8">
                                @foreach($orders as $index => $order)
                                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8">
                                        <h4 class="text-lg font-bold text-gray-900 mb-4">Order #{{ $order->id }}</h4>
                                        <div class="flex items-start space-x-8">
                                            <!-- Modern Design Image -->
                                            <div class="flex-shrink-0">
                                                @if($order->design->image_path)
                                                    <div class="relative group">
                                                        <img src="{{ $order->design->image_url }}" 
                                                             alt="{{ $order->design->title }}" 
                                                             class="w-40 h-40 object-cover rounded-2xl shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                    </div>
                                                @else
                                                    <div class="w-40 h-40 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-2xl shadow-lg">
                                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Modern Design Info -->
                                            <div class="flex-1">
                                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $order->design->title }}</h3>
                                                <div class="flex items-center mb-4">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-3">
                                                        <span class="text-white text-sm font-bold">{{ substr($order->design->designer->name, 0, 1) }}</span>
                                                    </div>
                                                    <p class="text-gray-700 font-medium text-lg">by {{ $order->design->designer->name }}</p>
                                                </div>
                                                
                                                @if($order->design->category)
                                                    <div class="mb-4">
                                                        <span class="inline-block bg-gradient-to-r from-purple-500 to-blue-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                                            {{ ucfirst($order->design->category) }}
                                                        </span>
                                                    </div>
                                                @endif

                                                @if($order->design->description)
                                                    <p class="text-gray-700 leading-relaxed mb-6 text-base">{{ $order->design->description }}</p>
                                                @endif

                                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                                    <div class="bg-white rounded-xl p-4 shadow-sm">
                                                        <div class="flex items-center mb-2">
                                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                            </svg>
                                                            <span class="text-sm text-gray-600 font-medium">Quantity</span>
                                                        </div>
                                                        <p class="font-bold text-gray-900 text-lg">{{ $order->quantity }}</p>
                                                    </div>
                                                    <div class="bg-white rounded-xl p-4 shadow-sm">
                                                        <div class="flex items-center mb-2">
                                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                            </svg>
                                                            <span class="text-sm text-gray-600 font-medium">Unit Price</span>
                                                        </div>
                                                        <p class="font-bold text-gray-900 text-lg">LKR {{ number_format($order->unit_price, 2) }}</p>
                                                    </div>
                                                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl p-4 shadow-lg">
                                                        <div class="flex items-center mb-2">
                                                            <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                            </svg>
                                                            <span class="text-sm text-green-100 font-medium">Total Amount</span>
                                                        </div>
                                                        <p class="font-bold text-white text-xl">LKR {{ number_format($order->total_amount, 2) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Modern Next Steps -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl mb-8 border border-gray-100">
                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                What happens next?
                            </h2>
                            
                            <div class="space-y-6">
                                <div class="flex items-start space-x-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-6">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg">
                                            <span class="text-white font-bold text-lg">1</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg mb-2">Designer Notification</h3>
                                        <p class="text-gray-600 leading-relaxed">All designers have been notified of your paid orders and will begin working on them.</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg">
                                            <span class="text-white font-bold text-lg">2</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg mb-2">Orders Processing</h3>
                                        <p class="text-gray-600 leading-relaxed">Your orders will be moved to "In Progress" status as designers work on your requirements.</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center shadow-lg">
                                            <span class="text-white font-bold text-lg">3</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg mb-2">Completion & Delivery</h3>
                                        <p class="text-gray-600 leading-relaxed">Once completed, your order status will be updated and you'll receive the final design files.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modern Order Summary Sidebar -->
                <div class="xl:col-span-1 space-y-6">
                    <!-- Modern Order Summary -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Payment Summary
                            </h2>
                            
                            <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-6">
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                        <span class="text-gray-600 font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Total Orders:
                                        </span>
                                        <span class="font-bold text-gray-900">{{ $orders->count() }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                        <span class="text-gray-600 font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Status:
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold shadow-lg bg-green-100 text-green-800">
                                            Paid
                                        </span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                        <span class="text-gray-600 font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                            Payment Date:
                                        </span>
                                        <span class="font-bold text-sm text-gray-900">{{ now()->format('M d, Y g:i A') }}</span>
                                    </div>

                                    <div class="bg-white rounded-xl p-6 my-6 shadow-sm">
                                        <div class="flex justify-between items-center py-2">
                                            <span class="text-gray-600 font-medium">Subtotal:</span>
                                            <span class="font-bold text-sm text-gray-900">LKR {{ number_format($totalAmount, 2) }}</span>
                                        </div>
                                        
                                   
                                        <div class="flex justify-between items-center pt-4">
                                            <span class="font-bold text-gray-900 text-sm">Total Paid:</span>
                                            <span class="font-bold text-sm
                                             text-green-600">LKR {{ number_format($totalAmount, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Action Buttons -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                        <div class="p-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Quick Actions
                            </h2>
                            
                            <div class="space-y-4">
                                <a href="{{ route('buyer.orders.index') }}" 
                                   class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-xl text-center block shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        View All Orders
                                    </span>
                                </a>
                                
                                <a href="{{ route('buyer.marketplace') }}" 
                                   class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-3 px-6 rounded-xl text-center block shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        Browse More Designs
                                    </span>
                                </a>

                                <a href="{{ route('buyer.dashboard') }}" 
                                   class="w-full bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-3 px-6 rounded-xl text-center block shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        </svg>
                                        Go to Dashboard
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Clear the cart from localStorage after successful payment
document.addEventListener('DOMContentLoaded', function() {
    // Clear the cart
    localStorage.removeItem('designCart');
    
    // Update cart count if the function exists
    if (typeof updateCartCount === 'function') {
        updateCartCount();
    }
    
    // Show a success message
    console.log('Cart cleared successfully after payment');
});
</script>

@endsection