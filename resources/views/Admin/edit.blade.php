<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
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
                <a href="{{ route('admin') }}" class="text-lg text-gray-700 hover:text-teal-600">Admin Dashboard</a>
                <a href="{{ route('admin.add-property') }}" class="text-lg text-gray-700 hover:text-teal-600">Add</a>
                <a href="{{ route('admin.users') }}" class="text-lg text-gray-700 hover:text-teal-600">Users</a>
                <a href="{{ route('admin.list') }}" class="text-lg text-gray-700 hover:text-teal-600">List</a>
            </nav>
            <a href="{{ route('login') }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700">Log In</a>
        </div>
    </header>

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Property</h1>
        <form action="{{ route('admin.edit-property', $property->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <input type="hidden" name="id" value="{{ $property->id }}">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_name">Property Name</label>
                <input type="text" name="property_name" value="{{ $property->property_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_price">Price</label>
                <input type="number" name="property_price" value="{{ $property->property_price }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_address">Address</label>
                <input type="text" name="property_address" value="{{ $property->property_address }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" value="{{ $property->phone_number }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="offer_type">Offer Type</label>
                <select name="offer_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="rent" {{ $property->offer_type === 'rent' ? 'selected' : '' }}>Rent</option>
                    <option value="sale" {{ $property->offer_type === 'sale' ? 'selected' : '' }}>Sale</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_status">Status</label>
                <select name="property_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="pending" {{ $property->property_status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $property->property_status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="declined" {{ $property->property_status === 'declined' ? 'selected' : '' }}>Declined</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_type">Property Type</label>
                <input type="text" name="property_type" value="{{ $property->property_type }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="finish_status">Finish Status</label>
                <input type="text" name="finish_status" value="{{ $property->finish_status }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_description">Description</label>
                <textarea name="property_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $property->property_description }}</textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600">Save Changes</button>
                <a href="{{ route('admin.list') }}" class="text-gray-500 hover:text-gray-800">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>