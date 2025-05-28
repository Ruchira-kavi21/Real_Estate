<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalProperties = Property::count();
        $totalSellers = User::where('role', 'seller')->count();
        $totalCustomers = User::where('role', 'customer')->count();


        $sellers = User::where('role', 'seller')->get();
        $customers = User::where('role', 'customer')->get();
        $properties = Property::with('user')
            ->where('property_status', 'approved')
            ->get();
        $pendingProperties = Property::with('user')
            ->where('property_status', 'pending')
            ->get();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $properties = Property::whereBetween('created_at', [$startDate, $endDate])
                ->with('user')
                ->get();
        }

        return view('Admin.dashboard', compact(
            'totalProperties',
            'totalSellers',
            'totalCustomers',
            'sellers',
            'customers',
            'properties',
            'pendingProperties',
            'startDate',
            'endDate'
        ));
    }

    public function approveProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->property_status = 'approved';
        $property->save();

        return redirect()->route('admin')->with('success', 'Property approved successfully.');
    }

    public function declineProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->property_status = 'declined';
        $property->save();

        return redirect()->route('admin')->with('success', 'Property declined successfully.');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,seller,customer', 
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role'); 
        $user->save();

        return redirect()->route('admin')->with('success', 'User created successfully.');
    }

    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,seller,customer',
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect()->route('admin')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('admin')->with('error', 'Cannot delete the last admin user.');
        }

        $user->delete();

        return redirect()->route('admin')->with('success', 'User deleted successfully.');
    }

    public function showUsers()
    {
        // $sellers = User::where('role', 'seller')->get();
        // $users = User::whereIn('role', ['admin', 'seller'])->get();
        // return view('admin.users', compact('sellers', 'users'));
        $admins = User::where('role', 'admin')->get();
        $sellers = User::where('role', 'seller')->get();
        $customers = User::where('role', 'customer')->get();
        return view('admin.users', compact('admins', 'sellers', 'customers'));
    }

    public function showAddPropertyForm()
    {
        return view('admin.add-property');
    }

    public function listProperties()
    {
        $properties = Property::all();
        return view('admin.list', compact('properties'));
    }

    public function viewProperty($id)
    {
        $property = Property::findOrFail($id);
        return view('view', compact('property'));
    }

    public function editPropertyView($id)
    {
        $property = Property::findOrFail($id);
        return view('admin.edit', compact('property'));
    }

    public function editProperty(Request $request, $id)
    {
        return view('admin.edit', ['propertyId' => $id]);
    }

    public function deleteProperty($id)
    {
        $property = Property::findOrFail($id);

        if ($property->image_1) {
            Storage::disk('public')->delete($property->image_1);
        }
        if ($property->image_2) {
            Storage::disk('public')->delete($property->image_2);
        }

        $property->delete();

        return redirect()->route('admin')->with('success', 'Property deleted successfully.');
    }
}