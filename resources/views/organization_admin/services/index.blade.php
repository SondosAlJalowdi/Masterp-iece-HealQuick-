@extends('organization_admin.orgAdminLayout')
@section('content')
    <div class="container-fluid">
        <h4 class="mb-4">Services Offered</h4>
        <div class="card shadow-sm p-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Service Name</th>
                            <th>Employee</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $index => $entry)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $entry->service_name }}</td>
                                <td>{{ $entry->employee_name }}</td>
                                <td>${{ $entry->price }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
