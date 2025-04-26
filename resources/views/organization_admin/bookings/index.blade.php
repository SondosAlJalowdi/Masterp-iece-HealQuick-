@extends('organization_admin.orgAdminLayout')

@section('content')
    <div class="content-area">
        <div class="container-fluid" style="margin-top: 30px">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding: 15px 20px; border-bottom: 1px solid #eee;">
                            <h3 class="panel-title" style="font-size: 16px; font-weight: 600;">
                                <i class="fa fa-calendar" style="margin-right: 8px; color: #178666;"></i>
                                All Bookings
                            </h3>
                        </div>

                        <div class="panel-body" style="padding: 20px;">
                            <!-- Search and Filter Section -->
                            <div class="well"
                                style="background-color: #f9f9f9; padding: 15px; margin-bottom: 20px; border-radius: 3px;">
                                <form method="GET" action="{{ route('organization_admin.bookings.index') }}"
                                    class="form-inline">
                                    <div class="form-group" style="margin-right: 10px; width: 300px;">
                                        <input type="text" name="search" class="form-control input-sm"
                                            placeholder="Search by user, service or employee"
                                            style="width: 100%; border-radius: 3px;" value="{{ request('search') }}">
                                    </div>
                                    <div class="form-group" style="margin-right: 10px;">
                                        <select name="status" class="form-control input-sm" style="border-radius: 3px;">
                                            <option value="">All Statuses</option>
                                            <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>
                                                Booked</option>
                                            <option value="completed"
                                                {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="canceled"
                                                {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 3px;">
                                        <i class="fa fa-search" style="margin-right: 5px;"></i> Search
                                    </button>
                                    <a href="{{ route('organization_admin.bookings.index') }}"
                                        class="btn btn-default btn-sm" style="margin-left: 5px; border-radius: 3px;">
                                        <i class="fa fa-refresh" style="margin-right: 5px;"></i> Reset
                                    </a>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" style="margin-bottom: 0;">
                                    <thead>
                                        <tr style="background-color: #f5f5f5;">
                                            <th style="width: 5%; padding: 12px 8px;">#</th>
                                            <th style="padding: 12px 8px;">User</th>
                                            <th style="padding: 12px 8px;">Service</th>
                                            <th style="padding: 12px 8px;">Employee</th>
                                            <th style="padding: 12px 8px;">Date</th>
                                            <th style="padding: 12px 8px;">Time</th>
                                            <th style="padding: 12px 8px;">Status</th>
                                            <th style="padding: 12px 8px;">Price</th>
                                            <th style="width: 10%; padding: 12px 8px; text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bookings as $index => $booking)
                                            <tr>
                                                <td style="padding: 12px 8px; vertical-align: middle;">
                                                    {{ ($bookings->currentPage() - 1) * $bookings->perPage() + $index + 1 }}
                                                </td>
                                                <td style="padding: 12px 8px; vertical-align: middle;">
                                                    {{ $booking->user ? $booking->user->name : 'Deleted user' }}
                                                </td>
                                                <td style="padding: 12px 8px; vertical-align: middle;">
                                                    {{ $booking->service ? $booking->service->name : 'N/A' }}
                                                </td>
                                                <td style="padding: 12px 8px; vertical-align: middle;">
                                                    {{ $booking->employee ? $booking->employee->name : 'N/A' }}
                                                </td>
                                                <td style="padding: 12px 8px; vertical-align: middle;">
                                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                                                </td>
                                                <td style="padding: 12px 8px; vertical-align: middle;">
                                                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                                                </td>
                                                <td style="padding: 12px 8px; vertical-align: middle; text-align: center;">
                                                    <span
                                                        class="label label-{{ $booking->status == 'booked' ? 'warning' : ($booking->status == 'completed' ? 'success' : 'danger') }}"
                                                        style="display: inline-block; padding: 3px 8px; border-radius: 3px;">
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                </td>
                                                <td style="padding: 12px 8px; vertical-align: middle;">JD
                                                    {{ number_format($booking->price, 2) }}</td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: middle;">
                                                    <a href="{{ route('organization_admin.bookings.show', $booking->id) }}"
                                                        class="btn btn-primary btn-xs" title="View"
                                                        style="padding: 3px 8px; border-radius: 3px;">
                                                        <i class="fa fa-eye"></i> View & update the status
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted" style="padding: 20px;">
                                                    <i class="fa fa-info-circle" style="margin-right: 5px;"></i> No bookings
                                                    found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if ($bookings->hasPages())
                                <div class="text-center" style="margin-top: 20px;">
                                    {!! $bookings->appends(request()->query())->links() !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
