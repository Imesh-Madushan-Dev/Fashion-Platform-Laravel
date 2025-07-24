<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Designer Login - DesignSphere</title>
    
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
                    },
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-lg border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex-shrink-0">
                        <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            DesignSphere
                        </span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/buyer/login') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 text-sm font-medium rounded-lg transition-colors">
                        Buyer Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-center">
                <div class="w-full max-w-md">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="mx-auto w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5H9a2 2 0 00-2 2v12a4 4 0 004 4h6a2 2 0 002-2V7a2 2 0 00-2-2z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back, Designer</h2>
                        <p class="text-gray-600">Sign in to showcase your creative designs</p>
                    </div>

                    <!-- Form -->
                    <div class="bg-white shadow-2xl rounded-2xl p-8 border border-gray-100">
                        <form method="POST" action="{{ route('designer.login') }}" class="space-y-6">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                        </svg>
                                    </div>
                                    <input id="email" type="email" 
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 ring-2 ring-red-500 @enderror" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Enter your email address"
                                           required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <input id="password" type="password" 
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password') border-red-500 ring-2 ring-red-500 @enderror" 
                                           name="password" 
                                           placeholder="Enter your password"
                                           required autocomplete="current-password">
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Remember me</span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" 
                                        class="w-full flex justify-center items-center px-4 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white text-sm font-semibold rounded-xl hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    Sign In to Your Account
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Don't have an account?</span>
                                </div>
                            </div>

                            <!-- Registration Link -->
                            <div>
                                <a href="{{ route('designer.register') }}" 
                                   class="w-full flex justify-center items-center px-4 py-3 border border-blue-300 text-blue-600 text-sm font-semibold rounded-xl hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    Create Designer Account
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-8">
                        <p class="text-sm text-gray-500">
                            Want to shop for designs instead? 
                            <a href="{{ url('/buyer/register') }}" class="text-purple-600 hover:text-purple-700 font-semibold">
                                Register as Buyer
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>