@extends('organization_admin.orgAdminLayout')
@section('content')
<div class="content">
    <div class="container-fluid">

        @auth
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert" style="background-color: #62d2a2">
                        <strong>Welcome, {{ auth()->user()->name }}!</strong>
                    </div>
                </div>
            </div>
        @endauth

        <!-- Dashboard Stats -->
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5 text-center">
                                <i class="fa fa-calendar-check-o fa-3x text-success"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                                <p class="title">Bookings</p>
                                <h4>{{ $bookingCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5 text-center">
                                <i class="fa fa-star fa-3x text-info"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                                <p class="title">Reviews</p>
                                <h4>{{ $reviewCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Bookings Table -->
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Latest Bookings</h4>
                        <p class="category">The 5 most recent service bookings for your organization</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Service</th>
                                    <th>Booking Date</th>
                                    <th>Booking Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestBookings as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                        <td>{{ $booking->service->name ?? 'N/A' }}</td>
                                        <td>{{ $booking->booking_date ?? '-' }}</td>
                                        <td>{{ $booking->booking_time ? \Carbon\Carbon::parse($booking->booking_time)->format('H:i') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No bookings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .card .title {
        font-size: 14px;
        color: #999;
        margin: 0;
    }

    .card h4 {
        font-size: 24px;
        margin: 5px 0 0;
    }

    .card .content {
        min-height: 100px;
    }

    .alert-info {
        font-size: 16px;
    }

    .table > thead > tr > th {
        white-space: nowrap;
    }
</style>
@endsection
