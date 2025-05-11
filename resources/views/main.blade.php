<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Haven Homes')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;700&display=swap');
        body {
            font-family: 'Maven Pro', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    @include('navigation-menu')

    <main>
        @yield('content')
    </main>

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
                    <li><a href="{{ route('sell.index') }}" class="hover:text-teal-400">Sell</a></li>
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
            <p>© 2025 Haven Homes. All rights reserved.</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>