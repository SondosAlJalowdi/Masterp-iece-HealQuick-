@extends('user.generalLayout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Profile</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Profile Info --}}
    <div class="card mb-4" style="border: #62d2a2 2px solid;">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background: #62d2a2">
            <span>Profile Information</span>
            <button id="toggleEditBtn" class="text-light btn" ><i class="fa-solid fa-user-pen"></i></button>
        </div>
        <div class="card-body">
            <div id="profileView">
                <div class="row">
                    <div class="col-md-3">
                        @if(auth()->user()->image)
                            <img src="{{ Storage::url(auth()->user()->image) }}" alt="Profile Image" class="img-thumbnail" style="width: 150px;">
                        @else
                            <img src="{{ asset('images/default_user.jpg') }}" alt="Default Icon" class="img-thumbnail" style="width: 150px;">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Phone Number:</strong> {{ auth()->user()->phone_number }}</p>
                        <p><strong>Address:</strong> {{ auth()->user()->address }}</p>
                    </div>
                </div>
            </div>

            {{-- Hidden Edit Form --}}
            <div id="profileEditForm" style="display: none;">
                <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-3">
                            @if(auth()->user()->image)
                            <input type="image" name="old_image" value="{{ auth()->user()->image }}" hidden>
                                <img src="{{ Storage::url(auth()->user()->image) }}" alt="Profile Image" class="img-thumbnail" style="width: 150px;">
                            @else
                                <img src="{{ asset('images/default_user.jpg') }}" alt="Default Icon" class="img-thumbnail" style="width: 150px;">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="image" class="form-label">Change Profile Picture</label>
                                <input class="form-control" type="file" name="image" id="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email (read-only)</label>
                                <input class="form-control" type="email" value="{{ auth()->user()->email }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input class="form-control" type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input class="form-control" type="text" name="address" value="{{ old('address', auth()->user()->address) }}" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn2">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- Appointments --}}
    <div class="card" style="border: #62d2a2 2px solid;">
        <div class="card-header text-white" style="background: #62d2a2">My Appointments</div>
        <div class="card-body">
            @if($appointments->isEmpty())
                <p>You have no booked appointments.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Organization</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>{{ $appointment->organization->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->booking_date)->format('F d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->booking_time)->format('H:i') ?? 'N/A' }}</td>
                                    <td>{{ $appointment->price ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match($appointment->status) {
                                                'booked' => 'bg-warning text-dark',
                                                'completed' => 'bg-success',
                                                'canceled' => 'bg-secondary',
                                                default => 'bg-light text-dark'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($appointment->status) }}</span>
                                    </td>
                                    <td>
                                        @if($appointment->status === 'booked')
                                            <form id="cancel-form-{{ $appointment->id }}" action="{{ route('bookings.cancel', $appointment->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PATCH')
                                            </form>

                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmCancel({{ $appointment->id }})">
                                                Cancel
                                            </button>
                                        @else
                                            <span class="text-muted">No actions</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- JavaScript to toggle edit form --}}
<script>
    document.getElementById('toggleEditBtn').addEventListener('click', function () {
        const view = document.getElementById('profileView');
        const form = document.getElementById('profileEditForm');
        view.style.display = view.style.display === 'none' ? 'block' : 'none';
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
        this.innerText = form.style.display === 'none' ? 'Edit Profile' : 'Cancel';
    });


    function confirmCancel(appointmentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to cancel this appointment?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, cancel it!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancel-form-' + appointmentId).submit();
            }
        });
    }

</script>
@endsection

