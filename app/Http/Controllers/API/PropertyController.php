<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
       $query = Property::query();
    if ($request->has('property_type')) {
        $query->where('property_type', $request->property_type);
    }
    $properties = $query->get();
    return response()->json(['data' => $properties], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_name' => 'required|string|max:255',
            'property_price' => 'required|numeric',
            'property_address' => 'required|string',
            // Add other fields as needed
        ]);

        $property = Property::create($request->all());
        return response()->json(['data' => $property], 201);
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return response()->json(['data' => $property], 200);
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->update($request->all());
        return response()->json(['data' => $property], 200);
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        return response()->json(['message' => 'Property deleted'], 200);
    }

    // Existing web route methods (e.g., home, land, rent, etc.) remain unchanged
    public function home()
    {
        return view('home');
    }

    public function land()
    {
        return view('land');
    }

    public function rent()
    {
        return view('rent');
    }

    // ... other methods
}