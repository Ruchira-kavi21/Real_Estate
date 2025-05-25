@extends('layouts.app')

@section('title', 'Home')
@section('content')
<body class="bg-gray-100">
    <section class="text-center py-10 relative">
        <div class="main_img relative">
            <img src="{{ asset('images/hero_lands.jpg') }}" alt="hero image" class="w-screen h-[500px] object-cover">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <!-- Text Content -->
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white">
                <h1 class="text-6xl font-bold">Discover Your Ideal Land Today</h1>
                <h2 class="font-bold mt-4 text-xl">
                    Explore a wide range of lands tailored for your needs — residential, commercial, <br>
                    or agricultural. Find the perfect location to bring your vision to life.
                </h2>
            </div>
        </div>
    </section>
    <section class="max-w-6xl mx-auto mt-16 p-8 bg-white">
        <h1 class="text-2xl font-bold text-center mb-6">Properties for Sale</h1>
        @if ($properties->isEmpty())
            <p class="text-center text-gray-500">No properties available for sale.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                @foreach ($properties as $property)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ $property->image_1 ? asset('storage/' . $property->image_1) : asset('images/default.jpg') }}" alt="{{ $property->property_name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-lg font-bold text-gray-800">{{ $property->property_name }}</h2>
                            <p class="text-teal-600 font-bold">{{ number_format($property->property_price, 2) }} Million</p>
                            <p class="text-gray-600">Address: {{ $property->property_address }}</p>
                            <p class="text-gray-600">📞 {{ $property->phone_number }}</p>
                            <div class="flex justify-between mt-4">
                                <a href="{{ route('user.view', $property->id) }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-800">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
    @include('layouts.subscribe')
    @include('layouts.footer')
@endsection
