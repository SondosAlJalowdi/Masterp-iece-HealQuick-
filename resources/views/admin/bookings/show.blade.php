@extends('admin.adminLayout')

@section('content')
    <div class="container-fluid">
        <div class="row"  style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left">
                            <i class="fa fa-calendar"></i> Booking Details #{{ $booking->id }}
                        </h3>
                        <div class="pull-right">
                            <a href="{{ route('bookings.index') }}" class="btn btn-default btn-sm">
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
                                            <dd>{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, F j, Y') }}
                                            </dd>

                                            <dt>Booking Time:</dt>
                                            <dd>{{ $booking->booking_time ? \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') : 'Not specified' }}
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <!-- Status and Price -->
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
                                                    <span class="label label-info">Booked</span>
                                                @elseif ($booking->status === 'completed')
                                                    <span class="label label-success">Completed</span>
                                                @else
                                                    <span class="label label-danger">Canceled</span>
                                                @endif
                                            </dd>

                                            <dt>Price:</dt>
                                            <dd>${{ number_format($booking->price, 2) }}</dd>

                                            <dt>Created At:</dt>
                                            <dd>{{ $booking->created_at->format('M j, Y \a\t g:i A') }}</dd>

                                            <dt>Last Updated:</dt>
                                            <dd>{{ $booking->updated_at->format('M j, Y \a\t g:i A') }}</dd>

                                            @if ($booking->deleted_at)
                                                <dt>Canceled At:</dt>
                                                <dd>{{ \Carbon\Carbon::parse($booking->deleted_at)->format('M j, Y \a\t g:i A') }}
                                                </dd>
                                            @endif
                                        </dl>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Actions -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>

                                @if ($booking->status === 'booked')
                                    <form action="{{ route('bookings.update-status', [$booking->id, 'completed']) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-check"></i> Mark as Completed
                                        </button>
                                    </form>
                                @endif

                                @if ($booking->status !== 'canceled')
                                    <form action="{{ route('bookings.update-status', [$booking->id, 'canceled']) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-warning" type="submit"
                                            onclick="return confirm('Are you sure you want to cancel this booking?')">
                                            <i class="fa fa-times"></i> Cancel
                                        </button>
                                    </form>
                                @endif

                                @unless ($booking->trashed())
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"
                                            onclick="return confirm('Permanently delete this booking?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                @endunless
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
