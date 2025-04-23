@extends('admin.adminLayout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="header">
                    <h4 class="title">User Details</h4>
                    <p class="category">Detailed view of user information</p>
                </div>
                <div class="content">
                    <table class="table table-borderless">
                        <tr>
                            <th>Name:</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role:</th>
                            <td>
                                <span class="label label-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'organization_admin' ? 'info' : 'success') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Phone Number:</th>
                            <td>{{ $user->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>Organization:</th>
                            <td>{{ $user->organization->name ?? 'N/A' }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Back to Users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
