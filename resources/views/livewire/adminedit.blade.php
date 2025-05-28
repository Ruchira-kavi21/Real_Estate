<?php

use function Livewire\Volt\{state, rules, uses};
use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

uses([
    WithFileUploads::class,
]);

state([
    'property' => fn() => Property::findOrFail(request()->route('id')),
    'property_name' => fn() => $this->property->property_name,
    'user_id' => fn() => $this->property->user_id,
    'property_price' => fn() => $this->property->property_price,
    'offer_type' => fn() => $this->property->offer_type,
    'property_address' => fn() => $this->property->property_address,
    'phone_number' => fn() => $this->property->phone_number,
    'property_status' => fn() => $this->property->property_status,
    'property_type' => fn() => $this->property->property_type,
    'finish_status' => fn() => $this->property->finish_status,
    'property_description' => fn() => $this->property->property_description,
    'image_1' => null,
    'image_2' => null,
    'success' => false,
]);

rules([
    'property_name' => 'required|string|max:255',
    'user_id' => 'required|exists:users,id',
    'property_price' => 'required|numeric|min:0',
    'offer_type' => 'required|in:sale,rent',
    'property_address' => 'required|string|min:10',
    'phone_number' => 'required|regex:/^[0-9]{10}$/',
    'property_status' => 'required|in:pending,approved,declined',
    'property_type' => 'required|in:apartment,house,land',
    'finish_status' => 'required|in:finished,unfinished',
    'property_description' => 'required|string|min:10',
    'image_1' => 'nullable|image|max:2048',
    'image_2' => 'nullable|image|max:2048',
]);

$update = function () {
    $validated = $this->validate();

    $property = $this->property;

    $property->user_id = $this->user_id;
    $property->property_name = $this->property_name;
    $property->property_price = $this->property_price;
    $property->offer_type = $this->offer_type;
    $property->property_address = $this->property_address;
    $property->phone_number = $this->phone_number;
    $property->property_status = $this->property_status;
    $property->property_type = $this->property_type;
    $property->finish_status = $this->finish_status;
    $property->property_description = $this->property_description;

    if ($this->image_1) {
        if ($property->image_1) {
            Storage::disk('public')->delete($property->image_1);
        }
        $property->image_1 = $this->image_1->store('properties', 'public');
    }
    if ($this->image_2) {
        if ($property->image_2) {
            Storage::disk('public')->delete($property->image_2);
        }
        $property->image_2 = $this->image_2->store('properties', 'public');
    }

    $property->save();

    $this->success = true;
    return redirect()->route('admin.list')->with('success', 'Property updated successfully.');
};

?>

<div class="container mx-auto py-8">
    @if ($success)
        <p class="text-green-600 text-center">Property updated successfully!</p>
    @endif
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Property</h1>
    <form wire:submit="update" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-2 gap-4">
        @csrf
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="property_name">Property Name</label>
            <input type="text" wire:model="property_name" id="property_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('property_name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">User ID</label>
            <input type="text" wire:model="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('user_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="property_price">Price</label>
            <input type="number" wire:model="property_price" id="property_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('property_price') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="offer_type">Offer Type</label>
            <select wire:model="offer_type" id="offer_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="rent">Rent</option>
                <option value="sale">Sale</option>
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
            <label class="block text-gray-700 text-sm font-bold mb-2" for="property_status">Status</label>
            <select wire:model="property_status" id="property_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="declined">Declined</option>
            </select>
            @error('property_status') <span class="text-red-600">{{ $message }}</span> @enderror
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
        <div class="col-span-2 flex items-center justify-between">
            <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600">Save Changes</button>
            <a href="{{ route('admin.list') }}" class="text-gray-500 hover:text-gray-800">Cancel</a>
        </div>
    </form>
</div>