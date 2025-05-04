@extends('admin.adminLayout')

@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #f8f9fa; border-bottom: 1px solid #eee;">
                        <h3 class="panel-title" style="font-weight: 600;">
                            <i class="fa fa-user-edit"></i> {{ isset($user) ? 'Edit' : 'Create' }} User
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($user))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" name="name" class="form-control input-lg"
                                            value="{{ old('name', $user->name ?? '') }}" required
                                            placeholder="Enter full name">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" name="email" class="form-control input-lg"
                                            value="{{ old('email', $user->email ?? '') }}" required
                                            placeholder="Enter email address">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Role</label>
                                        <select name="role" class="form-control input-lg" required>
                                            <option value="admin"
                                                {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="organization_admin"
                                                {{ old('role', $user->role ?? '') == 'organization_admin' ? 'selected' : '' }}>
                                                Organization Admin</option>
                                            <option value="patient"
                                                {{ old('role', $user->role ?? '') == 'patient' ? 'selected' : '' }}>Patient
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input type="text" name="phone_number" class="form-control input-lg"
                                            value="{{ old('phone_number', $user->phone_number ?? '') }}" required
                                            placeholder="Enter phone number">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Address</label>
                                        <input type="text" name="address" class="form-control input-lg"
                                            value="{{ old('address', $user->address ?? '') }}" required
                                            placeholder="Enter full address">
                                    </div>

                                    @if (!isset($user))
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" class="form-control input-lg" required
                                                placeholder="Enter password">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fa fa-save"></i> {{ isset($user) ? 'Update' : 'Create' }} User
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-default btn-lg">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .panel {
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .panel-heading {
            padding: 15px;
        }

        .panel-title {
            font-size: 18px;
        }

        .panel-title i {
            margin-right: 10px;
            color: #178066;
        }

        .panel-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .control-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #ddd;
            box-shadow: none;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #178066;
            box-shadow: 0 0 0 2px rgba(23, 128, 102, 0.2);
        }

        .input-lg {
            height: 46px;
            padding: 10px 15px;
            font-size: 15px;
        }

        .btn {
            border-radius: 4px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-lg {
            padding: 12px 24px;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-primary {
            background-color: #178066;
            border-color: #126652;
        }

        .btn-primary:hover {
            background-color: #126652;
            border-color: #0d4d3f;
        }

        .btn-default {
            background-color: #f8f9fa;
            border-color: #ddd;
        }

        .btn-default:hover {
            background-color: #e9ecef;
            border-color: #ccc;
        }
    </style>
@endsection
