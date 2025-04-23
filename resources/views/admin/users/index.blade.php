@extends('admin.adminLayout')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="card">
                <!-- Custom Flex Header -->
                <div class="header clearfix" style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="title">Users</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa-solid fa-user-plus" style="margin-right: 5px"></i>Add User</a>
                </div>

                <div class="content table-responsive table-full-width">
                    @if(session('success'))
                        <div class="alert alert-success" style="margin-top: 10px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-hover table-striped">
                        <thead class="text-primary">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Organization</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="label label-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'organization_admin' ? 'info' : 'success') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->organization->name ?? 'N/A' }}</td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($users->isEmpty())
                        <p class="text-center">No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
