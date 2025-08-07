@extends('layouts.app')

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
        <!-- Modern Header with Gradient -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 shadow-xl mb-8">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative px-8 py-12">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-white mb-2">Designer Dashboard</h1>
                        <p class="text-blue-100 text-lg">Welcome back, {{ Auth::guard('designer')->user()->name }}!</p>
                        <div class="flex items-center mt-4 space-x-4">
                            <div class="flex items-center text-blue-100">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span>{{ $designCount ?? 0 }} Designs</span>
                            </div>
                            <div class="flex items-center text-blue-100">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span>{{ $totalOrders ?? 0 }} Orders</span>
                            </div>
                            <div class="flex items-center text-blue-100">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span>${{ number_format($totalRevenue ?? 0, 2) }} Revenue</span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-96 h-96 opacity-10">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M40.7,-69.2C48.8,-62.2,48.2,-39.5,54.6,-21.2C61,-2.9,74.4,11,74.1,24.8C73.8,38.6,59.8,52.2,43.9,58.9C28,65.6,10.2,65.4,-7.1,75.5C-24.4,85.6,-41.2,106,-50.6,112.1C-60,118.2,-62,109.9,-62.1,101.9C-62.2,93.9,-60.4,86.2,-62.1,78.2C-63.8,70.2,-69,61.9,-69.9,52.6C-70.8,43.3,-67.4,33,-65.6,22.2C-63.8,11.4,-63.6,0.1,-59.7,-9.3C-55.8,-18.7,-48.2,-26.2,-40.3,-33.5C-32.4,-40.8,-24.2,-47.9,-13.4,-50.7C-2.6,-53.5,10.8,-52,25.7,-48.1C40.6,-44.2,57,-37.9,40.7,-69.2Z" transform="translate(100 100)" class="text-white" />
                </svg>
            </div>
        </div>

        <!-- Modern Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('designer.designs.index') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center text-white">
                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold">Manage Designs</h3>
                        <p class="text-blue-100 text-sm">View and edit designs</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('designer.designs.create') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400 to-emerald-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center text-white">
                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold">Upload Design</h3>
                        <p class="text-emerald-100 text-sm">Add new design</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('designer.orders') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-purple-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center text-white">
                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold">View Orders</h3>
                        <p class="text-purple-100 text-sm">Track orders</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('designer.profile') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-orange-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center text-white">
                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold">Update Profile</h3>
                        <p class="text-orange-100 text-sm">Edit profile info</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Enhanced Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-white/20">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Designs</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $designCount ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-white/20">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Orders</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $totalOrders ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-white/20">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                            <p class="text-3xl font-bold text-gray-900">${{ number_format($totalRevenue ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modern Profile Info -->
        <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-white/20 mb-8">
            <div class="px-8 py-6 border-b border-gray-200/50">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile Information
                </h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="flex items-center p-4 bg-gray-50/50 rounded-xl">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Name</p>
                                <p class="text-lg font-semibold text-gray-900">{{ Auth::guard('designer')->user()->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50/50 rounded-xl">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-lg font-semibold text-gray-900">{{ Auth::guard('designer')->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        @if(Auth::guard('designer')->user()->brand_name)
                        <div class="flex items-center p-4 bg-gray-50/50 rounded-xl">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Brand Name</p>
                                <p class="text-lg font-semibold text-gray-900">{{ Auth::guard('designer')->user()->brand_name }}</p>
                            </div>
                        </div>
                        @endif
                        @if(Auth::guard('designer')->user()->phone)
                        <div class="flex items-center p-4 bg-gray-50/50 rounded-xl">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone</p>
                                <p class="text-lg font-semibold text-gray-900">{{ Auth::guard('designer')->user()->phone }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @if(Auth::guard('designer')->user()->portfolio_url || Auth::guard('designer')->user()->bio)
                <div class="mt-8 pt-6 border-t border-gray-200/50">
                    @if(Auth::guard('designer')->user()->portfolio_url)
                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-500 mb-2">Portfolio URL</p>
                        <a href="{{ Auth::guard('designer')->user()->portfolio_url }}" target="_blank" 
                           class="inline-flex items-center text-lg text-blue-600 hover:text-blue-800 font-medium">
                            {{ Auth::guard('designer')->user()->portfolio_url }}
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                    @endif
                    @if(Auth::guard('designer')->user()->bio)
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Bio</p>
                        <p class="text-gray-900 leading-relaxed">{{ Auth::guard('designer')->user()->bio }}</p>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection