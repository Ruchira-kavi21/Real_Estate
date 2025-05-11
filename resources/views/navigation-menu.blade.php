<header class="bg-white" style="position:sticky; top:0; z-index:100;">
    <nav class="container mx-auto flex items-center justify-between py-4 px-6 " ">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Haven Homes Logo" class="w-20 h-15 mr-2">
                <span class="text-2xl font-bold text-teal-600">Haven Homes</span>
            </a>
        </div>

        <!-- Navigation Links (Desktop) -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('home') }}" class="text-lg text-gray-700 hover:text-teal-600">Home</a>
            <a href="{{ route('lands') }}" class="text-lg text-gray-700 hover:text-teal-600">Lands</a>
            <a href="{{ route('rent') }}" class="text-lg text-gray-700 hover:text-teal-600">Rent</a>
            <a href="{{ route('sell.index') }}" class="text-lg text-gray-700 hover:text-teal-600">Sell</a>
            <a href="{{ route('about') }}" class="text-lg text-gray-700 hover:text-teal-600">About Us</a>
        </div>

        <!-- Auth Links (Desktop) -->
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

        <!-- Hamburger Menu (Mobile) -->
        <div class="md:hidden">
            <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-white shadow hidden">
        <div class="container mx-auto px-6 py-4">
            <div class="flex flex-col space-y-4">
                <a href="{{ route('home') }}" class="text-lg text-gray-700 hover:text-teal-600">Home</a>
                <a href="{{ route('lands') }}" class="text-lg text-gray-700 hover:text-teal-600">Lands</a>
                <a href="{{ route('rent') }}" class="text-lg text-gray-700 hover:text-teal-600">Rent</a>
                <a href="{{ route('sell.index') }}" class="text-lg text-gray-700 hover:text-teal-600">Sell</a>
                <a href="{{ route('about') }}" class="text-lg text-gray-700 hover:text-teal-600">About Us</a>
                @auth
                    <div class="flex flex-col space-y-2">
                        <span class="text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700 w-full text-left">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('login') }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700 text-center">Log In</a>
                        <a href="{{ route('register') }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300 text-center">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>