<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    //
    public function land()
    {
        $lands = Property::where('property_type', 'land')
            ->where('property_status', 'approved')
            ->get();
        return view('land', compact('lands'));
    }

    public function rent()
    {
        $properties = Property::where('offer_type', 'rent')
            ->where('property_status', 'approved')
            ->get();
        return view('rent', compact('properties'));
    }

    public function sell()
    {
        $properties = Property::where('offer_type', 'sale')
            ->where('property_status', 'approved')
            ->get();
        return view('sell', compact('properties'));
    }

    public function create()
    {
        return view('sell.create');
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

        $property = new Property($validated);
        $property->user_id = auth()->id();
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
}
