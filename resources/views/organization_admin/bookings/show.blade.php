@extends('organization_admin.orgAdminLayout')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">
                        <i class="fa fa-calendar"></i> Booking Details #{{ $booking->id }}
                    </h3>
                    <div class="pull-right">
                        <a href="{{ route('organization_admin.bookings.index') }}" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">

                        <!-- Booking Info -->
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Booking Information</h4>
                                </div>
                                <div class="panel-body">
                                    <dl class="dl-horizontal">
                                        <dt>User:</dt>
                                        <dd>{{ $booking->user->name ?? 'N/A' }}</dd>

                                        <dt>Organization:</dt>
                                        <dd>{{ $booking->organization->name ?? 'N/A' }}</dd>

                                        <dt>Service:</dt>
                                        <dd>{{ $booking->service->name ?? 'N/A' }}</dd>

                                        <dt>Assigned Employee:</dt>
                                        <dd>{{ $booking->employee->name ?? 'N/A' }}</dd>

                                        <dt>Booking Date:</dt>
                                        <dd>{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, F j, Y') }}</dd>

                                        <dt>Booking Time:</dt>
                                        <dd>{{ $booking->booking_time ? \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') : 'Not specified' }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Status and Payment -->
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Status & Payment</h4>
                                </div>
                                <div class="panel-body">
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt>
                                        <dd>
                                            @if ($booking->status === 'booked')
                                                <span class="label label-warning">Booked</span>
                                            @elseif ($booking->status === 'completed')
                                                <span class="label label-success">Completed</span>
                                            @else
                                                <span class="label label-danger">Canceled</span>
                                            @endif
                                        </dd>

                                        <dt>Price:</dt>
                                        <dd>JD {{ number_format($booking->price, 2) }}</dd>

                                        <dt>Created At:</dt>
                                        <dd>{{ $booking->created_at->format('M j, Y \a\t g:i A') }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                    </div>

                    <form action="{{ route('organization_admin.bookings.assignEmployee', $booking->id) }}" method="POST" style="margin-top: 20px;">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">Assign Employee:</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                <option value="">Select Employee</option>
                                @foreach($availableEmployees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-top: 10px;">Assign Employee</button>
                    </form>

                    <!-- Actions -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            @if ($booking->status === 'booked')
                                <form action="{{ route('organization_admin.bookings.updateStatus', [$booking->id, 'completed']) }}"
                                    method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-check"></i> Mark as Completed
                                    </button>
                                </form>
                            @endif

                            @if ($booking->status !== 'canceled')
                                <form action="{{ route('organization_admin.bookings.updateStatus', [$booking->id, 'canceled']) }}"
                                    method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Are you sure you want to cancel this booking?')">
                                        <i class="fa fa-times"></i> Cancel The Booking
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
