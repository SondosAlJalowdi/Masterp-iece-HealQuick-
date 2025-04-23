@extends('user.generalLayout')

@section('content')
<style>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        box-shadow: 0 20px 20px rgba(0, 0, 0, 0.15);
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #178066;
    }

    .card-text {
        color: #555;
    }

    .service-img-wrapper {
        width: 100px;
        height: 100px;
        margin: 20px auto 10px;
        background-color: #62d2a2;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .service-img-wrapper img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-5">Explore Our Services</h2>
    <div class="row mx-auto">
        @foreach ($services as $service)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                @if($service->image)
                <div class="service-img-wrapper">
                    <img src="{{ asset($service->image) }}" alt="{{ $service->name }}">
                </div>
                @endif
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $service->name }}</h5>
                    <p class="card-text">{{ $service->description }}</p>
                </div>
                <div class="card-footer bg-white border-0 text-center">
                    <a href="{{ route('get.providers', $service->name) }}" class="btn2 mb-3">View Providers</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
