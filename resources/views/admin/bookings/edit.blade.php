@extends('admin.adminLayout')
@section('content')
    <div class="container-fluid">
        <div class="row"  style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left">
                            <i class="fa fa-pencil"></i> Edit Booking #{{ $booking->id }}
                        </h3>
                        <div class="pull-right">
                            <a href="{{ route('bookings.index') }}" class="btn btn-default btn-sm">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Booking Info (Non-Editable) -->
                                <div class="col-md-6">
                                    <div class="panel panel-default">
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
                                            </dl>
                                        </div>
                                    </div>
                                </div>

                                <!-- Editable Fields: Booking Time & Status -->
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Edit Booking</h4>
                                        </div>
                                        <div class="panel-body">
                                            <!-- Booking Time -->
                                            <div class="form-group">
                                                <label for="booking_time">Booking Time</label>
                                                <input type="text" class="form-control" id="booking_time" name="booking_time"
                                                       value="{{ old('booking_time', $booking->booking_time) }}"
                                                       placeholder="Enter booking time (H:i)"
                                                       @if(!$booking->booking_time) required @endif>
                                                @error('booking_time')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Status -->
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="booked" {{ old('status', $booking->status) == 'booked' ? 'selected' : '' }}>Booked</option>
                                                    <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="canceled" {{ old('status', $booking->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                                </select>
                                                @error('status')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
