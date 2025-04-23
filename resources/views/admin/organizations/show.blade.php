@extends('admin.adminLayout')

@section('content')
<div class="container mt-4">
    <div class="card border-success">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Organization Details</h4>
            <a href="{{ route('organizations.index') }}" class="btn btn-light btn-sm">Back</a>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $organization->name }}</h5>

            <p><strong>Email:</strong> {{ $organization->email }}</p>
            <p><strong>Phone:</strong> {{ $organization->phone }}</p>
            <p><strong>Address:</strong> {{ $organization->address }}</p>
            <p><strong>Created By:</strong> {{ $organization->user->name ?? 'N/A' }}</p>
            <p><strong>Created At:</strong> {{ $organization->created_at->format('Y-m-d H:i') }}</p>

            <div class="mt-3">
                <a href="{{ route('organizations.edit', $organization) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('organizations.destroy', $organization) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this organization?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
