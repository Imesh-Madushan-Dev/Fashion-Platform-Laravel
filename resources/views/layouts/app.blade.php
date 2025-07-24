<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fashion Platform') }}</title>

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
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Fixed Navigation -->
        <nav class="bg-white/95 backdrop-blur-md shadow-lg border-b border-gray-200/50 fixed top-0 left-0 right-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            @php
                                $dashboardRoute = '/';
                                if (Auth::guard('designer')->check()) {
                                    $dashboardRoute = route('designer.dashboard');
                                } elseif (Auth::guard('buyer')->check()) {
                                    $dashboardRoute = route('buyer.dashboard');
                                }
                            @endphp
                            <a href="{{ $dashboardRoute }}" class="text-2xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent hover:from-blue-700 hover:via-purple-700 hover:to-indigo-700 transition-all duration-300">
                                DesignSphere
                            </a>
                        </div>
                    </div>

                    <!-- Right Side of Navbar -->
                    <div class="flex items-center space-x-4">
                        @yield('nav-links')
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content with top padding to account for fixed header -->
        <main class="pt-16">
            @yield('content')
        </main>
    </div>
</body>
</html>