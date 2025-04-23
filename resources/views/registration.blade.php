@extends('user.generalLayout')
@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100 p-4">
    <div class="card shadow-lg p-4 w-100" style="max-width: 500px;">
        <h3 class="text-center mb-3">Register for HealQuick</h3>
        <form method="POST" action="{{ route('registration.post') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                    @if ($errors->has('password') && !str_contains($errors->first('password'), 'confirmation'))
                        <div class="alert alert-danger mt-1">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="mb-3 col-md-6">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                    @if($errors->has('password') && str_contains($errors->first('password'), 'confirmation'))
                        <div class="alert alert-danger mt-1">{{ $errors->first('password') }}</div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required>
                    @error('phone_number')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
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
@endsection
