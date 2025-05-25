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
        // Total counts
        $totalProperties = Property::count();
        $totalSellers = User::where('role', 'seller')->count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalSales = Property::where('property_status', 'approved')
            ->where('offer_type', 'sale')
            ->sum('property_price');
        $totalRentals = Property::where('property_status', 'approved')
            ->where('offer_type', 'rent')
            ->sum('property_price');

        // Fetch data for display
        $sellers = User::where('role', 'seller')->get();
        $customers = User::where('role', 'customer')->get();
        $properties = Property::with('user')
            ->where('property_status', 'approved')
            ->get();
        $pendingProperties = Property::with('user')
            ->where('property_status', 'pending')
            ->get();

        // Date range filter
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $properties = Property::whereBetween('created_at', [$startDate, $endDate])
                ->with('user')
                ->get();
            $totalSales = Property::where('property_status', 'approved')
                ->where('offer_type', 'sale')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('property_price');
            $totalRentals = Property::where('property_status', 'approved')
                ->where('offer_type', 'rent')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('property_price');
        }

        return view('Admin.dashboard', compact(
            'totalProperties',
            'totalSellers',
            'totalCustomers',
            'totalSales',
            'totalRentals',
            'sellers',
            'customers',
            'properties',
            'pendingProperties',
            'startDate',
            'endDate'
        ));
    }

    public function exportPropertyReport(Request $request)
    {
        $approvedPropertiesQuery = Property::where('property_status', 'approved');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $approvedPropertiesQuery->whereBetween('updated_at', [$startDate, $endDate]);
        }

        $approvedProperties = $approvedPropertiesQuery->with('user')->get();

        $csvData = [];
        $csvData[] = [
            'Property Name',
            'Description',
            'Price',
            'Offer Type',
            'Property Type',
            'Seller Email',
            'Approved At'
        ];

        foreach ($approvedProperties as $property) {
            $csvData[] = [
                $property->property_name,
                $property->property_description,
                number_format($property->property_price, 2),
                $property->offer_type,
                $property->property_type,
                $property->user ? $property->user->email : 'N/A',
                $property->updated_at,
            ];
        }

        $filename = 'property_report_' . now()->format('Ymd_His') . '.csv';
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
        exit;
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

    public function createAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $admin = new User();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->role = 'admin';
        $admin->save();

        return redirect()->route('admin')->with('success', 'Admin created successfully.');
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

        // Prevent deleting the last admin
        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('admin')->with('error', 'Cannot delete the last admin user.');
        }

        $user->delete();

        return redirect()->route('admin')->with('success', 'User deleted successfully.');
    }
    public function showUsers()
    {
        $sellers = User::where('role', 'seller')->get();
        $users = User::whereIn('role', ['admin', 'seller'])->get();
        return view('admin.users', compact('sellers', 'users'));
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

    public function addProperty(Request $request)
{
    $request->validate([
        'property_name' => 'required|string|max:255',
        'property_price' => 'required|numeric|min:0',
        'offer_type' => 'required|in:sale,rent',
        'property_type' => 'required|in:apartment,house,land',
        'finish_status' => 'required|in:finished,unfinished',
        'property_address' => 'required|string',
        'property_description' => 'required|string',
        'phone_number' => 'required|string|max:20',
        'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $property = new Property();
    $property->user_id = auth()->check() ? auth()->id() : 1; // Fallback to a default user_id if not authenticated
    $property->property_name = $request->input('property_name');
    $property->property_price = $request->input('property_price');
    $property->offer_type = $request->input('offer_type');
    $property->property_type = $request->input('property_type');
    $property->finish_status = $request->input('finish_status');
    $property->property_address = $request->input('property_address');
    $property->property_description = $request->input('property_description');
    $property->phone_number = $request->input('phone_number');
    $property->property_status = 'pending';

    if ($request->hasFile('image_1')) {
        $property->image_1 = $request->file('image_1')->store('properties', 'public');
    }
    if ($request->hasFile('image_2')) {
        $property->image_2 = $request->file('image_2')->store('properties', 'public');
    }

    $property->save();

    return redirect()->route('admin.add-property')->with('success', 'Property submitted successfully.');
}

    public function editPropertyView(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $request->validate([
            'property_name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'property_price' => 'required|numeric|min:0',
            'offer_type' => 'required|in:sale,rent',
            'property_type' => 'required|in:apartment,house,land',
            'finish_status' => 'required|in:finished,unfinished',
            'property_address' => 'required|string',
            'property_description' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $property->user_id = $request->input('user_id');
        $property->property_name = $request->input('property_name');
        $property->property_price = $request->input('property_price');
        $property->offer_type = $request->input('offer_type');
        $property->property_type = $request->input('property_type');
        $property->finish_status = $request->input('finish_status');
        $property->property_address = $request->input('property_address');
        $property->property_description = $request->input('property_description');
        $property->phone_number = $request->input('phone_number');

        if ($request->hasFile('image_1')) {
            if ($property->image_1) {
                Storage::disk('public')->delete($property->image_1);
            }
            $property->image_1 = $request->file('image_1')->store('properties', 'public');
        }
        if ($request->hasFile('image_2')) {
            if ($property->image_2) {
                Storage::disk('public')->delete($property->image_2);
            }
            $property->image_2 = $request->file('image_2')->store('properties', 'public');
        }

        $property->save();

        return redirect()->route('admin')->with('success', 'Property updated successfully.');
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