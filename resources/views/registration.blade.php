@extends('user.generalLayout')
@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100 p-4">
        <div class="card shadow-lg p-4 w-100" style="max-width: 500px;">
            <h3 class="text-center mb-3">Register for HealQuick</h3>
            <form id="registrationForm" method="POST" action="{{ route('registration.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required>
                    <div class="invalid-feedback">Full name must contain at least 4 words.</div>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               required>
                        <div class="invalid-feedback">Password is required.</div>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password"
                               class="form-control"
                               id="password_confirmation"
                               name="password_confirmation"
                               required>
                        <div class="invalid-feedback">Passwords do not match.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text"
                               class="form-control @error('phone_number') is-invalid @enderror"
                               id="phone_number"
                               name="phone_number"
                               value="{{ old('phone_number') }}"
                               required>
                        <div class="invalid-feedback">Phone must be 10 digits and start with 077, 078, or 079.</div>
                        @error('phone_number')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text"
                               class="form-control @error('address') is-invalid @enderror"
                               id="address"
                               name="address"
                               value="{{ old('address') }}"
                               required>
                        <div class="invalid-feedback">Address is required.</div>
                        @error('address')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn" style="background-color: #62d2a2; color: white;">Register</button>
                </div>

                <div class="mt-3 text-center">
                    <small>Already have an account? <a href="{{ route('login') }}">Login</a></small>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            // Reset invalid classes on submit
            const inputs = this.querySelectorAll('.form-control');
            inputs.forEach(input => input.classList.remove('is-invalid'));

            let isValid = true;

            // Full name validation (4 or more words)
            const name = document.getElementById('name');
            if (name.value.trim().split(/\s+/).length < 4) {
                name.classList.add('is-invalid');
                isValid = false;
            }

            // Skip email validation here to let Laravel handle it

            // Password validation
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            if (password.value === '') {
                password.classList.add('is-invalid');
                isValid = false;
            }
            if (password.value !== confirmPassword.value) {
                confirmPassword.classList.add('is-invalid');
                isValid = false;
            }

            // Phone validation
            const phone = document.getElementById('phone_number');
            const phonePattern = /^(077|078|079)\d{7}$/;
            if (!phonePattern.test(phone.value.trim())) {
                phone.classList.add('is-invalid');
                isValid = false;
            }

            // Address validation
            const address = document.getElementById('address');
            if (address.value.trim() === '') {
                address.classList.add('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault(); // prevent submission if invalid
            }
            // else form submits and Laravel validates email + other backend checks
        });
    </script>
@endsection
