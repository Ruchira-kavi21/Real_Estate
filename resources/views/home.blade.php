@extends('layouts.app')

@section('title', 'Home page')

@section('content')
    <section class="text-center py-10 mt-20">
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold text-gray-800">Find Your Perfect Space Today</h1>
            <p class="text-lg text-gray-600 mt-4">Let us help you make informed decisions about your next home.</p>
            <button class="mt-10 bg-teal-600 text-white py-3 px-6 rounded-lg hover:bg-teal-700">Search Now</button>
            <div class="mt-2">
                <img src="{{ asset('images/hero.jpg') }}" alt="Happy home buyers" class="mx-auto max-w-8xl">
            </div>
        </div>
    </section>
    
    <section class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-6xl font-bold text-gray-800">Our Services</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <img src="{{ asset('images/icons/buy-house.png') }}" alt="Buy House Icon" class="w-12 mx-auto">
                    <h3 class="text-2xl font-semibold mt-4">Buy House</h3>
                    <p class="text-gray-600 mt-2">Find your dream home with ease! Explore verified listings and step closer to owning your perfect house.</p>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <img src="{{ asset('images/icons/rent-house.png') }}" alt="Rent House Icon" class="w-12 mx-auto">
                    <h3 class="text-2xl font-semibold mt-4">Rent House</h3>
                    <p class="text-gray-600 mt-2">Discover rental options that fit your lifestyle and budget. Start your search hassle-free today.</p>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <img src="{{ asset('images/icons/buy-land.jpg') }}" alt="Buy Land Icon" class="w-12 mx-auto">
                    <h3 class="text-2xl font-semibold mt-4">Buy Land</h3>
                    <p class="text-gray-600 mt-2">Unlock endless possibilities—browse prime land listings for your next big investment or personal project.</p>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <img src="{{ asset('images/icons/search-property.png') }}" alt="Search Property Icon" class="w-12 mx-auto">
                    <h3 class="text-2xl font-semibold mt-4">Search Property</h3>
                    <p class="text-gray-600 mt-2">Streamline your search with advanced filters. Locate the property that matches your exact needs effortlessly.</p>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <img src="{{ asset('images/icons/sell-property.png') }}" alt="Sell Property Icon" class="w-12 mx-auto">
                    <h3 class="text-2xl font-semibold mt-4">Sell Property</h3>
                    <p class="text-gray-600 mt-2">Reach the right buyers faster! Showcase your property and enjoy a seamless selling experience.</p>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <img src="{{ asset('images/icons/service.png') }}" alt="24/7 Service Icon" class="w-12 mx-auto">
                    <h3 class="text-2xl font-semibold mt-4">24/7 Service</h3>
                    <p class="text-gray-600 mt-2">Always here for you! Our round-the-clock support ensures your questions are answered anytime, anywhere.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-teal-600">Highly Rated by Our Customers</h2>
            <p class="text-gray-600 mt-4">Join over 10,000 happy clients who trust us for their real estate needs!</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                @forelse($lands as $land)
                    <div class="bg-white shadow-lg rounded-lg">
                        <img src="{{ $land->image_1 ? asset('storage/' . $land->image_1) : asset('images/properties/property1.jpeg') }}" alt="{{ $land->property_name }}" class="w-full h-64 object-cover rounded-t-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $land->property_name }}</h3>
                            <p class="text-gray-600">Rating: 4.3 ★</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No lands available.</p>
                @endforelse
                @forelse($houses as $house)
                    <div class="bg-white shadow-lg rounded-lg">
                        <img src="{{ $house->image_1 ? asset('storage/' . $house->image_1) : asset('images/properties/property4.jpg') }}" alt="{{ $house->property_name }}" class="w-full h-64 object-cover rounded-t-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $house->property_name }}</h3>
                            <p class="text-gray-600">Rating: 4.3 ★</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No houses available.</p>
                @endforelse
            </div>
            <button class="mt-6 bg-teal-600 text-white py-3 px-6 rounded-lg hover:bg-teal-700">View All</button>
        </div>
    </section>

    @include('layouts.subscribe')
    @include('layouts.footer')
@endsection