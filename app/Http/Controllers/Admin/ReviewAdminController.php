<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Service;
use App\Models\Review;

class ReviewAdminController extends Controller
{


    public function index(Request $request)
    {
        $query = Review::with(['user', 'service']);

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        $reviews = $query->latest()->paginate(6)->appends($request->query());

        $services = Service::all(); // Pass to Blade for dropdown

        return view('admin.reviews.index', compact('reviews', 'services'));
    }



public function destroy(Review $review)
{
    $review->delete();

    return redirect()->back()->with('success', 'Review deleted successfully.');
}

}
