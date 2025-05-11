@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Head Section -->
    <section class="text-center py-10 mt-20">
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold text-gray-800">Find Your Perfect Space Today</h1>
            <p class="text-lg text-gray-600 mt-4">Let us help you make informed decisions about your next home.</p>
            <a href="{{ route('search') }}" class="mt-10 inline-block bg-teal-600 text-white py-3 px-6 rounded-lg hover:bg-teal-700">Search Now</a>
            <div class="mt-2">
                <img src="{{ asset('images/hero.jpg') }}" alt="Happy home buyers" class="mx-auto max-w-8xl">
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-6xl font-bold text-gray-800">Our Services</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
                @foreach([
                    ['icon' => 'buy-house.png', 'title' => 'Buy House', 'description' => 'Find your dream home with ease! Explore verified listings and step closer to owning your perfect house.'],
                    ['icon' => 'rent-house.png', 'title' => 'Rent House', 'description' => 'Discover rental options that fit your lifestyle and budget. Start your search hassle-free today.'],
                    ['icon' => 'buy-land.jpg', 'title' => 'Buy Land', 'description' => 'Unlock endless possibilities—browse prime land listings for your next big investment or personal project.'],
                    ['icon' => 'search-property.png', 'title' => 'Search Property', 'description' => 'Streamline your search with advanced filters. Locate the property that matches your exact needs effortlessly.'],
                    ['icon' => 'sell-property.png', 'title' => 'Sell Property', 'description' => 'Reach the right buyers faster! Showcase your property and enjoy a seamless selling experience.'],
                    ['icon' => 'service.png', 'title' => '24/7 Service', 'description' => 'Always here for you! Our round-the-clock support ensures your questions are answered anytime, anywhere.']
                ] as $service)
                    <div class="bg-white shadow-lg p-6 rounded-lg">
                        <img src="{{ asset('images/icons/' . $service['icon']) }}" alt="{{ $service['title'] }} Icon" class="w-12 mx-auto">
                        <h3 class="text-2xl font-semibold mt-4">{{ $service['title'] }}</h3>
                        <p class="text-gray-600 mt-2">{{ $service['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Properties Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-teal-600">Highly Rated by Our Customers</h2>
            <p class="text-gray-600 mt-4">Join over 10,000 happy clients who trust us for their real estate needs!</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                @foreach($properties as $property)
                    <div class="bg-white shadow-lg rounded-lg">
                        <img src="{{ asset('images/properties/' . $property->image) }}" alt="{{ $property->name }}" class="w-full h-64 object-cover rounded-t-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $property->name }}</h3>
                            <p class="text-gray-600">Rating: {{ $property->rating }} ★</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('properties.index') }}" class="mt-6 inline-block bg-teal-600 text-white py-3 px-6 rounded-lg hover:bg-teal-700">View All</a>
        </div>
    </section>

    <!-- Subscription Section -->
    <section class="bg-white text-center py-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold text-teal-500">Don't miss out</h2>
            <p class="text-gray-600 mt-2 mb-6">Limited-time offers and discounts for subscribers only.</p>
            <form method="POST" action="{{ route('subscribe') }}" class="mt-6 flex justify-center">
                @csrf
                <input
                    type="email"
                    name="email"
                    placeholder="Your email is safe with us"
                    class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-teal-400"
                    required/>
                <button type="submit" class="px-6 py-2 bg-gray-800 text-white font-semibold rounded-r-md hover:bg-gray-700 focus:outline-none">
                    Subscribe
                </button>
            </form>
        </div>
    </section>
@endsection