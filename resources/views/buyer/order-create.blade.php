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
                <a href="{{ route('buyer.designs.show', $design) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Design Details
                </a>
            </div>

            <!-- Modern Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 bg-white rounded-2xl px-6 py-3 shadow-md border border-gray-100">
                    <li class="inline-flex items-center">
                        <a href="{{ route('buyer.marketplace') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Marketplace
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('buyer.designs.show', $design) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 transition-colors duration-200">
                                {{ $design->title }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2 font-semibold">Create Order</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Modern Header -->
            <div class="relative overflow-hidden bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl shadow-xl mb-8">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2">Create Your Order</h1>
                            <p class="text-purple-100 text-lg">Customize your design purchase and place your order</p>
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

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Design Information - Left Column -->
                <div class="xl:col-span-1 bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Design Details
                        </h2>
                    
                        <!-- Modern Design Image -->
                        <div class="mb-6">
                            @if($design->image_path)
                                <div class="relative group">
                                    <img src="{{ $design->image_url }}" 
                                         alt="{{ $design->title }}" 
                                         class="w-full h-64 object-cover rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-xl shadow-lg">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Compact Design Info -->
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $design->title }}</h3>
                                <div class="flex items-center mb-3">
                                    <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-2">
                                        <span class="text-white text-xs font-bold">{{ substr($design->designer->name, 0, 1) }}</span>
                                    </div>
                                    <p class="text-gray-700 text-sm font-medium">by {{ $design->designer->name }}</p>
                                </div>
                                
                                @if($design->category)
                                    <span class="inline-block bg-gradient-to-r from-purple-500 to-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                                        {{ ucfirst($design->category) }}
                                    </span>
                                @endif
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-gray-700 leading-relaxed text-sm">{{ $design->description }}</p>
                            </div>

                            @if($design->tags && count($design->tags) > 0)
                                <div class="bg-white rounded-xl p-4 border border-gray-100">
                                    <p class="text-xs font-bold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-3 h-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        Tags:
                                    </p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($design->tags as $tag)
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-md text-xs font-medium">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-4 rounded-xl shadow-lg">
                                <div class="text-2xl font-bold text-white mb-1">${{ number_format($design->price, 2) }}</div>
                                <p class="text-green-100 text-sm font-medium">per unit</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Form - Right Column (2/3 width) -->
                <div class="xl:col-span-2 bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Order Information
                        </h2>

                        <form method="POST" action="{{ route('buyer.orders.store') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="design_id" value="{{ $design->id }}">

                            <!-- Form Grid Layout -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div class="space-y-6">
                                    <!-- Modern Quantity -->
                                    <div class="bg-gray-50 rounded-xl p-6">
                                        <label for="quantity" class="block text-lg font-bold text-gray-700 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            Quantity <span class="text-red-500 ml-1">*</span>
                                        </label>
                                        <input type="number" 
                                               id="quantity" 
                                               name="quantity" 
                                               value="{{ old('quantity', 1) }}"
                                               min="1" 
                                               max="100"
                                               required
                                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('quantity') border-red-300 @enderror text-lg font-semibold transition-all duration-200"
                                               onchange="updateTotal()">
                                        @error('quantity')
                                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-2 text-sm text-gray-500 font-medium">Maximum 100 units per order</p>
                                    </div>

                                    <!-- Modern Order Summary -->
                                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 p-6 rounded-xl border-2 border-blue-100">
                                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                            Order Summary
                                        </h3>
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                                <span class="text-gray-700 font-medium">Unit Price:</span>
                                                <span class="font-bold text-gray-900">${{ number_format($design->price, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                                <span class="text-gray-700 font-medium">Quantity:</span>
                                                <span class="font-bold text-gray-900" id="summary-quantity">1</span>
                                            </div>
                                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                                <div class="flex justify-between items-center">
                                                    <span class="font-bold text-gray-900">Total Amount:</span>
                                                    <span class="font-bold text-2xl text-blue-600" id="total-amount">${{ number_format($design->price, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-6">
                                    <!-- Modern Notes -->
                                    <div class="bg-gray-50 rounded-xl p-6 h-full">
                                        <label for="notes" class="block text-lg font-bold text-gray-700 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Order Notes (Optional)
                                        </label>
                                        <textarea id="notes" 
                                                  name="notes" 
                                                  rows="8" 
                                                  maxlength="1000"
                                                  placeholder="Any special instructions or notes for this order..."
                                                  class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('notes') border-red-300 @enderror transition-all duration-200 resize-none">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-2 text-sm text-gray-500 font-medium">Maximum 1000 characters</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Modern Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                <button type="submit" 
                                        class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        Place Order
                                    </span>
                                </button>
                                <a href="{{ route('buyer.designs.show', $design) }}" 
                                   class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-8 rounded-xl text-lg text-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Cancel
                                    </span>
                                </a>
                            </div>

                            <!-- Modern Terms -->
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-xl">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-bold text-yellow-800 mb-2">Order Terms & Conditions</h3>
                                        <div class="text-sm text-yellow-700">
                                            <p class="font-medium mb-3">By placing this order, you agree to our terms of service and understand that:</p>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                <div class="space-y-2">
                                                    <div class="flex items-start">
                                                        <svg class="w-4 h-4 mr-2 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        <span>Your order will be processed within 1-2 business days</span>
                                                    </div>
                                                    <div class="flex items-start">
                                                        <svg class="w-4 h-4 mr-2 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        <span>You can cancel pending orders at any time</span>
                                                    </div>
                                                </div>
                                                <div class="space-y-2">
                                                    <div class="flex items-start">
                                                        <svg class="w-4 h-4 mr-2 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        <span>Digital designs will be delivered electronically</span>
                                                    </div>
                                                    <div class="flex items-start">
                                                        <svg class="w-4 h-4 mr-2 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        <span>All sales are final once confirmed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateTotal() {
    const quantity = document.getElementById('quantity').value || 1;
    const unitPrice = {{ $design->price }};
    const total = quantity * unitPrice;
    
    document.getElementById('summary-quantity').textContent = quantity;
    document.getElementById('total-amount').textContent = '$' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateTotal();
});
</script>
@endsection