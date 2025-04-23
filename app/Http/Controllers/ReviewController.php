<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Service;
use App\Models\Organization;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'organization_id' => 'required|exists:organizations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $hasBooked = Booking::where('user_id', auth()->id())
            ->where('service_id', $request->service_id)
            ->where('organization_id', $request->organization_id)
            ->exists();

        if (!$hasBooked) {
            return back()->withErrors(['You can only review services you have booked.']);
        }

        Review::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'organization_id' => $request->organization_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
    public function show($serviceId, $organizationId)
    {
        $service = Service::findOrFail($serviceId);
        $organization = Organization::findOrFail($organizationId);

        $reviews = Review::where('service_id', $serviceId)
            ->where('organization_id', $organizationId)
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->with('user')
            ->latest()
            ->get();

        $averageRating = Review::where('service_id', $serviceId)
            ->where('organization_id', $organizationId)
            ->avg('rating');

        $reviewCount = Review::where('service_id', $serviceId)
            ->where('organization_id', $organizationId)
            ->count();

        // Get the price from the pivot table
        $price = DB::table('organization_service')
            ->where('organization_id', $organizationId)
            ->where('service_id', $serviceId)
            ->value('price');

        // Get the review being edited, if any
        $editingReview = null;
        if (request()->has('edit_review_id')) {
            $editingReview = Review::where('id', request('edit_review_id'))
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('user.reviews', compact(
            'service',
            'organization',
            'reviews',
            'editingReview',
            'averageRating',
            'reviewCount',
            'price'
        ));
    }

public function update(Request $request, Review $review)
{
    if (auth()->id() !== $review->user_id) {
        abort(403);
    }

    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
    ]);

    $review->update($validated);

    return redirect()->back()->with('success', 'Review updated successfully.');
}

public function destroy(Review $review)
{
    if (auth()->id() !== $review->user_id) {
        abort(403);
    }

    $review->delete();

    return redirect()->back()->with('success', 'Review deleted successfully.');
}


}
