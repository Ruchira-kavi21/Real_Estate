<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check() || Auth::user()->role !== 'seller') {
            return redirect()->route('login')->with('error', 'You must be a seller to access this page.');
        }

        $user = Auth::user();
        $properties = Property::where('user_id', $user->id)
            ->get()
            ->groupBy('property_type')
            ->map(function ($group) {
                return $group->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'property_name' => $item->property_name,
                        'property_address' => $item->property_address,
                        'property_price' => $item->property_price,
                        'image_1' => $item->image_1,
                    ];
                })->toArray();
            })
            ->toArray();

        return view('seller.dashboard', compact('user', 'properties'));
    }

    public function storeProperty(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'seller') {
            return redirect()->route('login')->with('error', 'You must be a seller to add a property.');
        }

        $request->validate([
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

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image_1')) {
            $data['image_1'] = $request->file('image_1')->store('properties', 'public');
        }
        if ($request->hasFile('image_2')) {
            $data['image_2'] = $request->file('image_2')->store('properties', 'public');
        }

        Property::create($data);

        return redirect()->route('seller.dashboard')->with('success', 'Property added successfully!');
    }
}