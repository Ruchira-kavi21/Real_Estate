<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();
        
        // Filter by offer_type if provided (e.g., ?offer_type=land or ?offer_type=rent)
        if ($request->has('offer_type')) {
            $query->where('offer_type', $request->offer_type);
        }

        // Only return approved properties
        $query->where('property_status', 'approved');
        
        $properties = $query->get();
        return response()->json(['data' => $properties], 200);
    }
    public function home()
    {
        $lands = Property::where('property_type', 'land')
            ->where('property_status', 'approved')
            ->get();

        $houses = Property::where('property_type', 'house')
            ->where('property_status', 'approved')
            ->get();

        return view('home', compact('lands', 'houses'));
    }

    public function land()
    {
        $properties = Property::where('offer_type', 'sale')
            ->where('property_status', 'approved')
            ->get();
        return view('land', compact('properties'));
    }

    public function rent()
    {
        $properties = Property::where('offer_type', 'rent')
            ->where('property_status', 'approved')
            ->get();
        return view('rent', compact('properties'));
    }

    public function showSellForm()
    {
        return view('seller.sell');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_name' => 'required|string|max:255',
            'property_price' => 'required|numeric',
            'offer_type' => 'required|in:sale,rent',
            'property_address' => 'required|string',
            'property_type' => 'required|in:apartment,house,land',
            'finish_status' => 'required|in:finished,unfinished',
            'property_description' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'image_1' => 'nullable|image|max:2048',
            'image_2' => 'nullable|image|max:2048',
        ]);

        $property = new Property();
        $property->user_id = auth()->id();
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

        return redirect()->route('sell')->with('success', 'Property submitted for approval.');
    }
    public function viewProperty($id)
    {
        $property = Property::findOrFail($id);
        return view('view', compact('property'));
    }
}