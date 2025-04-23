@extends('user.generalLayout')
@section('content')

<title>HealQuick - {{ $service->name }} Providers</title>

<div class="container py-4">
    <h1 class="text-center mb-5">Providers for {{ $service->name }}</h1>

    <!-- Filter & Search Form -->
    <form method="GET" class="mb-4 bg-light p-3 rounded shadow-sm border">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="search" class="form-label">Search by Name</label>
                <input type="text" class="form-control" name="search" id="search" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label for="min_price" class="form-label">Min Price</label>
                <input type="number" class="form-control" name="min_price" value="{{ request('min_price') }}">
            </div>
            <div class="col-md-2">
                <label for="max_price" class="form-label">Max Price</label>
                <input type="number" class="form-control" name="max_price" value="{{ request('max_price') }}">
            </div>
            <div class="col-md-2">
                <label for="min_rating" class="form-label">Min Rating</label>
                <select class="form-control" name="min_rating">
                    <option value="">Any</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ request('min_rating') == $i ? 'selected' : '' }}>{{ $i }}+</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn text-white mr-2" style="background-color: #178066"><i class="fa-solid fa-filter mr-2"></i> Filter</button>
                <a href="{{ route('get.providers', $service->name) }}" class="btn btn-outline-primary"><i class="fa-solid fa-rotate-right mr-2"></i> Reset</a>
            </div>
        </div>
    </form>

    @if ($organizations->isEmpty())
        <div class="alert alert-info text-center py-3">
            <i class="fas fa-info-circle me-2"></i> No providers found for this service.
        </div>
    @else
        <div class="row g-4">
            @foreach ($organizations as $organization)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="row g-0 h-100">
                            <!-- Logo Column -->
                            <div class="col-md-4 p-0 border-end">
                                @if ($organization->logo)
                                    <img src="{{ asset($organization->logo) }}" alt="{{ $organization->name }} Logo"
                                        class="h-100 w-100 object-fit-cover" style="min-height: 180px; min-width: 180px;">
                                @else
                                    <div class="h-100 d-flex align-items-center justify-content-center bg-white">
                                        <i class="fas fa-hospital-alt fa-3x text-muted"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content Column -->
                            <div class="col-md-8">
                                <div class="card-body h-100 d-flex flex-column p-3">
                                    <h5 class="card-title mb-2">{{ $organization->name }}</h5>

                                    @if ($organization->average_rating)
                                        <div class="mb-2">
                                            <span class="text-warning">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    {!! $i <= round($organization->average_rating) ? '★' : '☆' !!}
                                                @endfor
                                            </span>
                                            <small class="text-muted ms-1">
                                                ({{ number_format($organization->average_rating, 1) }}/5)
                                            </small>
                                        </div>
                                    @else
                                        <p class="mb-2 text-muted"><small>No ratings yet</small></p>
                                    @endif

                                    @php
                                        $orgService = $organization->services->first();
                                    @endphp

                                    @if ($orgService && $orgService->pivot)
                                        <p class="card-text text-muted mb-2">
                                            Price: {{ number_format($orgService->pivot->price, 2) }} JD
                                        </p>
                                    @else
                                        <p class="card-text text-muted mb-2">
                                            Price: Not available
                                        </p>
                                    @endif

                                    <p class="card-text text-muted mb-3 flex-grow-1">
                                        {{ \Illuminate\Support\Str::words($organization->short_description ?? 'No description available.', 11, '...') }}
                                    </p>

                                    <div class="d-flex">
                                        <a href="{{ route('reviews.show', ['organization' => $organization->id, 'service' => $service->id]) }}"
                                            class="btn btn-outline-primary btn-sm mr-2">
                                            Details
                                        </a>
                                        <a href="{{ route('completeBooking', ['serviceId' => $service->id, 'organizationId' => $organization->id]) }}"
                                            class="btn text-white btn-sm" style="background-color: #178066">
                                            Book Appointment
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-4 gap-2">
        <div>
            {{ $organizations->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<style>
    .btn-outline-primary {
        border-color: #178066;
        background-color: white;
        color: #178066;
    }
    .btn-outline-primary:hover {
        background-color: #178066;
        color: white;
        border-color: #178066
    }

    .pagination li a,
    .pagination li span {
        border-radius: 8px !important;
        margin: 0 4px;
        padding: 8px 12px;
        color: #178066 !important;
    }

    .pagination li.active span {
        background-color: #178066;
        color: white !important;
        border: none;
    }

    .pagination li a:hover {
        background-color: #f1f1f1;
    }

    .pagination .page-link {
        border-radius: 6px;
        margin: 0 3px;
        color: #178066;
    }

    .pagination .page-item.active .page-link {
        background-color: #178066;
        color: #fff;
        border-color: #178066;
    }

    .text-muted.small {
        font-size: 0.9rem;
        font-weight: 500;
        margin-right: 5px;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 0.5rem !important;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .border-end {
        border-right: 1px solid rgba(0, 0, 0, 0.1) !important;
    }

    .object-fit-cover {
        object-fit: cover;
        object-position: center;
    }

    form .form-label {
        font-weight: 600;
        color: #178066;
    }
</style>

@endsection
