@extends('admin.adminLayout')

@section('content')
<div class="container-fluid">
    <div class="panel panel-default" style="margin-top: 20px;">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left">Organizations</h3>
            <a href="{{ route('organizations.create') }}" class="btn btn-primary btn-sm pull-right">
                <i class="fa fa-plus"></i> Add New
            </a>
        </div>

        <div class="panel-body">
            <!-- Search -->
            <form method="GET" action="{{ route('organizations.index') }}" class="form-inline text-center" style="margin-bottom: 20px;">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, email or address" value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                <a href="{{ route('organizations.index') }}" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a>
            </form>

            <div class="row">
                @forelse($organizations as $org)
                    <div class="col-sm-6 col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-body text-center">
                                @if($org->logo)
                                    <img src="{{  $org->logo }}" class="img-responsive center-block" style="height: 150px; width: 150px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <img src="{{ asset('default-logo.png') }}" class="img-responsive center-block" style="height: 150px; width: 150px; object-fit: cover; border-radius: 8px;">
                                @endif
                                <h4 class="mt-3">{{ $org->name }}</h4>
                                <p><strong>Email:</strong> {{ $org->email }}</p>
                                <p><strong>Phone:</strong> {{ $org->phone }}</p>
                                <p><strong>Address:</strong> {{ $org->address }}</p>
                                <p><strong>Created By:</strong> {{ $org->user->name ?? 'N/A' }}</p>
                            </div>
                            <div class="panel-footer text-center">
                                <a href="{{ route('organizations.show', $org) }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
                                <a href="{{ route('organizations.edit', $org) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                                <form action="{{ route('organizations.destroy', $org) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 text-center">
                        <div class="alert alert-warning">No organizations found.</div>
                    </div>
                @endforelse
            </div>
            <div class="text-center">
                @if ($organizations->lastPage() > 1)
        <ul class="pagination">
            @foreach ($organizations->getUrlRange(1, $organizations->lastPage()) as $page => $url)
                <li class="page-item {{ ($organizations->currentPage() == $page) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
        </ul>
    @endif
        </div>
    </div>
</div>
@endsection
