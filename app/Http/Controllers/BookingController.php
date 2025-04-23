<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Organization;
use App\Models\OrganizationService;
use App\Models\Employee;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Get all organizations offering a specific service.
     */
    public function getOrganizations($serviceId)
    {
        $organizationIds = OrganizationService::where('service_id', $serviceId)->pluck('organization_id');
        $organizations = Organization::whereIn('id', $organizationIds)->get(['id', 'name']);

        return response()->json($organizations);
    }

    /**
     * Get all booked slots for a service and organization.
     */
    public function getBookedSlots($serviceId, $organizationId)
    {
        $bookings = Booking::where('organization_id', $organizationId)
            ->whereDate('booking_date', '>=', now())
            ->get();

        $bookedSlots = [];

        foreach ($bookings as $booking) {
            $date = $booking->booking_date;
            $time = \Carbon\Carbon::parse($booking->booking_time)->format('H:i');

            if (!isset($bookedSlots[$date])) {
                $bookedSlots[$date] = [];
            }

            $bookedSlots[$date][] = $time;
        }

        return response()->json($bookedSlots);
    }


    /**
     * Get price and available employee for a selected service, organization, date, and time.
     */

     public function getPriceAndAvailableEmployee($serviceId, $organizationId)
     {
         // Fetch the organization service for price
         $organizationService = OrganizationService::where('service_id', $serviceId)
             ->where('organization_id', $organizationId)
             ->first();

         if (!$organizationService) {
             return response()->json(['error' => 'Service not found for this organization.'], 404);
         }

         // Get all employees of the organization
         $employees = Employee::where('organization_id', $organizationId)->get();

         if ($employees->isEmpty()) {
             return response()->json(['error' => 'No employees found for this organization.'], 404);
         }

         return response()->json([
             'price' => $organizationService->price,
             'employee_count' => $employees->count(),
         ]);
     }


    /**
     * Show the booking form.
     */
    public function create()
    {
        $services = Service::all();

        return view('user.bookingForm', compact('services'));
    }

    /**
     * Store the booking.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'organization_id' => 'required|exists:organizations,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'price' => 'nullable|numeric'
        ]);

        // Get all employees of the organization
        $employees = Employee::where('organization_id', $validated['organization_id'])->get();

        // Find an available employee
        $availableEmployee = null;
        foreach ($employees as $employee) {
            $existingBooking = Booking::where('employee_id', $employee->id)
                ->where('booking_date', $validated['booking_date'])
                ->where('booking_time', $validated['booking_time'])
                ->where('status', '!=', 'canceled')
                ->doesntExist();

            if ($existingBooking) {
                $availableEmployee = $employee;
                break;
            }
        }

        if (!$availableEmployee) {
            return back()->with('error', 'No available employees for the selected time slot.');
        }

        // Create the booking
        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $validated['service_id'],
            'organization_id' => $validated['organization_id'],
            'employee_id' => $availableEmployee->id,
            'booking_date' => $validated['booking_date'],
            'booking_time' => $validated['booking_time'],
            'status' => 'booked',
            'price' => $validated['price'],
        ]);

        return redirect()->route('user.profile')->with('success', 'Appointment booked successfully!');
    }

    /**
     * Cancel a booking.
     */
    public function cancel(Booking $booking)
    {
        $booking->status = 'canceled';
        $booking->save();

        return back()->with('success', 'The appointment has been canceled successfully.');
    }
}
