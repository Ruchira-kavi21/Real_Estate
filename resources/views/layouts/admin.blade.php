<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;700&display=swap');
        body {
            font-family: 'Maven Pro', sans-serif;
        }
    </style>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <header class="nav-bar-section bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('Images/logo.png') }}" alt="Haven Homes Logo" class="w-20 h-15 mr-2">
                <span class="text-2xl font-bold text-teal-600">Haven Homes</span>
            </a>
            <nav class="flex space-x-6">
                <a href="{{ route('admin') }}" class="text-lg text-gray-700 hover:text-teal-600">Admin Dashboard</a>
                <a href="{{ route('admin.add-property') }}" class="text-lg text-gray-700 hover:text-teal-600">Add</a>
                <a href="{{ route('admin.users') }}" class="text-lg text-gray-700 hover:text-teal-600">Users</a>
                <a href="{{ route('admin.list') }}" class="text-lg text-gray-700 hover:text-teal-600">List</a>
            </nav>
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <span class="text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700">Logout</button>
                    </form>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700">Log In</a>
                        <a href="{{ route('register') }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    @include('layouts.footer')
    @livewireScripts
</body>
</html>