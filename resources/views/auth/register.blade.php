<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;700&display=swap');
        body {
            font-family: 'Maven Pro', sans-serif;
        }
    </style>
</head>
<body class="Login_section bg-gray-100">
    <!-- Navbar -->
    <header class="nav-bar-section bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <a href="{{ url('/index') }}" class="flex items-center space-x-2">
                <img src="{{ asset('Images/logo.png') }}" alt="Haven Homes Logo" class="w-20 h-15 mr-2">
                <span class="text-2xl font-bold text-teal-600">Haven Homes</span>
            </a>
            <a href="{{ route('login') }}">
                <button class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700">Log In</button>
            </a>
        </div>
    </header>

    <!-- Signup Section -->
    <section class="max-w-xl mx-auto mt-16 mb-20 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Sign Up Please</h1>
        @if ($errors->any())
            <div class="mb-4 text-red-600 text-center">
                {{ $errors->first() }}
            </div>
        @endif
        @if (session('status'))
            <div class="mb-4 text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Name -->
            <div class="flex items-center border border-gray-300 rounded-lg p-2">
                <span class="text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </span>
                <input type="text" name="name" placeholder="Enter Your Name" class="w-full pl-4 outline-none" value="{{ old('name') }}" required autofocus>
            </div>
            <!-- Email -->
            <div class="flex items-center border border-gray-300 rounded-lg p-2">
                <span class="text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </span>
                <input type="email" name="email" placeholder="Enter Your email address" class="w-full pl-4 outline-none" value="{{ old('email') }}" required>
            </div>
            <!-- Password -->
            <div class="flex items-center border border-gray-300 rounded-lg p-2">
                <span class="text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>
                </span>
                <input type="password" name="password" placeholder="Enter Your password" class="w-full pl-4 outline-none" required>
            </div>
            <!-- Confirm Password -->
            <div class="flex items-center border border-gray-300 rounded-lg p-2">
                <span class="text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>
                </span>
                <input type="password" name="password_confirmation" placeholder="Confirm Your password" class="w-full pl-4 outline-none" required>
            </div>
            <!-- Role -->
            <div class="mt-4">
                <x-label for="role" value="{{ __('Role') }}" />
                <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="seller" {{ old('role') === 'seller' ? 'selected' : '' }}>Seller</option>
                </select>
            </div>
            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="w-1/3 bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700">Sign Up</button>
            </div>
            <hr class="my-6 w-29/30 mx-auto border-t border-gray-800">
            <p class="text-center text-sm mt-4">Already have an account? <a href="{{ route('login') }}" class="text-teal-600 hover:underline">LOG IN</a></p>
        </form>
    </section>

    @include('layouts.subscribe')
    @include('layouts.footer')
</body>
</html>