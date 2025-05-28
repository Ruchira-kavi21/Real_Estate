@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
<section class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="text-3xl font-bold text-center mb-6">Admin Dashboard</div>

        <div class="grid grid-cols-2 gap-8">
            <!-- Admins Table -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Admins</h2>
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 text-left">Name</th>
                            <th class="py-2 px-4 text-left">Email</th>
                            <th class="py-2 px-4 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($admins->isEmpty())
                            <tr>
                                <td colspan="3" class="py-2 px-4 text-center">No admins found.</td>
                            </tr>
                        @else
                            @foreach ($admins as $admin)
                                <tr>
                                    <td class="py-2 px-4">{{ $admin->name }}</td>
                                    <td class="py-2 px-4">{{ $admin->email }}</td>
                                    <td class="py-2 px-4">
                                        <form method="GET" action="{{ route('admin.edit-user', $admin->id) }}">
                                            @csrf
                                            <button type="submit" class="text-teal-500 hover:underline">Edit</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.delete-user', $admin->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Sellers Table -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Sellers</h2>
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 text-left">Name</th>
                            <th class="py-2 px-4 text-left">Email</th>
                            <th class="py-2 px-4 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sellers->isEmpty())
                            <tr>
                                <td colspan="3" class="py-2 px-4 text-center">No sellers found.</td>
                            </tr>
                        @else
                            @foreach ($sellers as $seller)
                                <tr>
                                    <td class="py-2 px-4">{{ $seller->name }}</td>
                                    <td class="py-2 px-4">{{ $seller->email }}</td>
                                    <td class="py-2 px-4">
                                        <form method="GET" action="{{ route('admin.edit-user', $seller->id) }}">
                                            @csrf
                                            <button type="submit" class="text-teal-500 hover:underline">Edit</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.delete-user', $seller->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Customers Table -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Customers</h2>
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 text-left">Name</th>
                            <th class="py-2 px-4 text-left">Email</th>
                            <th class="py-2 px-4 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($customers->isEmpty())
                            <tr>
                                <td colspan="3" class="py-2 px-4 text-center">No customers found.</td>
                            </tr>
                        @else
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="py-2 px-4">{{ $customer->name }}</td>
                                    <td class="py-2 px-4">{{ $customer->email }}</td>
                                    <td class="py-2 px-4">
                                        <form method="GET" action="{{ route('admin.edit-user', $customer->id) }}">
                                            @csrf
                                            <button type="submit" class="text-teal-500 hover:underline">Edit</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.delete-user', $customer->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add New User Form -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Add New User</h2>
            <form action="{{ route('admin.create') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                    <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                    <input type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                    <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
                    <select name="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="admin">Admin</option>
                        <option value="seller">Seller</option>
                        <option value="customer">Customer</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600 col-span-2">Add User</button>
            </form>
        </div>
    </div>
</section>
@endsection