@extends('user.generalLayout')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Organizations</h2>

    @if($organizations->isEmpty())
        <div class="alert alert-info text-center">No organizations found.</div>
    @else
        <div class="row">
            @foreach($organizations as $org)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $org->name }}</h5>
                            <p class="card-text">
                                <strong>Email:</strong> {{ $org->email }}<br>
                                <strong>Phone:</strong> {{ $org->phone }}<br>
                                <strong>Address:</strong> {{ $org->address }}
                            </p>
                            {{-- Add more organization fields as needed --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

