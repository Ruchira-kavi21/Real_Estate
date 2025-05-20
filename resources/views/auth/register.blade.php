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
    <section class="max-w-xl mx-auto mt-16 p-8 bg-white shadow-lg rounded-lg">
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
            <div class="flex items-center border border-gray-300 rounded-lg p-2">
                <span class="text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </span>
                <select name="role" class="w-full pl-4 outline-none" required>
                    <option value="">Select Role</option>
                    <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="seller" {{ old('role') === 'seller' ? 'selected' : '' }}>Seller</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
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

    <!-- Subscription Section -->
    <section class="bg-white text-center py-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold text-teal-500">Don't miss out</h2>
            <p class="text-gray-600 mt-2 mb-6">Limited-time offers and discounts for subscribers only.</p>
            <form method="POST" action="{{ route('subscribe') }}" class="mt-6 flex justify-center">
                @csrf
                <input type="email" name="email" placeholder="Your email is safe with us" class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-teal-400" required />
                <button type="submit" class="px-6 py-2 bg-gray-800 text-white font-semibold rounded-r-md hover:bg-gray-700 focus:outline-none">
                    Subscribe
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-200 py-10">
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">Stay In Touch</h3>
                <p class="flex items-center"><span class="mr-2">📞</span> +94 715866790</p>
                <p class="flex items-center"><span class="mr-2">📞</span> +94 112488544</p>
                <p class="flex items-center"><span class="mr-2">✉️</span> havenhomes@gmail.com</p>
                <p class="flex items-center"><span class="mr-2">📍</span> 11, 1st Lane, Kottawa, Sri Lanka</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-teal-400">Home</a></li>
                    <li><a href="#" class="hover:text-teal-400">Lands</a></li>
                    <li><a href="#" class="hover:text-teal-400">Rent</a></li>
                    <li><a href="#" class="hover:text-teal-400">Sell</a></li>
                    <li><a href="#" class="hover:text-teal-400">About Us</a></li>
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
</body>
</html>