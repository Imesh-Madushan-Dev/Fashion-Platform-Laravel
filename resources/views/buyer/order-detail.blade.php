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
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('buyer.orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to My Orders
                </a>
            </div>

            <!-- Modern Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 bg-white rounded-xl shadow-sm border border-gray-100 px-4 py-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('buyer.orders.index') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            My Orders
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-blue-600 md:ml-2">Order #{{ $order->id }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Modern Order Header -->
            <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl mb-8">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative p-8">
                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start space-y-4 lg:space-y-0">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-4xl font-bold text-white mb-2">Order #{{ $order->id }}</h1>
                                <div class="flex items-center text-indigo-100">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8l.6 3m1.4 4H6l.6-3m0 0h10.8"></path>
                                    </svg>
                                    <p class="text-lg">Placed on {{ $order->ordered_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center lg:text-right">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold shadow-lg {{ $order->status_badge_class }} mb-3">
                                {{ $order->formatted_status }}
                            </span>
                            <div class="bg-white bg-opacity-20 rounded-xl p-4">
                                <p class="text-3xl font-bold text-white">${{ number_format($order->total_amount, 2) }}</p>
                                <p class="text-indigo-100 text-sm">Total Amount</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Order Actions -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Quick Actions
                </h3>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('buyer.designs.show', $order->design) }}" 
                       class="flex-1 inline-flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View Design
                    </a>
                    
                    @if($order->status === 'pending')
                        <a href="{{ route('buyer.payment.show', $order) }}" 
                           class="flex-1 inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Pay Now
                        </a>

                        <form method="POST" action="{{ route('buyer.orders.cancel', $order) }}" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                                    onclick="return confirm('Are you sure you want to cancel this order?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel Order
                            </button>
                        </form>
                    @endif

                    @if($order->design->is_active)
                        <form method="POST" action="{{ route('buyer.orders.quick-buy', $order->design) }}" class="flex-1">
                            @csrf
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                                    onclick="return confirm('Are you sure you want to reorder this design?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reorder
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
                <!-- Modern Design Information - Takes 3/4 width -->
                <div class="xl:col-span-3">
                    <div class="bg-white overflow-hidden rounded-2xl shadow-lg border border-gray-100 mb-8">
                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-7 h-7 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Design Details
                            </h2>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                <!-- Design Image - Left Column -->
                                <div class="lg:col-span-1">
                                    @if($order->design->image_path)
                                        <div class="relative group">
                                            <img src="{{ $order->design->image_url }}" 
                                                 alt="{{ $order->design->title }}" 
                                                 class="w-full h-80 object-cover rounded-2xl shadow-lg group-hover:shadow-2xl transition-shadow duration-300">
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-2xl transition-all duration-300"></div>
                                        </div>
                                    @else
                                        <div class="w-full h-80 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-2xl shadow-lg">
                                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Design Info - Right Columns -->
                                <div class="lg:col-span-2 space-y-6">
                                    <!-- Basic Info Card -->
                                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl p-6">
                                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $order->design->title }}</h3>
                                        <div class="flex items-center mb-4">
                                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-4">
                                                <span class="text-white text-sm font-bold">{{ substr($order->design->designer->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <p class="text-lg text-gray-700 font-medium">{{ $order->design->designer->name }}</p>
                                                <div class="text-sm text-gray-600">Designer</div>
                                            </div>
                                        </div>
                                        
                                        @if($order->design->category)
                                            <div class="mb-4">
                                                <span class="inline-flex items-center bg-gradient-to-r from-purple-500 to-blue-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-sm">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                    </svg>
                                                    {{ ucfirst($order->design->category) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Description Card -->
                                    <div class="bg-gray-50 rounded-xl p-6">
                                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Description
                                        </h4>
                                        <p class="text-gray-700 leading-relaxed">{{ $order->design->description }}</p>
                                    </div>

                                    @if($order->design->tags && count($order->design->tags) > 0)
                                        <!-- Tags Card -->
                                        <div class="bg-white rounded-xl p-6 border border-gray-200">
                                            <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                                Tags
                                            </h4>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($order->design->tags as $tag)
                                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                        #{{ $tag }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Order Notes -->
                    @if($order->notes)
                        <div class="bg-white overflow-hidden rounded-2xl shadow-lg border border-gray-100">
                            <div class="p-8">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <svg class="w-7 h-7 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Order Notes
                                </h2>
                                <div class="bg-gradient-to-br from-green-50 to-blue-50 p-6 rounded-xl border-l-4 border-green-400">
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 text-green-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-gray-800 leading-relaxed">{{ $order->notes }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Modern Order Summary Sidebar - Takes 1/4 width -->
                <div class="xl:col-span-1 space-y-6">
                    <!-- Order Summary -->
                    <div class="bg-white overflow-hidden rounded-2xl shadow-lg border border-gray-100">
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Order Summary
                            </h2>
                            
                            <div class="space-y-3">
                                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 text-sm font-medium">Order ID:</span>
                                        <span class="font-bold text-blue-600 text-sm">#{{ $order->id }}</span>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 text-sm font-medium">Status:</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold {{ $order->status_badge_class }}">
                                            {{ $order->formatted_status }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 text-sm font-medium">Order Date:</span>
                                        <span class="font-bold text-gray-900 text-sm">{{ $order->ordered_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg p-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 text-sm font-medium">Order Time:</span>
                                        <span class="font-bold text-gray-900 text-sm">{{ $order->ordered_at->format('g:i A') }}</span>
                                    </div>
                                </div>

                                <div class="border-t-2 border-gray-200 pt-3 mt-4">
                                    <div class="space-y-2">
                                        <div class="flex justify-between py-1">
                                            <span class="text-gray-600 text-sm font-medium">Unit Price:</span>
                                            <span class="font-bold text-gray-900 text-sm">${{ number_format($order->unit_price, 2) }}</span>
                                        </div>
                                        
                                        <div class="flex justify-between py-1">
                                            <span class="text-gray-600 text-sm font-medium">Quantity:</span>
                                            <span class="font-bold text-gray-900 text-sm">{{ $order->quantity }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-4 text-white">
                                    <div class="flex justify-between items-center">
                                        <span class="font-bold text-sm">Total:</span>
                                        <span class="font-bold text-xl">${{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Designer Information -->
                    <div class="bg-white overflow-hidden rounded-2xl shadow-lg border border-gray-100">
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Designer
                            </h2>
                            
                            <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-lg p-4 mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-600 rounded-full flex items-center justify-center shadow-sm">
                                        <span class="text-white font-bold text-sm">
                                            {{ substr($order->design->designer->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900 text-sm">{{ $order->design->designer->name }}</h3>
                                        <div class="space-y-1">
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-xs">{{ $order->design->designer->email }}</span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center text-green-600 bg-green-100 rounded-full px-2 py-1 text-xs font-bold">
                                                <svg class="w-2 h-2 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Verified
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('buyer.marketplace', ['designer' => $order->design->designer->id]) }}" 
                               class="w-full bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center block text-sm">
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View More Designs
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Modern Order Timeline -->
                    <div class="bg-white overflow-hidden rounded-2xl shadow-lg border border-gray-100">
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Order Timeline
                            </h2>
                            
                            <div class="flow-root">
                                <ul class="space-y-4">
                                    <li>
                                        <div class="relative flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-sm">
                                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 bg-blue-50 rounded-lg p-3">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <p class="font-bold text-blue-800 text-sm">Order Placed</p>
                                                        <p class="text-xs text-blue-600">Order submitted successfully</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="font-semibold text-blue-700 text-xs">{{ $order->ordered_at->format('M d, Y') }}</p>
                                                        <p class="text-xs text-blue-600">{{ $order->ordered_at->format('g:i A') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    @if($order->status === 'paid')
                                        <li>
                                            <div class="relative flex items-start space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center shadow-sm">
                                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="flex-1 bg-green-50 rounded-lg p-3">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <p class="font-bold text-green-800 text-sm">Payment Processed</p>
                                                            <p class="text-xs text-green-600">Payment completed</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="font-semibold text-green-700 text-xs">{{ $order->updated_at->format('M d, Y') }}</p>
                                                            <p class="text-xs text-green-600">{{ $order->updated_at->format('g:i A') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @elseif($order->status !== 'pending')
                                        <li>
                                            <div class="relative flex items-start space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 bg-gradient-to-r {{ $order->status === 'cancelled' ? 'from-red-500 to-red-600' : 'from-green-500 to-emerald-600' }} rounded-full flex items-center justify-center shadow-sm">
                                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="flex-1 {{ $order->status === 'cancelled' ? 'bg-red-50' : 'bg-green-50' }} rounded-lg p-3">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <p class="font-bold {{ $order->status === 'cancelled' ? 'text-red-800' : 'text-green-800' }} text-sm">Order {{ ucfirst($order->status) }}</p>
                                                            <p class="text-xs {{ $order->status === 'cancelled' ? 'text-red-600' : 'text-green-600' }}">Status updated</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="font-semibold {{ $order->status === 'cancelled' ? 'text-red-700' : 'text-green-700' }} text-xs">{{ $order->updated_at->format('M d, Y') }}</p>
                                                            <p class="text-xs {{ $order->status === 'cancelled' ? 'text-red-600' : 'text-green-600' }}">{{ $order->updated_at->format('g:i A') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection