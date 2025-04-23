<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Service;
use App\Models\Review;

class ReviewAdminController extends Controller
{


    public function index()
    {
        $reviews = Review::with(['user', 'service'])
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->latest()
            ->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }



public function destroy(Review $review)
{
    $review->delete();

    return redirect()->back()->with('success', 'Review deleted successfully.');
}

}
