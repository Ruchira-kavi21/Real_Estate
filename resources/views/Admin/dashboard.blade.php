<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;700&display=swap');
        body {
            font-family: 'Maven Pro', sans-serif;
            background-color: #f7fafc;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="nav-bar-section bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('Images/logo.png') }}" alt="Haven Homes Logo" class="w-20 h-15 mr-2">
                <span class="text-2xl font-bold text-teal-600">Haven Homes</span>
            </a>
            <nav class="flex space-x-6">
                <a href="{{ route('admin.dashboard') }}" class="text-lg text-gray-700 hover:text-teal-600">Admin Dashboard</a>
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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 mt-5 p-6 ">
        <div class="bg-gray-100 rounded-lg shadow-md p-6">
            <h4 class="text-lg font-semibold mb-2">Total Properties </h4>
            <p class="text-3xl font-bold">{{ $totalProperties }}</p>
        </div>
        <div class="bg-gray-100 rounded-lg shadow-md p-6">
            <h4 class="text-lg font-semibold mb-2">Total Sellers</h4>
            <p class="text-3xl font-bold">{{ $totalSellers }}</p>
        </div>
        <div class="bg-gray-100 rounded-lg shadow-md p-6">
            <h4 class="text-lg font-semibold mb-2">Total Customers</h4>
            <p class="text-3xl font-bold">{{ $totalCustomers }}</p>
        </div>
        
    </div>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard - Approve or Decline Properties</h1>
        <!-- Pending Properties -->
        @if ($pendingProperties->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($pendingProperties as $property)
                    <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
                        <!-- conditional check and fallback for image -->
                        @if ($property->image_1 && file_exists(storage_path('app/public/' . $property->image_1)))
                            <img src="{{ asset('storage/' . $property->image_1) }}" alt="Property Image" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <p class="text-gray-500">No Image Available</p>
                            </div>
                        @endif
                        <div class="p-4">
                            <h2 class="text-lg font-bold text-gray-800">{{ $property->property_name }}</h2>
                            <p class="text-gray-600">{{ $property->property_address }}</p>
                            <p class="text-teal-600 font-bold">{{ number_format($property->property_price, 2) }} Million</p>
                            <div class="flex justify-between mt-4">
                                <form method="POST" action="{{ route('admin.approve', $property->id) }}" class="inline-block">
                                    @csrf
                                    <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600">Accept</button>
                                </form>
                                <form method="POST" action="{{ route('admin.decline', $property->id) }}" class="inline-block">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600">Decline</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">No new properties awaiting approval.</p>
        @endif
    </div>
    <!-- Approved Properties (Current List) -->
    @if ($properties->isNotEmpty())
    <div class="mt-8 ml-44 mb-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Approved Properties</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($properties as $property)
            <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
                <!-- Changed: Added conditional check and fallback for image -->
                @if ($property->image_1 && file_exists(storage_path('app/public/' . $property->image_1)))
                <img src="{{ asset('storage/' . $property->image_1) }}" alt="Property Image" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <p class="text-gray-500">No Image Available</p>
                </div>
                @endif
                <div class="p-4">
                    <h2 class="text-lg font-bold text-gray-800">{{ $property->property_name }}</h2>
                    <p class="text-gray-600">{{ $property->property_address }}</p>
                    <p class="text-teal-600 font-bold">{{ number_format($property->property_price, 2) }} Million</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500 mt-8">No approved properties.</p>
        @endif
    </div>

    @include('layouts.footer')
</body>
</html>