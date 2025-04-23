@extends('organization_admin.orgAdminLayout')
@section('content')
<div class="container-fluid">
    <h4 class="mb-4">All Reviews</h4>
    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Service</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $index => $review)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $review->user->name ?? 'Deleted User' }}</td>
                            <td>{{ $review->service->name ?? '-' }}</td>
                            <td>{{ $review->rating }} ★</td>
                            <td>{{ $review->comment ?? '-' }}</td>
                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No reviews found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

