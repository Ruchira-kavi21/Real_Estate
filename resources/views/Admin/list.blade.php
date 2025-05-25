<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property List</title>
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($properties as $property)
                <div class="border rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $property->image_1) }}" alt="Property Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-bold text-gray-800">{{ $property->property_name }}</h2>
                        <p class="text-gray-600">{{ $property->property_address }}</p>
                        <p class="text-gray-600">📞 {{ $property->phone_number }}</p>
                        <p class="text-teal-600 font-bold">{{ number_format($property->property_price, 2) }} Million</p>
                        <div class="flex justify-between mt-4">
                            <a href="{{ route('admin.edit-property', $property->id) }}" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600">Edit</a>
                            <a href="{{ route('admin.view', $property->id) }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-800">View</a>
                            <form method="POST" action="{{ route('admin.delete-property', $property->id) }}" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No properties found.</p>
            @endforelse
        </div>
    </div>
</body>
</html>