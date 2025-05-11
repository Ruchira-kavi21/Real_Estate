<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haven Homes - @yield('title', 'Home')</title>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Maven Pro', sans-serif;
        }
    </style>
</head>
<body class="home_section">
    <!-- Navbar -->
    <header class="nav-bar-section">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Haven Homes Logo" class="w-20 h-15 mr-2">
                <span class="text-2xl font-bold text-teal-600">Haven Homes</span>
            </a>
            <nav class="flex space-x-6">
                <a href="{{ route('home') }}" class="text-lg text-gray-700 hover:text-teal-600">Home</a>
                <a href="{{ route('lands') }}" class="text-lg text-gray-700 hover:text-teal-600">Lands</a>
                <a href="{{ route('rent') }}" class="text-lg text-gray-700 hover:text-teal-600">Rent</a>
                <a href="{{ route('sell') }}" class="text-lg text-gray-700 hover:text-teal-600">Sell</a>
                <a href="{{ route('about') }}" class="text-lg text-gray-700 hover:text-teal-600">About Us</a>
            </nav>
            @auth
                <a href="{{ route('dashboard') }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700">Log In</a>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-200 py-10">
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">Stay In Touch</h3>
                <p class="flex items-center"><i class="mr-2">📞</i> +94 715866790</p>
                <p class="flex items-center"><i class="mr-2">📞</i> +94 112488544</p>
                <p class="flex items-center"><i class="mr-2">✉️</i> havenhomes@gmail.com</p>
                <p class="flex items-center"><i class="mr-2">📍</i> 11, 1st Lane, Kottawa, Sri Lanka</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-teal-400">Home</a></li>
                    <li><a href="{{ route('lands') }}" class="hover:text-teal-400">Lands</a></li>
                    <li><a href="{{ route('rent') }}" class="hover:text-teal-400">Rent</a></li>
                    <li><a href="{{ route('sell') }}" class="hover:text-teal-400">Sell</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-teal-400">About Us</a></li>
                    <li><a href="#" class="hover:text-teal-400">Terms & Conditions</a></li>
                    <li><a href="#" class="hover:text-teal-400">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Connect With</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-teal-400">Facebook</a></li>
                    <li><a href="#" class="hover:text-teal-400">Twitter</a></li>
                    <li><a href="#" class="hover:text-teal-400">Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-10 border-t border-gray-700 pt-4">
            <p>© 2024 Haven Homes. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>