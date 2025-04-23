@extends('user.generalLayout')

@section('content')
    <div class="container py-4">
        {{-- Organization Header --}}
        <div class="card mb-5 border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="row g-0">
                <div class="col-md-4 p-0">
                    @if ($organization->logo)
                        <img src="{{ asset($organization->logo) }}" alt="{{ $organization->name }} Logo"
                            class="img-fluid h-100 w-100 object-fit-cover">
                    @else
                        <div class="h-100 d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-hospital-alt fa-4x text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body p-4">
                        <h1 class="h3 fw-bold d-flex">
                            <p class="mr-2">{{ $organization->name }}</p>

                            @if ($averageRating)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="text-warning fs-5 mr-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            {!! $i <= round($averageRating) ? '★' : '☆' !!}
                                        @endfor
                                    </div>
                                    <span class="text-muted small">
                                        {{ number_format($averageRating, 1) }}
                                        ({{ $organization->reviews_count }} reviews)
                                    </span>
                                </div>
                            @endif

                        </h1>
                        <h5 class="mb-3"><strong>Service:</strong> {{ $service->name }}.</h5>
                        <h5><strong>Price:</strong> {{ $price }} JD.</h5>
                        <p><strong class="mb-3">Description:</strong> {{ $organization->long_description }}</p>

                        <div class="text-muted">
                            @if ($organization->address)
                                <p class="mb-1"><i class="fa fa-location-dot mr-2"></i>{{ $organization->address }}</p>
                            @endif
                            @if ($organization->phone)
                                <p class="mb-0"><i class="fas fa-phone mr-2"></i>{{ $organization->phone }}</p>
                            @endif
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('completeBooking', ['serviceId' => $service->id, 'organizationId' => $organization->id]) }}"
                                class="btn text-white btn-sm" style="background-color: #178066">
                                Book Appointment
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Reviews Section --}}
        <div class="card border-0 shadow-lg rounded-4 mb-5">
            <div class="card-header bg-white border-bottom py-3">
                <h3 class="h5 mb-0">
                    <i class="fas fa-comments mr-2" style="color: #178066"></i>
                    Patients Reviews
                    @if (!$reviews->isEmpty())
                        <span class="badge text-white ml-2"
                            style="background-color: #178066">{{ $reviews->count() }}</span>
                    @endif
                </h3>
            </div>

            <div class="card-body p-0">
                @if ($reviews->isEmpty())
                    <div class="text-center py-5 px-4">
                        <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                        <h4 class="h5 text-muted mb-3">No reviews yet</h4>
                        <p class="text-muted mb-4">Be the first to share your experience!</p>
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt mr-1"></i> Sign In to Review
                            </a>
                        @endguest
                    </div>
                @else
                    <div class="p-4">
                        <div class="row g-4">
                            @foreach ($reviews as $review)
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 shadow-sm rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h5 class="card-title mb-0">
                                                        {{ $review->user?->name ?? 'Deleted User' }}
                                                    </h5>
                                                    <small class="text-muted">
                                                        <i class="far fa-clock mr-1"></i>
                                                        {{ $review->created_at?->diffForHumans() ?? 'Recently' }}
                                                    </small>
                                                </div>
                                                <div class="text-warning">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        {!! $i <= $review->rating ? '★' : '☆' !!}
                                                    @endfor
                                                </div>
                                            </div>
                                            @if (isset($editingReview) && $editingReview->id === $review->id)
                                                {{-- Edit Form --}}
                                                <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="rating">Rating</label>
                                                        <select name="rating" class="form-control">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <option value="{{ $i }}"
                                                                    {{ $review->rating == $i ? 'selected' : '' }}>
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="comment">Comment</label>
                                                        <textarea name="comment" class="form-control" rows="3">{{ $review->comment }}</textarea>
                                                    </div>

                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="fas fa-check mr-1"></i> Update
                                                        </button>
                                                        <a href="{{ request()->url() }}"
                                                            class="btn btn-secondary btn-sm ml-2">
                                                            Cancel
                                                        </a>
                                                    </div>
                                                </form>
                                            @else
                                                <p class="card-text mt-3 mb-0">{{ $review->comment }}</p>
                                            @endif

                                        </div>
                                        @if (auth()->id() === $review->user_id)
                                            <div class="card-footer bg-transparent border-top-0 text-end py-2">
                                                <a href="{{ request()->url() }}?edit_review_id={{ $review->id }}"
                                                    class="text-decoration-none text-primary small">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                <form id="delete-review-{{ $review->id }}"
                                                    action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                                                    class="d-inline-block float-right delete-review-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link text-danger p-0 m-0 small"
                                                        onclick="confirmDelete({{ $review->id }})">
                                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Review Form (Standalone Card) --}}

        @auth
            @php
                $hasBooked = \App\Models\Booking::where('user_id', auth()->id())
                    ->where('service_id', $service->id)
                    ->where('organization_id', $organization->id)
                    ->exists();
            @endphp

            @if ($hasBooked)
                <div class="card border-0 shadow-lg rounded-4 mb-5">
                    <div class="card-header text-white py-3" style="background-color: #178066">
                        <h3 class="h5 mb-0"><i class="fas fa-edit mr-2"></i> Share Your Experience</h3>
                    </div>
                    <div class="card-body p-4">
                        <form
                            action="{{ route('reviews.store', ['organization' => $organization->id, 'service' => $service->id]) }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <input type="hidden" name="organization_id" value="{{ $organization->id }}">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Your Rating</label>
                                <div class="rating-stars">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating"
                                            value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} required>
                                        <label for="star{{ $i }}">★</label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="comment" class="form-label fw-semibold">Your Review</label>
                                <textarea name="comment" class="form-control rounded-3 shadow-sm" rows="4"
                                    placeholder="Share details about your experience...">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div class="text-danger small mt-1">{{ $comment }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn px-4 py-2"
                                    style="background-color: #178066; color: white;">
                                    <i class="fas fa-paper-plane mr-2"></i> Submit Review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-warning text-center mb-5">
                    <i class="fas fa-info-circle mr-1"></i>
                    You can only review services you have booked.
                </div>
            @endif
        @else
            <div class="alert alert-info text-center mb-5">
                <i class="fas fa-info-circle mr-2"></i>
                <a href="{{ route('login') }}" class="alert-link">Sign in</a> to share your experience
            </div>
        @endauth
        <div class="text-center mb-5">
            <a href="{{ url()->previous() }}" class="btn2" style="background-color: gray">Back</a>

        </div>

    </div>

    {{-- Styling --}}
    <style>
        .rating-stars {
            direction: rtl;
            display: inline-flex;
            gap: 4px;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            font-size: 2rem;
            color: #e4e5e9;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .rating-stars input:checked~label,
        .rating-stars label:hover,
        .rating-stars label:hover~label {
            color: #ffc107;
            transform: scale(1.1);
        }

        .rating-stars input:checked~label {
            text-shadow: 0 0 8px rgba(255, 193, 7, 0.3);
        }

        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .object-fit-cover {
            object-fit: cover;
            object-position: center;
        }
    </style>
    <script>
        function confirmDelete(reviewId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This review will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-review-' + reviewId).submit();
                }
            });
        }
    </script>
@endsection
