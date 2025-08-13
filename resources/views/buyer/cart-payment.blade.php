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
                <a href="{{ route('cart.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Cart
                </a>
            </div>

            <!-- Modern Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 bg-white rounded-2xl px-6 py-3 shadow-md border border-gray-100">
                    <li class="inline-flex items-center">
                        <a href="{{ route('cart.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                            </svg>
                            Shopping Cart
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-green-600 md:ml-2 font-semibold">Payment</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Modern Payment Header -->
            <div class="relative overflow-hidden bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl shadow-xl mb-8">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-white mb-1">Complete Your Cart Payment</h1>
                                <p class="text-green-100 text-lg">Review your cart orders and confirm payment</p>
                            </div>
                        </div>
                        <div class="hidden md:flex items-center space-x-4">
                            <div class="text-right mr-4">
                                <div class="text-white text-sm font-medium">Total Amount</div>
                                <div class="text-white text-2xl font-bold">${{ number_format($totalAmount, 2) }}</div>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
                <!-- Display any session messages -->
                @if(session('success'))
                    <div class="xl:col-span-4 mb-6">
                        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="xl:col-span-4 mb-6">
                        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="xl:col-span-4 mb-6">
                        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Order Details -->
                <div class="xl:col-span-3">
                    <!-- Modern Cart Orders Information -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl mb-6 border border-gray-100">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Cart Orders ({{ $orders->count() }} items)
                            </h2>
                            
                            <div class="space-y-6">
                                @foreach($orders as $order)
                                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-5">
                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                            <!-- Modern Design Image -->
                                            <div class="lg:col-span-1">
                                                @if($order->design->image_path)
                                                    <div class="relative group">
                                                        <img src="{{ $order->design->image_url }}" 
                                                             alt="{{ $order->design->title }}" 
                                                             class="w-full h-48 object-cover rounded-xl shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-xl transition-all duration-300"></div>
                                                    </div>
                                                @else
                                                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-xl shadow-lg">
                                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Modern Design Info -->
                                            <div class="lg:col-span-2">
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

                                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                                                    <div class="bg-white rounded-xl p-4 shadow-sm">
                                                        <div class="flex items-center">
                                                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                            </svg>
                                                            <span class="text-sm text-gray-600 font-medium">Quantity:</span>
                                                        </div>
                                                        <span class="text-lg font-bold text-gray-900 ml-7">{{ $order->quantity }}</span>
                                                    </div>
                                                    <div class="bg-white rounded-xl p-4 shadow-sm">
                                                        <div class="flex items-center">
                                                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                            </svg>
                                                            <span class="text-sm text-gray-600 font-medium">Unit Price:</span>
                                                        </div>
                                                        <span class="text-lg font-bold text-gray-900 ml-7">${{ number_format($order->unit_price, 2) }}</span>
                                                    </div>
                                                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl p-4 shadow-lg">
                                                        <div class="flex items-center">
                                                            <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                            </svg>
                                                            <span class="text-sm text-green-100 font-medium">Total:</span>
                                                        </div>
                                                        <span class="text-lg font-bold text-white ml-7">${{ number_format($order->total_amount, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Additional Order Information -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl mb-6 border border-gray-100">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Customer Information
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-4">
                                    <h3 class="font-semibold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Customer Details
                                    </h3>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600 text-sm">Name:</span>
                                            <span class="text-gray-900 font-medium text-sm">{{ Auth::guard('buyer')->user()->name }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600 text-sm">Email:</span>
                                            <span class="text-gray-900 font-medium text-sm">{{ Auth::guard('buyer')->user()->email }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4">
                                    <h3 class="font-semibold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Payment Security
                                    </h3>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            <span class="text-gray-700 text-sm">Secure Payment Processing</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.018-4.382A9.017 9.017 0 0117 6.5c0-1.381.56-2.632 1.464-3.536l-1.465 1.464z"></path>
                                            </svg>
                                            <span class="text-gray-700 text-sm">Verified Transaction</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modern Payment Summary -->
                <div class="xl:col-span-1 space-y-6">
                    <!-- Modern Order Summary -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Payment Summary
                            </h2>
                            
                            <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl p-4">
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-gray-600 text-sm font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Total Items:
                                        </span>
                                        <span class="font-bold text-gray-900 text-sm">{{ $orders->count() }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-gray-600 text-sm font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8l.6 3m1.4 4H6l.6-3m0 0h10.8"></path>
                                            </svg>
                                            Order Date:
                                        </span>
                                        <span class="font-bold text-gray-900 text-sm">{{ now()->format('M d, Y') }}</span>
                                    </div>

                                    <div class="bg-white rounded-xl p-3 my-4">
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-gray-600 text-sm font-medium">Subtotal:</span>
                                            <span class="font-bold text-gray-900 text-sm">${{ number_format($totalAmount, 2) }}</span>
                                        </div>
                                        
                                        <div class="flex justify-between items-center py-1 border-b border-gray-100">
                                            <span class="text-gray-600 text-sm font-medium">Processing Fee:</span>
                                            <span class="font-bold text-green-600 text-sm">$0.00</span>
                                        </div>
                                        
                                        <div class="flex justify-between items-center pt-3">
                                            <span class="font-bold text-gray-900 text-lg">Total:</span>
                                            <span class="font-bold text-2xl text-blue-600">${{ number_format($totalAmount, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Payment Form -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Confirm Payment
                            </h2>
                            
                            <form method="POST" action="{{ route('buyer.payment.cart-process') }}" class="space-y-4" id="payment-form">
                                @csrf
                                
                                <!-- Hidden order IDs -->
                                @foreach($orders as $order)
                                    <input type="hidden" name="order_ids[]" value="{{ $order->id }}">
                                @endforeach
                                
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <label class="flex items-start cursor-pointer">
                                        <input type="checkbox" 
                                               name="confirm_payment" 
                                               id="confirm_payment"
                                               value="1"
                                               class="form-checkbox h-4 w-4 text-green-600 rounded mt-1 mr-3"
                                               {{ old('confirm_payment') ? 'checked' : '' }}
                                               required>
                                        <div>
                                            <span class="text-base text-gray-700 font-medium">
                                                I confirm that I want to proceed with this payment
                                            </span>
                                            <p class="text-xs text-gray-500 mt-1">
                                                By checking this box, you authorize the payment of ${{ number_format($totalAmount, 2) }} for your cart orders.
                                            </p>
                                        </div>
                                    </label>
                                    @error('confirm_payment')
                                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-3">
                                    <button type="submit" 
                                            id="pay-button"
                                            class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-3 px-6 rounded-xl text-base shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span class="flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                            <span id="button-text">Pay Now - LKR {{ number_format($totalAmount, 2) }}</span>
                                            <svg class="w-5 h-5 ml-2 animate-spin hidden" id="loading-spinner" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </span>
                                    </button>
                                    
                                    <a href="{{ route('cart.index') }}" 
                                       class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-6 rounded-xl text-base text-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                                        <span class="flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Cancel
                                        </span>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('payment-form');
    const payButton = document.getElementById('pay-button');
    const confirmCheckbox = document.getElementById('confirm_payment');
    const buttonText = document.getElementById('button-text');
    const loadingSpinner = document.getElementById('loading-spinner');
    
    // Initially disable the button
    payButton.disabled = true;
    
    // Enable/disable button based on checkbox state
    confirmCheckbox.addEventListener('change', function() {
        payButton.disabled = !this.checked;
    });
    
    // Handle form submission
    form.addEventListener('submit', function(e) {
        if (!confirmCheckbox.checked) {
            e.preventDefault();
            alert('Please confirm that you want to proceed with the payment.');
            return false;
        }
        
        // Show loading state
        payButton.disabled = true;
        buttonText.style.display = 'none';
        loadingSpinner.classList.remove('hidden');
        
        // Optional: Add a timeout to prevent indefinite loading
        setTimeout(function() {
            if (payButton.disabled) {
                payButton.disabled = false;
                buttonText.style.display = 'inline';
                loadingSpinner.classList.add('hidden');
            }
        }, 10000); // 10 seconds timeout
    });
});
</script>

@endsection