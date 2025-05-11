<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class HomeController extends Controller
{
    public function index()
    {
        $lands = Property::where('property_type', 'land')
            ->where('property_status', 'approved')
            ->take(3)
            ->get();
        $houses = Property::where('property_type', 'house')
            ->where('property_status', 'approved')
            ->take(3)
            ->get();

        return view('home', compact('lands', 'houses'));
    }
    public function about()
    {
        return view('about');
    }
}
