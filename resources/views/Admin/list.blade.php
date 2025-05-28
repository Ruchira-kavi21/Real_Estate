@extends('layouts.admin')

@section('title', 'Add Property')

@section('content')
<div class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($properties as $property)
                <div class="border rounded-lg shadow-lg overflow-hidden">
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
                        <p class="text-gray-600">📞 {{ $property->phone_number }}</p>
                        <p class="text-teal-600 font-bold">{{ number_format($property->property_price, 2) }} Million</p>
                        <p class="text-gray-600">{{ $property->user->name }}</p>
                        <p class="text-gray-600 font-bold">{{ $property->property_status }}</p>
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
@endsection