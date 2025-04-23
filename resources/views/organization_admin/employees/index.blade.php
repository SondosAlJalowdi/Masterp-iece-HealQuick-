@extends('organization_admin.orgAdminLayout')
@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Employees</h4>
    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Position</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $index => $employee)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->position }}</td>
                            <td><span class="badge badge-{{ $employee->status == 'active' ? 'success' : 'secondary' }}">{{ ucfirst($employee->status) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
