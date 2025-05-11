<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $properties = auth()->user()->properties;
        return view('profile', compact('properties'));
    }
}
