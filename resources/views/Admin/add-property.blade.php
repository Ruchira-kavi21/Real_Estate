<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Add</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;700&display=swap');
        body {
            font-family: 'Maven Pro', sans-serif;
        }
    </style>
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

    <section class="bg-gray-100 flex justify-center items-center min-h-screen">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6 text-center">Add New Property</h1>
            <form action="{{ route('admin.add-property') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="property_name" class="block font-medium text-gray-700">Property Name</label>
                        <input type="text" id="property_name" name="property_name" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4" placeholder="Enter the property name" required>
                    </div>
                    <div>
                        <label for="property_price" class="block font-medium text-gray-700">Property Price</label>
                        <input type="number" id="property_price" name="property_price" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4" placeholder="Enter price in millions" required>
                    </div>
                    <div>
                        <label for="offer_type" class="block font-medium text-gray-700">Offer Type</label>
                        <select id="offer_type" name="offer_type" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4">
                            <option value="sale">For Sale</option>
                            <option value="rent">For Rent</option>
                        </select>
                    </div>
                    <div>
                        <label for="property_address" class="block font-medium text-gray-700">Property Address</label>
                        <textarea id="property_address" name="property_address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow text-base px-4 py-2" placeholder="Enter the property address" required></textarea>
                    </div>
                    <div>
                        <label for="phone_number" class="block font-medium text-gray-700">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4" pattern="[0-9]{10}" placeholder="Enter 10-digit phone number" required>
                    </div>
                    <div>
                        <label for="property_status" class="block font-medium text-gray-700">Property Status</label>
                        <select id="property_status" name="property_status" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4">
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div>
                        <label for="property_type" class="block font-medium text-gray-700">Property Type</label>
                        <select id="property_type" name="property_type" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4">
                            <option value="apartment">Apartment</option>
                            <option value="house">House</option>
                            <option value="land">Land</option>
                        </select>
                    </div>
                    <div>
                        <label for="finish_status" class="block font-medium text-gray-700">Finish Status</label>
                        <select id="finish_status" name="finish_status" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4">
                            <option value="finished">Finished</option>
                            <option value="unfinished">Unfinished</option>
                        </select>
                    </div>
                    <div>
                        <label for="property_description" class="block font-medium text-gray-700">Property Description</label>
                        <textarea id="property_description" name="property_description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow text-base px-4 py-2" placeholder="Enter a brief description" required></textarea>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700">Upload Images</label>
                        <div class="flex space-x-4 mt-1">
                            <input type="file" name="image_1" class="block w-full h-10 text-sm text-gray-500 border-gray-300 rounded-md shadow" accept="image/*">
                            <input type="file" name="image_2" class="block w-full h-10 text-sm text-gray-500 border-gray-300 rounded-md shadow" accept="image/*">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="w-full h-10 bg-teal-600 text-white py-2 px-4 rounded-md shadow-lg hover:bg-teal-700">Post Property</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>