<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Employee;
use App\Models\Organization;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;


class BookingWithLongWayController extends Controller
{

    public function create($serviceId, $organizationId)
    {
        $service = Service::findOrFail($serviceId);
        $organization = Organization::findOrFail($organizationId);

        // Get available employees for the organization
        $employees = Employee::where('organization_id', $organizationId)
            ->where('status', 'active')
            ->get();

        if ($employees->isEmpty()) {
            return back()->with('error', 'No available employees at this time.');
        }

        // Pick a random available employee
        $employee = $employees->random();

        // Get all bookings for this employee
        $bookings = Booking::where('employee_id', $employee->id)
        ->where('organization_id', $organizationId)
        ->where('status', '!=', 'canceled')
        ->get();

        // Group booked slots by date
        $bookedSlots = [];
        $today = now()->toDateString();
        $currentTime = now()->format('H:i');
        foreach ($bookings as $booking) {
            $date = $booking->booking_date;
            $time = \Carbon\Carbon::parse($booking->booking_time)->format('H:i');
            if ($date === $today && $time <= $currentTime) {
                continue;
            }
            $bookedSlots[$date][] = $time;
        }

        return view('user.completeBooking', compact('service', 'organization', 'employee', 'bookedSlots'));
    }




    public function store(Request $request, $serviceId, $organizationId)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
        ]);

        // Find available employee
        $employees = Employee::where('organization_id', $organizationId)
            ->where('status', 'active')
            ->get();

        $availableEmployee = null;

        foreach ($employees as $employee) {
            $isBooked = Booking::where('employee_id', $employee->id)
                ->where('booking_date', $request->booking_date)
                ->where('booking_time', $request->booking_time)
                ->exists();

            if (!$isBooked) {
                $availableEmployee = $employee;
                break;
            }
        }

        if (!$availableEmployee) {
            return back()->with('error', 'No available employees at the selected time. Please try another slot.');
        }

        // Get the price from the pivot table
        $service = Service::findOrFail($serviceId);
        $price = $service->organizations()->where('organization_id', $organizationId)->first()->pivot->price ?? 0;
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->organization_id = $organizationId;
        $booking->service_id = $serviceId;
        $booking->employee_id = $availableEmployee->id;
        $booking->booking_date = $request->booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->price = $price;
        $booking->status = 'booked';
        $booking->save();

        return redirect()->route('user.profile')->with('success', 'Appointment booked successfully!');
    }
}
