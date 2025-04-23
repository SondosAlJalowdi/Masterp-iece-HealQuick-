<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserPagesController extends Controller
{


    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(auth()->id()); // More robust than auth()->user()

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Store the new image
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    function userProfile()
    {
        $user = Auth::user();
        $appointments = Booking::with(['service', 'organization'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();
        return view('user.profile', compact('appointments'));
    }
    function showLanding()
    {
        $services = Service::all();
        return view('user.landing')->with('services', $services);
    }
    function showAbout()
    {
        return view('user.about');
    }

    function showBookingForm()
    {
        return view('user.bookingForm');
    }

}
