<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Property</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;700&display=swap');
        body {
            font-family: 'Maven Pro', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <x-navbar />
    <section class="max-w-4xl mx-auto mt-16 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Submit a Property</h1>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-4 rounded-lg">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('sell.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="property_name" class="block text-sm font-medium text-gray-700">Property Name</label>
                <input type="text" name="property_name" id="property_name" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="property_description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="property_description" id="property_description" class="w-full p-2 border border-gray-300 rounded-lg" required></textarea>
            </div>
            <div class="mb-4">
                <label for="property_price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="property_price" id="property_price" step="0.01" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="property_address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="property_address" id="property_address" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="offer_type" class="block text-sm font-medium text-gray-700">Offer Type</label>
                <select name="offer_type" id="offer_type" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="sale">Sale</option>
                    <option value="rent">Rent</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="property_type" class="block text-sm font-medium text-gray-700">Property Type</label>
                <select name="property_type" id="property_type" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="apartment">Apartment</option>
                    <option value="house">House</option>
                    <option value="land">Land</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="finish_status" class="block text-sm font-medium text-gray-700">Finish Status</label>
                <select name="finish_status" id="finish_status" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="finished">Finished</option>
                    <option value="unfinished">Unfinished</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="image_1" class="block text-sm font-medium text-gray-700">Image 1</label>
                <input type="file" name="image_1" id="image_1" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="image_2" class="block text-sm font-medium text-gray-700">Image 2</label>
                <input type="file" name="image_2" id="image_2" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <button type="submit" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700">Submit Property</button>
        </form>
    </section>
    <footer class="bg-gray-800 text-gray-200 py-10">
        <div class="container mx-auto text-center">
            <p>© 2025 Haven Homes. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>