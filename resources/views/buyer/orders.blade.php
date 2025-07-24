@extends('layouts.app')

@section('nav-links')
    <a href="{{ route('buyer.dashboard') }}" class="text-gray-700 hover:text-blue-500">Dashboard</a>
    <a href="{{ route('buyer.marketplace') }}" class="text-gray-700 hover:text-blue-500">Marketplace</a>
    <a href="{{ route('buyer.orders.index') }}" class="text-blue-500 font-semibold">My Orders</a>
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

            <!-- Modern Header -->
            <div class="relative overflow-hidden bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl shadow-xl mb-8">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2">My Orders</h1>
                            <p class="text-purple-100 text-lg">Track and manage all your design purchases</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Filters -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
                <div class="p-8">
                <form method="GET" action="{{ route('buyer.orders.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Status Filter -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Order Status
                            </label>
                            <select name="status" id="status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-white">
                                <option value="">All Statuses</option>
                                @foreach($statuses as $value => $label)
                                    <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date From -->
                        <div>
                            <label for="date_from" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8l.6 3m1.4 4H6l.6-3m0 0h10.8"></path>
                                </svg>
                                From Date
                            </label>
                            <input type="date" 
                                   id="date_from" 
                                   name="date_from" 
                                   value="{{ request('date_from') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        </div>

                        <!-- Date To -->
                        <div>
                            <label for="date_to" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8l.6 3m1.4 4H6l.6-3m0 0h10.8"></path>
                                </svg>
                                To Date
                            </label>
                            <input type="date" 
                                   id="date_to" 
                                   name="date_to" 
                                   value="{{ request('date_to') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        </div>

                        <!-- Filter Button -->
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707l-3.07-3.07"></path>
                                    </svg>
                                    Apply Filters
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Clear Filters -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('buyer.orders.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Clear all filters
                        </a>
                    </div>
                </form>
            </div>
        </div>

            <!-- Modern Orders List -->
            @if($orders->count() > 0)
                <div class="space-y-6 mb-8">
                    @foreach($orders as $order)
                        <div class="bg-white overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900">Order #{{ $order->id }}</h3>
                                            <div class="flex items-center text-gray-600 mt-1">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <p class="text-sm font-medium">{{ $order->ordered_at->format('M d, Y \a\t g:i A') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold shadow-lg {{ $order->status_badge_class }}">
                                            {{ $order->formatted_status }}
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                    <!-- Modern Design Info -->
                                    <div class="lg:col-span-2">
                                        <div class="flex items-start space-x-6">
                                            <!-- Design Image -->
                                            <div class="flex-shrink-0">
                                                @if($order->design->image_path)
                                                    <div class="relative group">
                                                        <img src="{{ $order->design->image_url }}" 
                                                             alt="{{ $order->design->title }}" 
                                                             class="w-24 h-24 object-cover rounded-2xl shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-2xl transition-all duration-300"></div>
                                                    </div>
                                                @else
                                                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-2xl shadow-lg">
                                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Design Details -->
                                            <div class="flex-1">
                                                <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $order->design->title }}</h4>
                                                <div class="flex items-center mb-3">
                                                    <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-3">
                                                        <span class="text-white text-xs font-bold">{{ substr($order->design->designer->name, 0, 1) }}</span>
                                                    </div>
                                                    <p class="text-sm text-gray-700 font-medium">{{ $order->design->designer->name }}</p>
                                                </div>
                                                <div class="space-y-2">
                                                    <div class="flex items-center text-sm text-gray-600">
                                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                        </svg>
                                                        <span class="font-medium">Quantity: {{ $order->quantity }}</span>
                                                    </div>
                                                    @if($order->notes)
                                                        <div class="bg-blue-50 rounded-lg p-3 mt-3">
                                                            <div class="flex items-start">
                                                                <svg class="w-4 h-4 mr-2 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                </svg>
                                                                <div>
                                                                    <p class="text-xs font-semibold text-blue-800 uppercase tracking-wide mb-1">Custom Notes</p>
                                                                    <p class="text-sm text-blue-700">{{ $order->notes }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modern Order Summary -->
                                    <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-100">
                                        <h5 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                            Order Summary
                                        </h5>
                                        <div class="space-y-4">
                                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                                <span class="text-sm text-gray-600 font-medium">Unit Price:</span>
                                                <span class="font-bold text-gray-900">${{ number_format($order->unit_price, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                                <span class="text-sm text-gray-600 font-medium">Quantity:</span>
                                                <span class="font-bold text-gray-900">{{ $order->quantity }}</span>
                                            </div>
                                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                                <div class="flex justify-between items-center">
                                                    <span class="font-bold text-gray-900 text-lg">Total Amount:</span>
                                                    <span class="font-bold text-2xl text-blue-600">${{ number_format($order->total_amount, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                                <!-- Modern Action Buttons -->
                                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
                                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                                        <a href="{{ route('buyer.orders.show', $order) }}" 
                                           class="inline-flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View Details
                                        </a>
                                        <a href="{{ route('buyer.designs.show', $order->design) }}" 
                                           class="inline-flex items-center justify-center bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            View Design
                                        </a>
                                    </div>

                                    @if($order->status === 'pending')
                                        <form method="POST" action="{{ route('buyer.orders.cancel', $order) }}" class="w-full sm:w-auto">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                                                    onclick="return confirm('Are you sure you want to cancel this order?')">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Cancel Order
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Modern Pagination -->
                <div class="flex justify-center mt-12">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            @else
                <!-- Modern No Orders -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                    <div class="p-16 text-center">
                        <div class="mx-auto w-24 h-24 bg-gradient-to-br from-purple-100 to-blue-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">No orders found</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">You haven't placed any orders yet. Start browsing our marketplace to discover amazing designs!</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('buyer.marketplace') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Browse Marketplace
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