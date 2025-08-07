@extends('layouts.app')

@section('title', 'My Orders')

@section('nav-links')
    <span class="text-gray-700">Welcome, {{ Auth::guard('designer')->user()->name }}</span>
    <form method="POST" action="{{ route('designer.logout') }}" class="inline">
        @csrf
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm">
            Logout
        </button>
    </form>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Back Button & Header -->
        <div class="flex items-center mb-8">
            <a href="{{ route('designer.dashboard') }}" 
               class="flex items-center justify-center w-12 h-12 bg-white/80 backdrop-blur-sm rounded-xl shadow-lg hover:bg-white transition-all duration-300 mr-6 group">
                <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">My Orders</h1>
                        <p class="text-gray-600 text-lg">Track and manage orders for your designs</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-6 py-3 shadow-lg border border-white/20">
                            <span class="text-sm font-medium text-gray-500">Total Orders</span>
                            <div class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] ?? 0 }}</div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-6 py-3 shadow-lg border border-white/20">
                            <span class="text-sm font-medium text-gray-500">Revenue</span>
                            <div class="text-2xl font-bold text-green-600">${{ number_format($stats['total_revenue'] ?? 0, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Status Filters -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter Orders
            </h3>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('designer.orders') }}" class="px-6 py-3 {{ !request('status') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} font-semibold rounded-xl hover:shadow-lg transition-all">
                    All Orders
                </a>
                <a href="{{ route('designer.orders', ['status' => 'pending']) }}" class="px-6 py-3 {{ request('status') === 'pending' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} font-semibold rounded-xl hover:shadow-lg transition-all">
                    Pending
                </a>
                <a href="{{ route('designer.orders', ['status' => 'paid']) }}" class="px-6 py-3 {{ request('status') === 'paid' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} font-semibold rounded-xl hover:shadow-lg transition-all">
                    Paid
                </a>
                <a href="{{ route('designer.orders', ['status' => 'in_progress']) }}" class="px-6 py-3 {{ request('status') === 'in_progress' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} font-semibold rounded-xl hover:shadow-lg transition-all">
                    In Progress
                </a>
                <a href="{{ route('designer.orders', ['status' => 'completed']) }}" class="px-6 py-3 {{ request('status') === 'completed' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} font-semibold rounded-xl hover:shadow-lg transition-all">
                    Completed
                </a>
                <a href="{{ route('designer.orders', ['status' => 'cancelled']) }}" class="px-6 py-3 {{ request('status') === 'cancelled' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} font-semibold rounded-xl hover:shadow-lg transition-all">
                    Cancelled
                </a>
            </div>
        </div>

        <!-- Orders List -->
        <div class="space-y-6">
            @if($orders->count() > 0)
                <!-- Orders Cards -->
                @foreach($orders as $order)
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                            <div class="flex items-start space-x-4 mb-4 lg:mb-0">
                                <!-- Design Image -->
                                <div class="flex-shrink-0">
                                    <img src="{{ $order->design->image_url }}" alt="{{ $order->design->title }}" class="w-20 h-20 object-cover rounded-xl shadow-md">
                                </div>
                                <!-- Order Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ $order->design->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-2">Buyer: <span class="font-medium">{{ $order->buyer->name }}</span></p>
                                    <p class="text-gray-600 text-sm mb-2">Order #{{ $order->id }} • {{ $order->created_at->format('M j, Y g:i A') }}</p>
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <span>Qty: {{ $order->quantity }}</span>
                                        <span>•</span>
                                        <span>Unit Price: ${{ number_format($order->unit_price, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Details & Actions -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                                <!-- Status Badge -->
                                <div class="flex items-center space-x-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $order->status_badge_class }}">
                                        {{ $order->formatted_status }}
                                    </span>
                                </div>

                                <!-- Total Amount -->
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</p>
                                    <p class="text-sm text-gray-500">Total</p>
                                </div>

                                <!-- Status Update Dropdown -->
                                <div class="relative">
                                    <form action="{{ route('designer.orders.update-status', $order) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            @foreach(\App\Models\Order::getStatuses() as $statusKey => $statusLabel)
                                                <option value="{{ $statusKey }}" {{ $order->status === $statusKey ? 'selected' : '' }}>
                                                    {{ $statusLabel }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        @if($order->notes)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium text-gray-900">Notes:</span> {{ $order->notes }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-lg border border-white/20 p-12 max-w-2xl mx-auto">
                        <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            @if(request('status'))
                                No {{ ucfirst(str_replace('_', ' ', request('status'))) }} Orders
                            @else
                                No Orders Yet
                            @endif
                        </h3>
                        <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                            @if(request('status'))
                                There are no {{ str_replace('_', ' ', request('status')) }} orders at the moment.
                            @else
                                You haven't received any orders for your designs yet. Keep creating amazing designs and customers will start ordering soon!
                            @endif
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('designer.designs.index') }}" 
                               class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                                <span class="relative flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    View My Designs
                                </span>
                            </a>
                            <a href="{{ route('designer.designs.create') }}" 
                               class="group relative inline-flex items-center px-8 py-4 bg-white text-gray-800 font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 border border-gray-200">
                                <span class="relative flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Upload New Design
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Order Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Orders</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pending</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_orders'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Completed</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['completed_orders'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Revenue</p>
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($stats['total_revenue'] ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection