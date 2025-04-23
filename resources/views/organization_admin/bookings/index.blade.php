@extends('organization_admin.orgAdminLayout')
@section('content')
<div class="container-fluid">
    <h4 class="mb-4">All Bookings</h4>
    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Service</th>
                        <th>Employee</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->service->name }}</td>
                            <td>{{ $booking->employee->name }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->booking_time }}</td>
                            <td><span class="badge badge-info">{{ $booking->status }}</span></td>
                            <td>${{ $booking->price }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
