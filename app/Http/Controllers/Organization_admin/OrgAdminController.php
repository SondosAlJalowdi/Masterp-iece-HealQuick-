<?php

namespace App\Http\Controllers\Organization_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use App\Models\Service;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;


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

    public function bookings()
{
    $organizationId = auth()->user()->organization->id;
    $bookings = Booking::with(['user', 'service', 'employee'])
    ->where('organization_id', $organizationId)
    ->whereHas('user')
    ->whereHas('service')
    ->whereHas('employee')
    ->latest()
    ->get();

    return view('organization_admin.bookings.index', compact('bookings'));
}

public function reviews()
{
    $organizationId = auth()->user()->organization->id;
    $reviews = Review::where('organization_id', $organizationId)->with(['user', 'service'])->latest()->get();

    return view('organization_admin.reviews.index', compact('reviews'));
}

public function employees()
{
    $organizationId = auth()->user()->organization->id;
    $employees = Employee::where('organization_id', $organizationId)->latest()->get();

    return view('organization_admin.employees.index', compact('employees'));
}

public function services()
{
    $organizationId = auth()->user()->organization->id;

    $services = DB::table('organization_service')
        ->where('organization_service.organization_id', $organizationId)
        ->join('services', 'organization_service.service_id', '=', 'services.id')
        ->join('employees', 'organization_service.employee_id', '=', 'employees.id')
        ->select(
            'services.name as service_name',
            'employees.name as employee_name',
            'organization_service.price'
        )
        ->get();

    return view('organization_admin.services.index', compact('services'));
}




}
