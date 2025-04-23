<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

public function showprofile()
{
    return view('admin.profile');
}
public function updateAdminProfile(Request $request)
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
public function dashboard()
{
    $organizationCount = Organization::count();
    $bookingCount = Booking::count();
    $reviewCount = Review::count();
    $contactCount = Contact::count();

    $latestBookings = Booking::latest()
        ->with(['user', 'organization', 'service'])
        ->take(5)
        ->get();

    return view('admin.dashboard', compact(
        'organizationCount',
        'bookingCount',
        'reviewCount',
        'contactCount',
        'latestBookings'
    ));
}

    function showAdmin()
    {
        return view('admin.dashboard');
    }
}
