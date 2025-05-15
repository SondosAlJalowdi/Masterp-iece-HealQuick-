@extends('organization_admin.orgAdminLayout')

@section('content')
<div class="container-fluid">
    <h4>All Reviews</h4>

    <div class="panel panel-default">
        <div class="panel-heading">
            Reviews Table
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
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
</div>
@endsection
