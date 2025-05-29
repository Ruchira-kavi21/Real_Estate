<?php
use function Livewire\Volt\{state, rules, uses};
use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

uses([
    WithFileUploads::class,
]);

state([
    'user' => fn() => auth()->check() ? auth()->user() : null,
    'property_name' => '',
    'property_price' => '',
    'offer_type' => 'sale',
    'property_address' => '',
    'phone_number' => '',
    'property_status' => 'pending',
    'property_type' => 'apartment',
    'finish_status' => 'finished',
    'property_description' => '',
    'image_1' => null,
    'image_2' => null,
    'success' => false,
    'properties' => fn() => auth()->check()
    ? Property::where('user_id', auth()->id())
        ->get()
        ->mapToGroups(function ($item) {
            return [$item->property_type => [
                'id' => $item->id,
                'property_name' => $item->property_name,
                'property_address' => $item->property_address,
                'property_price' => $item->property_price,
                'image_1' => $item->image_1,
            ]];
        })
        ->toArray()
    : [],
]);

rules([
    'property_name' => 'required|string|max:255',
    'property_price' => 'required|numeric|min:0',
    'offer_type' => 'required|in:sale,rent',
    'property_address' => 'required|string|min:10',
    'phone_number' => 'required|regex:/^[0-9]{10}$/',
    'property_status' => 'required|in:pending',
    'property_type' => 'required|in:apartment,house,land',
    'finish_status' => 'required|in:finished,unfinished',
    'property_description' => 'required|string|min:10',
    'image_1' => 'nullable|image|max:2048',
    'image_2' => 'nullable|image|max:2048',
]);

$submit = function () {
    if (!auth()->check()) {
        return; // Prevent submission if not authenticated
    }
    $validated = $this->validate();
    $data = array_merge($validated, [
        'user_id' => auth()->id(),
    ]);

    if ($this->image_1) {
        $data['image_1'] = $this->image_1->store('properties', 'public');
    }
    if ($this->image_2) {
        $data['image_2'] = $this->image_2->store('properties', 'public');
    }

    Property::create($data);
    $this->reset(['property_name', 'property_price', 'offer_type', 'property_address', 'phone_number', 'property_status', 'property_type', 'finish_status', 'property_description', 'image_1', 'image_2']);
    $this->success = true;
};
?>

<div class="container mx-auto py-8">
        @if (!auth()->check())
            <p class="text-red-600 text-center">Please log in to access the Seller Dashboard.</p>
        @elseif ($user)
            @if ($success)
                <p class="text-green-600 text-center mb-4">Property added successfully!</p>
            @endif

            <h1 class="text-3xl font-bold text-gray-800 mb-6">Seller Dashboard</h1>

            <!-- Seller Details -->
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Seller Details</h2>
                <p><strong>Name:</strong> {{ $user->name ?? 'Not provided' }}</p>
                <p><strong>Email:</strong> {{ $user->email ?? 'Not provided' }}</p>
                <p><strong>Phone:</strong> {{ $user->phone ?? 'Not provided' }}</p>
            </div>

            <!-- Sell Form -->
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Add New Property</h2>
                <form wire:submit="submit" class="grid grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="property_name">Property Name</label>
                        <input type="text" wire:model="property_name" id="property_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('property_name') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="property_price">Price</label>
                        <input type="number" wire:model="property_price" id="property_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('property_price') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="offer_type">Offer Type</label>
                        <select wire:model="offer_type" id="offer_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="sale">Sale</option>
                            <option value="rent">Rent</option>
                        </select>
                        @error('offer_type') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="property_address">Address</label>
                        <input type="text" wire:model="property_address" id="property_address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('property_address') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">Phone Number</label>
                        <input type="text" wire:model="phone_number" id="phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('phone_number') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="property_type">Property Type</label>
                        <select wire:model="property_type" id="property_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="apartment">Apartment</option>
                            <option value="house">House</option>
                            <option value="land">Land</option>
                        </select>
                        @error('property_type') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="finish_status">Finish Status</label>
                        <select wire:model="finish_status" id="finish_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="finished">Finished</option>
                            <option value="unfinished">Unfinished</option>
                        </select>
                        @error('finish_status') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="property_description">Description</label>
                        <textarea wire:model="property_description" id="property_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        @error('property_description') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Upload Images</label>
                        <div class="flex space-x-4">
                            <input type="file" wire:model="image_1" class="block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow" accept="image/*">
                            @error('image_1') <span class="text-red-600">{{ $message }}</span> @enderror
                            <input type="file" wire:model="image_2" class="block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow" accept="image/*">
                            @error('image_2') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-span-2">
                        <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600">Submit Property</button>
                    </div>
                </form>
            </div>
            <!-- Added Properties by Type -->
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">My Properties</h2>
                @forelse ($properties as $type => $propertyList)
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ ucfirst($type) }}s</h3>
                        @if (!empty($propertyList))
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($propertyList as $property)
                                    <div class="border rounded-lg shadow-lg overflow-hidden">
                                        @if ($property['image_1'] && Storage::disk('public')->exists($property['image_1']))
                                            <img src="{{ asset('storage/' . $property['image_1']) }}" alt="Property Image" class="w-full h-32 object-cover">
                                        @else
                                            <div class="w-full h-32 bg-gray-200 flex items-center justify-center">
                                                <p class="text-gray-500">No Image Available</p>
                                            </div>
                                        @endif
                                        <div class="p-4">
                                            <h4 class="text-md font-bold text-gray-800">{{ $property['property_name'] }}</h4>
                                            <p class="text-gray-600">{{ $property['property_address'] }}</p>
                                            <p class="text-teal-600 font-bold">{{ number_format($property['property_price'], 2) }} Million</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No {{ $type }} properties added yet.</p>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">No properties added yet.</p>
                @endforelse
            </div>
        @else
            <p class="text-red-600 text-center">User data not available. Please contact support.</p>
        @endif
    </div>