<div class="container mx-auto py-8">
    @if (session('success'))
        <p class="text-green-600 text-center mb-4">{{ session('success') }}</p>
    @endif

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Seller Dashboard</h1>

    <!-- Seller Details -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Seller Details</h2>
        <p><strong>Name:</strong> {{ $name ?? 'Not provided' }}</p>
        <p><strong>Email:</strong> {{ $email ?? 'Not provided' }}</p>
        <p><strong>Phone:</strong> {{ $phone ?? 'Not provided' }}</p>
    </div>
    <!-- Profile Management -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Manage Profile</h2>
        <form wire:submit.prevent="updateProfile">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                <input type="text" wire:model="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('name')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" wire:model="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('email')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone</label>
                <input type="text" wire:model="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('phone')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
                <input type="text" id="role" value="{{ $role }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100" readonly>
            </div>
            <div class="mt-6">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Change Password</h3>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="current_password">Current Password</label>
                    <input type="password" wire:model="current_password" id="current_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('current_password')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">New Password</label>
                    <input type="password" wire:model="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Confirm New Password</label>
                    <input type="password" wire:model="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('password_confirmation')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600">Update Profile</button>
        </form>
    </div>
    <!-- Sell Form -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Add New Property</h2>
        <form wire:submit.prevent="storeProperty" class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_name">Property Name</label>
                <input type="text" wire:model="property_name" id="property_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('property_name')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_price">Price</label>
                <input type="number" wire:model="property_price" id="property_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" step="0.01">
                @error('property_price')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="offer_type">Offer Type</label>
                <select wire:model="offer_type" id="offer_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="sale">Sale</option>
                    <option value="rent">Rent</option>
                </select>
                @error('offer_type')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_address">Address</label>
                <input type="text" wire:model="property_address" id="property_address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('property_address')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">Phone Number</label>
                <input type="text" wire:model="phone_number" id="phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('phone_number')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_type">Property Type</label>
                <select wire:model="property_type" id="property_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="apartment">Apartment</option>
                    <option value="house">House</option>
                    <option value="land">Land</option>
                </select>
                @error('property_type')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="finish_status">Finish Status</label>
                <select wire:model="finish_status" id="finish_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="finished">Finished</option>
                    <option value="unfinished">Unfinished</option>
                </select>
                @error('finish_status')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="property_description">Description</label>
                <textarea wire:model="property_description" id="property_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                @error('property_description')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Upload Images</label>
                <div class="flex space-x-4">
                    <input type="file" wire:model="image_1" class="block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow" accept="image/*">
                    @error('image_1')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                    <input type="file" wire:model="image_2" class="block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow" accept="image/*">
                    @error('image_2')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
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
</div>