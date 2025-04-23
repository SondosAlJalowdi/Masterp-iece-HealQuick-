@extends('admin.adminLayout')
@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 20px;">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h2 class="panel-title pull-left">All Bookings</h2>
                    </div>
                    <div class="panel-body">
                        <!-- Search & Filters -->
                        <form method="GET" action="{{ route('bookings.index') }}" class="form-inline text-center"
                            style="margin-bottom: 20px;">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by user, service or org" value="{{ request()->search }}">
                            </div>

                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="booked" {{ request()->status == 'booked' ? 'selected' : '' }}>Booked
                                    </option>
                                    <option value="completed" {{ request()->status == 'completed' ? 'selected' : '' }} >
                                        Completed</option>
                                    <option value="canceled" {{ request()->status == 'canceled' ? 'selected' : '' }}>
                                        Canceled</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="date" name="date" class="form-control" value="{{ request()->date }}">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i> Filter
                            </button>

                            <a href="{{ route('bookings.index') }}" class="btn btn-default">
                                <i class="fa fa-refresh"></i> Reset
                            </a>
                        </form>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="row">
                            @forelse($bookings as $booking)
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                Booking #{{ $booking->id }}
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p><strong>User:</strong> {{ $booking->user->name ?? '-' }}</p>
                                            <p><strong>Service:</strong> {{ $booking->service->name ?? '-' }}</p>
                                            <p><strong>Organization:</strong> {{ $booking->organization->name ?? '-' }}</p>
                                            <p><strong>Employee:</strong> {{ $booking->employee->name ?? '-' }}</p>
                                            <p><strong>Date:</strong> {{ $booking->booking_date }}</p>
                                            <p><strong>Time:</strong>
                                                {{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}</p>
                                            <p><strong>Status:</strong>
                                                <span
                                                    class="label label-{{ $booking->status == 'booked' ? 'info' : ($booking->status == 'completed' ? 'success' : 'danger') }} ">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </p>
                                            <p><strong>Price:</strong> ${{ number_format($booking->price, 2) }}</p>
                                        </div>
                                        <div class="panel-footer text-center">
                                            <a href="{{ route('bookings.show', $booking->id) }}"
                                                class="btn btn-xs btn-info">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('bookings.edit', $booking->id) }}"
                                                class="btn btn-xs btn-warning">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12 text-center">
                                    <div class="alert alert-warning">No bookings found.</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination Outside the Container -->
        <div class="text-center">
            @if ($bookings->lastPage() > 1)
    <ul class="pagination">
        @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
            <li class="page-item {{ ($bookings->currentPage() == $page) ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach
    </ul>
@endif

        </div>

    </div>
@endsection
