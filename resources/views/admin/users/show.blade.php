@extends('admin.adminLayout')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="panel-titl">
                                <i class="fa fa-user"></i> User Profile
                            </h3>
                            <p class="text-muted small" style="margin-top: 5px">Detailed information about this user</p>
                        </div>
                        
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-id-card"></i> Personal Information
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-condensed">
                                        <tr>
                                            <th class="col-xs-4">Name:</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone:</th>
                                            <td>{{ $user->phone_number ?: 'Not provided' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address:</th>
                                            <td>{{ $user->address ?: 'Not provided' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-briefcase"></i> Organization Details
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-condensed">
                                        <tr>
                                            <th class="col-xs-4">Role:</th>
                                            <td>
                                                <span class="label label-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'organization_admin' ? 'info' : 'primary') }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Organization:</th>
                                            <td>
                                                @if($user->organization)
                                                    <div>
                                                        @if($user->organization->logo_path)
                                                            <img src="{{ asset('storage/' . $user->organization->logo_path) }}" alt="{{ $user->organization->name }}" style="width: 24px; height: 24px; border-radius: 4px; object-fit: cover; margin-right: 10px; display: inline-block; vertical-align: middle;">
                                                        @endif
                                                        <span>{{ $user->organization->name }}</span>
                                                    </div>
                                                @else
                                                    Not assigned
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-left">
                                <a href="{{ route('users.index') }}" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> Back to Users
                                </a>
                            </div>

                            <div class="pull-right">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Edit Profile
                                </a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete User
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .panel {
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .panel-heading {
        border-radius: 4px 4px 0 0 !important;
    }

    .panel-title i {
        margin-right: 8px;
    }

    .user-avatar {
        margin-top: -10px;
    }

    .btn {
        border-radius: 3px;
        padding: 6px 12px;
        font-weight: 500;
    }

    .btn i {
        margin-right: 5px;
    }

    .btn-default {
        background-color: #f8f9fa;
        border-color: #ddd;
    }

    .btn-default:hover {
        background-color: #e9ecef;
    }

    .btn-warning {
        background-color: #f0ad4e;
        border-color: #eea236;
    }

    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #d58512;
    }

    .btn-danger {
        background-color: #d9534f;
        border-color: #d43f3a;
    }

    .btn-danger:hover {
        background-color: #c9302c;
        border-color: #ac2925;
    }

    .label-danger {
        background-color: #d9534f;
    }

    .label-info {
        background-color: #5bc0de;
    }

    .label-primary {
        background-color: #337ab7;
    }

    table.table-condensed th {
        color: #7f8c8d;
        font-weight: 500;
    }
</style>
@endsection
