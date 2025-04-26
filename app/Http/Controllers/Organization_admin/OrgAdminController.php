<?php

namespace App\Http\Controllers\Organization_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class OrgAdminController extends Controller
{
    public function orgDashboard()
    {
        $user = auth()->user();

        $organization = $user->organization;

        if (!$organization) {
            abort(403, 'No organization found for this user.');
        }

        $organizationId = $organization->id;

        $bookingCount = Booking::where('organization_id', $organizationId)->count();
        $reviewCount = Review::where('organization_id', $organizationId)->count();

        $latestBookings = Booking::where('organization_id', $organizationId)
            ->latest()
            ->with(['user', 'organization', 'service'])
            ->take(5)
            ->get();

        return view('organization_admin.dashboard', compact(
            'bookingCount',
            'reviewCount',
            'latestBookings'
        ));
    }

public function reviews()
{
    $organizationId = auth()->user()->organization->id;
    $reviews = Review::where('organization_id', $organizationId)->with(['user', 'service'])->latest()->get();

    return view('organization_admin.reviews.index', compact('reviews'));
}

public function showProfile()
{
    return view('organization_admin.orgProfile');
}

public function updateProfile(Request $request)
{
    $user = User::findOrFail(auth()->id());

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'short_description' => 'nullable|string|max:500',
        'long_description' => 'nullable|string|max:500',
    ]);

    if ($request->hasFile('image')) {
        // Delete old user image
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        // Store new image
        $path = $request->file('image')->store('images', 'public');
        $validated['image'] = $path;

        // Also update organization's logo
        if ($user->organization) {
            // Delete old organization logo if exists
            if ($user->organization->logo && Storage::disk('public')->exists($user->organization->logo)) {
                Storage::disk('public')->delete($user->organization->logo);
            }

            // Update new logo path
            $user->organization->logo = $path;
            $user->organization->save(); // Save the updated organization logo
        }
    }

    // Update user's other profile information, including descriptions
    $user->update($validated);
    if ($user->organization) {
        $user->organization->short_description = $request->short_description;
        $user->organization->long_description = $request->long_description;
        $user->organization->save(); // <<<<<<<< Important
    }

    return redirect()->back()->with('success', 'Profile updated successfully.');
}











}
