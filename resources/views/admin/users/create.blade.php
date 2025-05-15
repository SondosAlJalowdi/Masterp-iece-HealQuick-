@extends('admin.adminLayout')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <!-- Main content column -->
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="panel panel-success" style="border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <div class="panel-heading" style="background-color: #178066; color: white; border-radius: 4px 4px 0 0; border: none;">
                    <h3 class="panel-title">
                        <i class="fa fa-user-plus"></i> {{ isset($user) ? 'Edit' : 'Add' }} User
                    </h3>
                </div>

                <div class="panel-body" style="padding: 20px;">
                    <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $user->name ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $user->email ?? '') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="{{ old('phone_number', $user->phone_number ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Role <span class="text-danger">*</span></label>
                                    <select name="role" class="form-control" required>
                                        <option value="admin" {{ (old('role', $user->role ?? '') == 'admin' ? 'selected' : '') }}>Admin</option>
                                        <option value="organization_admin" {{ (old('role', $user->role ?? '') == 'organization_admin' ? 'selected' : '' )}}>
                                            Organization Admin
                                        </option>
                                        <option value="patient" {{ (old('role', $user->role ?? '') == 'patient' ? 'selected' : '' )}}>Patient</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ old('address', $user->address ?? '') }}" required>
                                </div>
                            </div>
                        </div>

                        @if(!isset($user))
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee;">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i> {{ isset($user) ? 'Update' : 'Create' }} User
                                    </button>
                                    <a href="{{ route('users.index') }}" class="btn btn-default">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f5f7fa;
    }

    .panel {
        border: none;
    }

    .panel-heading {
        padding: 12px 15px;
    }

    .panel-title {
        font-size: 16px;
        font-weight: 600;
    }

    .panel-title i {
        margin-right: 8px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .control-label {
        font-weight: 500;
        color: #555;
        margin-bottom: 5px;
    }

    .form-control {
        border-radius: 3px;
        border: 1px solid #d1d9e6;
        box-shadow: none;
        height: 38px;
    }

    .form-control:focus {
        border-color: #178066;
        box-shadow: 0 0 0 2px rgba(23, 128, 102, 0.2);
    }

    .btn {
        border-radius: 3px;
        padding: 8px 16px;
        font-weight: 500;
    }

    .btn i {
        margin-right: 5px;
    }

    .btn-success {
        background-color: #178066;
        border-color: #126652;
    }

    .btn-success:hover {
        background-color: #126652;
    }

    .btn-default {
        background-color: #f8f9fa;
        border-color: #d1d9e6;
    }

    .btn-default:hover {
        background-color: #e9ecef;
    }

    .text-danger {
        color: #e74c3c;
    }
</style>
@endsection
