<?php

use function Livewire\Volt\{state, rules, uses};
use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

uses([
    WithFileUploads::class,
]);

state([
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
]);

rules([
    'property_name' => 'required|min:3|max:255',
    'property_price' => 'required|numeric|min:0',
    'offer_type' => 'required|in:sale,rent',
    'property_address' => 'required|min:10',
    'phone_number' => 'required|regex:/^[0-9]{10}$/',
    'property_status' => 'required|in:pending',
    'property_type' => 'required|in:apartment,house,land',
    'finish_status' => 'required|in:finished,unfinished',
    'property_description' => 'required|min:10',
    'image_1' => 'nullable|image|max:2048',
    'image_2' => 'nullable|image|max:2048',
]);

$submit = function () {
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

<div>
    @if ($success)
        <p class="text-green-600 text-center">Property added successfully!</p>
    @else
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10 mb-10">
            <h1 class="text-2xl font-bold mb-6 text-center">Add New Property</h1>
            <form wire:submit="submit" class="space-y-4">
                @csrf
                <div>
                    <label for="property_name" class="block font-medium text-gray-700">Property Name</label>
                    <input type="text" wire:model="property_name" id="property_name" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4" placeholder="Enter the property name">
                    @error('property_name') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="property_price" class="block font-medium text-gray-700">Property Price</label>
                    <input type="number" wire:model="property_price" id="property_price" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4" placeholder="Enter price in millions">
                    @error('property_price') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="offer_type" class="block font-medium text-gray-700">Offer Type</label>
                    <select wire:model="offer_type" id="offer_type" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4">
                        <option value="sale">For Sale</option>
                        <option value="rent">For Rent</option>
                    </select>
                    @error('offer_type') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="property_address" class="block font-medium text-gray-700">Property Address</label>
                    <textarea wire:model="property_address" id="property_address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow text-base px-4 py-2" placeholder="Enter the property address"></textarea>
                    @error('property_address') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="phone_number" class="block font-medium text-gray-700">Phone Number</label>
                    <input type="tel" wire:model="phone_number" id="phone_number" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4" placeholder="Enter 10-digit phone number">
                    @error('phone_number') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="property_status" class="block font-medium text-gray-700">Property Status</label>
                    <select wire:model="property_status" id="property_status" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4">
                        <option value="pending">Pending</option>
                    </select>
                    @error('property_status') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="property_type" class="block font-medium text-gray-700">Property Type</label>
                    <select wire:model="property_type" id="property_type" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4">
                        <option value="apartment">Apartment</option>
                        <option value="house">House</option>
                        <option value="land">Land</option>
                    </select>
                    @error('property_type') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="finish_status" class="block font-medium text-gray-700">Finish Status</label>
                    <select wire:model="finish_status" id="finish_status" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow text-base px-4">
                        <option value="finished">Finished</option>
                        <option value="unfinished">Unfinished</option>
                    </select>
                    @error('finish_status') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="property_description" class="block font-medium text-gray-700">Property Description</label>
                    <textarea wire:model="property_description" id="property_description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow text-base px-4 py-2" placeholder="Enter a brief description"></textarea>
                    @error('property_description') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Upload Images</label>
                    <div class="flex space-x-4 mt-1">
                        <input type="file" wire:model="image_1" class="block w-full h-10 text-sm text-gray-500 border-gray-300 rounded-md shadow" accept="image/*">
                        @error('image_1') <span class="text-red-600">{{ $message }}</span> @enderror
                        <input type="file" wire:model="image_2" class="block w-full h-10 text-sm text-gray-500 border-gray-300 rounded-md shadow" accept="image/*">
                        @error('image_2') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full h-10 bg-teal-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-teal-700">Post Property</button>
                </div>
            </form>
        </div>
    @endif
</div>