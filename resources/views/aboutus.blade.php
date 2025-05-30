@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <!-- Why Choose Us Section -->
    <section class="bg-white py-10 px-6 max-w-6xl mx-auto mt-8 rounded-lg">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="w-full lg:w-[1500px] lg:-ml-72 flex justify-center">
                <img src="{{ asset('Images/about.png') }}" alt="House Illustration" class="w-full lg:w-5/6 h-auto max-w-md lg:max-w-none">
            </div>
            <div class="w-full lg:w-5/6 lg:pl-6">
                <h2 class="text-2xl lg:text-2xl font-bold text-gray-800 lg:-mt-10">Why Choose Us</h2>
                <p class="mt-4 text-gray-600 text-base lg:text-lg">
                    At Haven Homes, we prioritize your needs, offering trusted services to buy, rent, or sell properties seamlessly.
                    With a proven track record, personalized support, and transparent processes, we ensure your property journey is smooth and rewarding.
                    Discover the difference with us today.
                </p>
            </div>
        </div>
    </section>
    <!-- Focus on Property Search and Buying -->
    <div class="bg-white py-10 px-6 max-w-6xl mx-auto mt-8 rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Keep the Focus on Property Search and Buying</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="text-center bg-gray-100 p-6 rounded-lg">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('Images/Icons/buy-house.png') }}" alt="Search Icon" class="w-16 h-auto">
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Search Property</h3>
                <p class="mt-2 text-gray-600 text-sm">
                    Find Your Dream Home With Our Easy-To-Use Search Engine.
                </p>
            </div>
            <div class="text-center bg-gray-100 p-6 rounded-lg">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('Images/Icons/rent-house.png') }}" alt="Agents Icon" class="w-16 h-auto">
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Contact Agents</h3>
                <p class="mt-2 text-gray-600 text-sm">
                    Connect With Experienced Agents Who Can Guide You Through The Buying Process.
                </p>
            </div>
            <div class="text-center bg-gray-100 p-6 rounded-lg">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('Images/Icons/1-40-512.webp') }}" alt="Land for Sale Icon" class="w-16 h-auto">
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Enjoy Property</h3>
                <p class="mt-2 text-gray-600 text-sm">
                    Move Into Your New Home And Start Living Your Best Life.
                </p>
            </div>
        </div>
    </div>

    <!-- Featured Properties Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-teal-600">Highly Rated by Our Customers</h2>
            <p class="text-gray-600 mt-4">Join over 10,000 happy clients who trust us for their real estate needs!</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                <div class="bg-white shadow-lg rounded-lg">
                    <img src="{{ asset('Images/Properties/property1.jpeg') }}" alt="Property 1" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">123, Battaramulla</h3>
                        <p class="text-gray-600">Rating: 4.3 ★</p>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg">
                    <img src="{{ asset('Images/Properties/property2.jpeg') }}" alt="Property 2" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">456, Malabe</h3>
                        <p class="text-gray-600">Rating: 4.3 ★</p>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg">
                    <img src="{{ asset('Images/Properties/property3.jpeg') }}" alt="Property 3" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">789, Athurugiriya</h3>
                        <p class="text-gray-600">Rating: 4.3 ★</p>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg">
                    <img src="{{ asset('Images/Properties/property4.jpg') }}" alt="Property 1" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">123, Nugegoda</h3>
                        <p class="text-gray-600">Rating: 4.3 ★</p>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg">
                    <img src="{{ asset('Images/Properties/property5.jpeg') }}" alt="Property 1" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">123, Rajagiriya</h3>
                        <p class="text-gray-600">Rating: 4.3 ★</p>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg">
                    <img src="{{ asset('Images/Properties/property6.jpeg') }}" alt="Property 1" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">123, Kottawa</h3>
                        <p class="text-gray-600">Rating: 4.3 ★</p>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('rent') }}" class=" bg-teal-600 text-white py-3 px-6 rounded-lg hover:bg-teal-700">View All</a>
            </div>
        </div>
    </section>
    @include('layouts.subscribe')
    @include('layouts.footer')
@endsection