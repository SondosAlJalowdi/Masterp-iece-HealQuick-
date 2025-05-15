<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Employee;

class BookingAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'service', 'organization', 'employee']);

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('organization_id')) {
            $query->where('organization_id', $request->organization_id);
        }

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }


        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->date);
        }
        $bookings = $query->paginate(3)->appends($request->query());

        $users = User::all();
        $services = Service::all();
        $organizations = Organization::all();

        return view('admin.bookings.index', compact('bookings', 'users', 'services', 'organizations'));
    }


    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    // public function create()
    // {
    //     $users = User::all();
    //     $services = Service::all();
    //     $organizations = Organization::all();
    //     $employees = Employee::all();
    //     return view('admin.bookings.create', compact('users', 'services', 'organizations', 'employees'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required',
    //         'service_id' => 'required',
    //         'organization_id' => 'required',
    //         'employee_id' => 'required',
    //         'booking_date' => 'required|date',
    //         'booking_time' => 'nullable|date_format:H:i',
    //         'price' => 'required|numeric|min:0',
    //         'status' => 'required|in:booked,completed,canceled',
    //     ]);

    //     Booking::create($request->all());

    //     return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    // }

    public function edit(Booking $booking)
    {
        $users = User::all();
        $services = Service::all();
        $organizations = Organization::all();
        $employees = Employee::all();

        return view('admin.bookings.edit', compact('booking', 'users', 'services', 'organizations', 'employees'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'booking_time' => 'nullable|date_format:H:i',
            'status' => 'required|in:booked,completed,canceled',
        ]);


        $booking->update([
            'booking_time' => $request->booking_time,
            'status' => $request->status,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }



    public function updateStatus(Request $request, $id, $status)
    {
        $booking = Booking::withTrashed()->findOrFail($id); // support soft-deleted records

        // Only allow 'booked', 'completed', or 'canceled'
        if (!in_array($status, ['booked', 'completed', 'canceled'])) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $booking->status = $status;

        if ($status === 'canceled') {
            $booking->deleted_at = now(); // simulate soft-delete timestamp
        }

        $booking->save();

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking status updated to ' . ucfirst($status));
    }
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
