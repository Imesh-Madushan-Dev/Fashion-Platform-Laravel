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
                            <div class="text-2xl font-bold text-gray-900">0</div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-6 py-3 shadow-lg border border-white/20">
                            <span class="text-sm font-medium text-gray-500">Revenue</span>
                            <div class="text-2xl font-bold text-green-600">$0.00</div>
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
                <button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg">
                    All Orders
                </button>
                <button class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all">
                    Pending
                </button>
                <button class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all">
                    In Progress
                </button>
                <button class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all">
                    Completed
                </button>
                <button class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all">
                    Cancelled
                </button>
            </div>
        </div>

        <!-- Orders List -->
        <div class="space-y-6">
            <!-- Sample Order Card (when orders exist) -->
            <!-- This would be populated with actual orders from the database -->
            
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-lg border border-white/20 p-12 max-w-2xl mx-auto">
                    <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Orders Yet</h3>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                        You haven't received any orders for your designs yet. Keep creating amazing designs and customers will start ordering soon!
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
                        <p class="text-2xl font-bold text-gray-900">0</p>
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
                        <p class="text-2xl font-bold text-gray-900">0</p>
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
                        <p class="text-2xl font-bold text-gray-900">0</p>
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
                        <p class="text-2xl font-bold text-gray-900">$0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection