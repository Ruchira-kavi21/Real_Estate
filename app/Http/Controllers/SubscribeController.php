<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscribeController extends Controller
{
    //
    public function store(Request $request)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to subscribe to the newsletter.'], 401);
        }

        // Validate the request
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $email = $request->input('email');

        // Check if the email matches the logged-in user's email
        $user = Auth::user();
        if ($user->email !== $email) {
            return response()->json(['error' => 'The email must match your registered email address.'], 422);
        }

        // Handle the $10 confirmation
        $confirmed = $request->input('confirmed', 'no');
        if ($confirmed !== 'yes') {
            return response()->json(['message' => 'Your subscription to our newsletter costs $10. Do you wish to proceed?', 'email' => $email], 200);
        }

        // Proceed with subscription
        $subscriber = Subscriber::create([
            'email' => $email,
            'subscribed_at' => now(),
        ]);

        if ($subscriber) {
            return response()->json(['success' => 'Thank you for subscribing to our newsletter!'], 200);
        } else {
            return response()->json(['error' => 'Error saving your subscription. Please try again.'], 500);
        }
    }
}
