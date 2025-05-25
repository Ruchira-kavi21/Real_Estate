<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;700&display=swap');
        body {
            font-family: 'Maven Pro', sans-serif;
            background-color: #f7fafc;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="nav-bar-section bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('Images/logo.png') }}" alt="Haven Homes Logo" class="w-20 h-15 mr-2">
                <span class="text-2xl font-bold text-teal-600">Haven Homes</span>
            </a>
            <nav class="flex space-x-6">
                <a href="{{ route('admin') }}" class="text-lg text-gray-700 hover:text-teal-600">Admin Dashboard</a>
                <a href="{{ route('admin.add-property') }}" class="text-lg text-gray-700 hover:text-teal-600">Add</a>
                <a href="{{ route('admin.users') }}" class="text-lg text-gray-700 hover:text-teal-600">Users</a>
                <a href="{{ route('admin.list') }}" class="text-lg text-gray-700 hover:text-teal-600">List</a>
            </nav>
            <a href="{{ route('login') }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700">Log In</a>
        </div>
    </header>

    <section class="bg-gray-100">
        <div class="container mx-auto p-8">
            <div class="text-3xl font-bold text-center mb-6">Admin Dashboard</div>

            <div class="grid grid-cols-2 gap-8">
                <!-- Users Table (Sellers) -->
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
                            @foreach ($sellers as $seller)
                                <tr>
                                    <td class="py-2 px-4">{{ $seller->name }}</td>
                                    <td class="py-2 px-4">{{ $seller->email }}</td>
                                    <td class="py-2 px-4">
                                        <form method="POST" action="{{ route('admin.edit-user', $seller->id) }}">
                                            @csrf
                                            <button type="submit" class="text-teal-500 hover:underline">Edit</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.delete-user', $seller->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Admins Table (Placeholder - Use $admins if separate table) -->
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
                            @foreach ($users->where('role', 'admin') as $admin)
                                <tr>
                                    <td class="py-2 px-4">{{ $admin->name }}</td>
                                    <td class="py-2 px-4">{{ $admin->email }}</td>
                                    <td class="py-2 px-4">
                                        <form method="POST" action="{{ route('admin.edit-user', $admin->id) }}">
                                            @csrf
                                            <button type="submit" class="text-teal-500 hover:underline">Edit</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.delete-user', $admin->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add New User Form (Sellers and Customers) -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Add New User</h2>
                <form action="{{ route('admin.create') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                        <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                        <input type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                        <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
                        <select name="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="seller">Seller</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600 col-span-2">Add User</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>