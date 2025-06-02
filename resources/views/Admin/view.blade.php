<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Property</title>
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
   

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $property->property_name }}</h1>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
            <div class="mb-4">
                <strong>Price:</strong> {{ number_format($property->property_price, 2) }} Million
            </div>
            <div class="mb-4">
                <strong>Offer Type:</strong> {{ ucfirst($property->offer_type) }}
            </div>
            <div class="mb-4">
                <strong>Property Address:</strong> {{ $property->property_address }}
            </div>
            <div class="mb-4">
                <strong>Status:</strong> {{ ucfirst($property->property_status) }}
            </div>
            <div class="mb-4">
                <strong>Property Type:</strong> {{ ucfirst($property->property_type) }}
            </div>
            <div class="mb-4">
                <strong>Finish Status:</strong> {{ ucfirst($property->finish_status) }}
            </div>
            <div class="mb-4">
                <strong>Phone Number:</strong> {{ $property->phone_number }}
            </div>
            <div class="mb-4">
                <strong>Description:</strong>
                <p>{{ $property->property_description }}</p>
            </div>
            <div class="mb-4">
                <strong>Created At:</strong> {{ \Carbon\Carbon::parse($property->created_at)->format('F j, Y, g:i a') }}
            </div>
            <div class="mb-4">
                <strong>Images:</strong>
                <div class="flex space-x-4 mt-2">
                    @if ($property->image_1)
                        <img src="{{ asset('storage/' . $property->image_1) }}" alt="Property Image 1" class="w-48 h-32 object-cover">
                    @endif
                    @if ($property->image_2)
                        <img src="{{ asset('storage/' . $property->image_2) }}" alt="Property Image 2" class="w-48 h-32 object-cover">
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-6">
            <a href="{{ route('admin.list') }}" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600">Back to List</a>
        </div>
    </div>

    
</body>
</html>