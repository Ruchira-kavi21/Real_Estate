
@extends('layouts.app')

@section('title', 'Home')
@section('content')
    <section class="text-center py-10 relative">
        <div class="main_img relative">
            <img src="{{ asset('images/hero_rent.webp') }}" alt="hero image" class="w-screen h-[500px] object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white">
                <h1 class="text-6xl font-bold">Find Your Perfect Rental Space</h1>
                <h2 class="font-bold mt-4 text-xl">
                    Explore a variety of rental properties designed to meet your needs <br>
                    whether it's residential, commercial, or vacation spaces. <br>
                    Let us help you find your ideal home or business location.
                </h2>
            </div>
        </div>
    </section>
    <section class="max-w-6xl mx-auto mt-16 p-8 bg-white ">
        <h1 class="text-2xl font-bold text-center mb-6">Properties for Rent</h1>
        @if ($properties->isEmpty())
            <p class="text-center text-gray-500">No properties available for rent.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                @foreach ($properties as $property)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ $property->image_1 ? asset('storage/' . $property->image_1) : asset('images/default.jpg') }}" alt="{{ $property->property_name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $property->property_name }}</h3>
                            <p class="text-gray-600">Price: LKR {{ number_format($property->property_price, 2) }}</p>
                            <p class="text-gray-600">Address: {{ $property->property_address }}</p>
                            <p class="text-gray-600">📞 {{ $property->phone_number }}</p>
                        </div>
                        <div class="flex justify-between mt-4">
                            <a href="{{ route('user.view', $property->id) }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-800">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
    @include('layouts.subscribe')
    @include('layouts.footer')
@endsection
