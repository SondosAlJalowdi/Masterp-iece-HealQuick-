<?php

namespace App\Http\Controllers\Organization_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class OrgBookingController extends Controller
{
    public function index(Request $request)
    {
        $organizationId = auth()->user()->organization->id;

        $query = Booking::query()
            ->with(['user', 'service', 'employee'])
            ->where('organization_id', $organizationId);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%");
                })->orWhereHas('service', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%");
                })->orWhereHas('employee', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%");
                });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $bookings = $query->latest()->paginate(4);

        return view('organization_admin.bookings.index', compact('bookings'));
    }


    public function show($id)
    {
        $organizationId = auth()->user()->organization->id;
        $booking = Booking::with(['user', 'service', 'employee', 'organization'])
            ->where('organization_id', $organizationId)
            ->findOrFail($id);

        $availableEmployees = \App\Models\Employee::where('organization_id', $organizationId)->get();

        return view('organization_admin.bookings.show', compact('booking', 'availableEmployees'));
    }


    public function updateStatus(Request $request, $id, $status)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $status;
        $booking->save();

        return redirect()->route('organization_admin.bookings.show', $id)->with('success', 'Booking status updated.');
    }

    public function assignEmployee(Request $request, $id)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
    ]);

    $booking = Booking::where('organization_id', auth()->user()->organization->id)
        ->findOrFail($id);

    $booking->employee_id = $request->input('employee_id');
    $booking->save();

    return redirect()->route('organization_admin.bookings.show', $id)
        ->with('success', 'Employee assigned successfully.');
}

}
