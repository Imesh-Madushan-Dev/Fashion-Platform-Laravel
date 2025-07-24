@extends('layouts.app')

@section('nav-links')
    <a href="{{ route('buyer.dashboard') }}" class="text-blue-500 font-semibold">Dashboard</a>
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
        <!-- Modern Header with Gradient -->
        <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl mb-8">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-white mb-2">Welcome Back!</h1>
                        <p class="text-blue-100 text-lg">{{ Auth::guard('buyer')->user()->name }}</p>
                        <p class="text-blue-200 text-sm mt-1">Ready to discover amazing designs?</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-32 h-32 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions with Modern Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('buyer.marketplace', ['sort_by' => 'newest']) }}" class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-100 rounded-xl group-hover:bg-white group-hover:bg-opacity-20 transition-colors duration-300">
                            <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-white transition-colors duration-300 mb-2">Latest Designs</h3>
                    <p class="text-sm text-gray-600 group-hover:text-blue-100 transition-colors duration-300">Discover the newest creations</p>
                </div>
            </a>

            <a href="{{ route('buyer.marketplace') }}" class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-green-100 rounded-xl group-hover:bg-white group-hover:bg-opacity-20 transition-colors duration-300">
                            <svg class="w-6 h-6 text-green-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-white transition-colors duration-300 mb-2">Marketplace</h3>
                    <p class="text-sm text-gray-600 group-hover:text-green-100 transition-colors duration-300">Explore all designs</p>
                </div>
            </a>

            <a href="{{ route('buyer.orders.index') }}" class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-100 rounded-xl group-hover:bg-white group-hover:bg-opacity-20 transition-colors duration-300">
                            <svg class="w-6 h-6 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-white transition-colors duration-300 mb-2">My Orders</h3>
                    <p class="text-sm text-gray-600 group-hover:text-purple-100 transition-colors duration-300">Track your purchases</p>
                </div>
            </a>

            <a href="{{ route('buyer.marketplace', ['sort_by' => 'popular']) }}" class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-red-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-orange-100 rounded-xl group-hover:bg-white group-hover:bg-opacity-20 transition-colors duration-300">
                            <svg class="w-6 h-6 text-orange-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-white transition-colors duration-300 mb-2">Trending</h3>
                    <p class="text-sm text-gray-600 group-hover:text-orange-100 transition-colors duration-300">Popular designs</p>
                </div>
            </a>
        </div>

        <!-- Modern Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Total Orders</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_orders'] ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full font-medium">+12%</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Pending Orders</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_orders'] ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full font-medium">Active</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Total Spent</p>
                            <p class="text-3xl font-bold text-gray-900">${{ number_format($stats['total_spent'] ?? 0, 2) }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-purple-600 bg-purple-100 px-2 py-1 rounded-full font-medium">This month</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modern Profile Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
            <div class="p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile Information
                    </h2>
                    <button class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profile
                    </button>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Personal Details Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Personal Details
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Name</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::guard('buyer')->user()->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Email</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::guard('buyer')->user()->email }}</p>
                                </div>
                            </div>
                            @if(Auth::guard('buyer')->user()->phone)
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Phone</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::guard('buyer')->user()->phone }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Address Information Card -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Address Information
                        </h3>
                        <div class="space-y-4">
                            @if(Auth::guard('buyer')->user()->address)
                            <div class="flex items-start p-3 bg-white rounded-lg shadow-sm">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2M19 10v10a1 1 0 01-1 1h-3m-10 0v-3a1 1 0 011-1h2a1 1 0 011 1v3m-4 0h8"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Address</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::guard('buyer')->user()->address }}</p>
                                </div>
                            </div>
                            @endif
                            <div class="grid grid-cols-2 gap-4">
                                @if(Auth::guard('buyer')->user()->city)
                                <div class="p-3 bg-white rounded-lg shadow-sm">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">City</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::guard('buyer')->user()->city }}</p>
                                </div>
                                @endif
                                @if(Auth::guard('buyer')->user()->state)
                                <div class="p-3 bg-white rounded-lg shadow-sm">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">State</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::guard('buyer')->user()->state }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                @if(Auth::guard('buyer')->user()->postal_code)
                                <div class="p-3 bg-white rounded-lg shadow-sm">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Postal Code</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::guard('buyer')->user()->postal_code }}</p>
                                </div>
                                @endif
                                @if(Auth::guard('buyer')->user()->country)
                                <div class="p-3 bg-white rounded-lg shadow-sm">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Country</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::guard('buyer')->user()->country }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection