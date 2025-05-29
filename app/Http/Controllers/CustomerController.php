<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\User;

class CustomerController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $properties = Property::where('user_id', $user->id)->get();
        return view('profile', compact('user', 'properties'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'current_password' => 'nullable|required_with:password,password_confirmation',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = $request->only(['name', 'email', 'phone']);
        $user->update($data);

        // Handle password change
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            $user->update(['password' => Hash::make($request->password)]);
            return redirect()->route('customer.profile')->with('success', 'Profile and password updated successfully!');
        }

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully!');
    }
}