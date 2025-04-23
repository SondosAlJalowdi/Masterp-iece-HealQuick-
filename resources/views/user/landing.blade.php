@extends('user.landinglayout')
@section('hero-bg')
    <div class="hero_bg_box">
        <img src="images/hero-test.jpg" alt="">
    </div>
@endsection
@section('slider')
    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="detail-box">
                                    <h1>
                                        Book An Appointment Easily
                                    </h1>
                                    <p>
                                        Need a home visit for a blood test, injection, or therapy session? HealQuick makes
                                        it simple.
                                        Schedule an appointment online and receive professional care right at your
                                        doorstep—quickly and safely.
                                    </p>
                                    <div class="btn-box">
                                        <a href="{{ route('booking.form') }}" class="btn1" style="width: 200px">
                                            Take An Appointment
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="detail-box">
                                    <h1>
                                        We Provide Best Healthcare at Home
                                    </h1>
                                    <p>
                                        Experience top-quality healthcare services delivered directly to your home.
                                        Whether it's blood tests, injections, or physical therapy, HealQuick is here
                                        to help you stay healthy without the hassle of visiting the clinic.
                                    </p>
                                    <div class="btn-box">
                                        <a href="{{ route('about') }}" class="btn1">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ol class="carousel-indicators" style="margin-top: 100px ">
                <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                <li data-target="#customCarousel1" data-slide-to="1"></li>
            </ol>
        </div>

    </section>
@endsection
@section('content')
    <!-- services section -->

    <section class="department_section layout_padding">
        <div class="department_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <h2>
                        Our Healthcare Services
                    </h2>
                    <p>
                        We offer a wide range of healthcare services designed to provide quality care directly at your home.
                    </p>
                </div>
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-md-3 mb-4">
                            <div class="box h-100 shadow-sm p-3 bg-white rounded">
                                <div class="img-box text-center mb-3">
                                    <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="img-fluid"
                                        style="height:100px">
                                </div>
                                <div class="detail-box text-center">
                                    <h5 class="mb-2">{{ $service->name }}</h5>
                                    <p class="text-muted">{{ $service->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="btn-box">
                    <a href="{{ route('services') }}">
                        View All
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- end services section -->

    <!-- about section -->

    <section class="about_section  layout_padding">
        <div class="container  ">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="img-box">
                        <img src="images/home healthcare.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                About <span>Us</span>
                            </h2>
                        </div>
                        <p>
                            HealQuick offers a wide range of healthcare services,
                            including blood draws, injections, oxygen therapy,
                            and physical therapy, all delivered to your home.
                            We focus on providing quality care with the utmost convenience and professionalism.
                        </p>
                        <a href="{{ route('about') }}" class="btn1">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->


    <!-- contact section -->
    <section class="contact_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Get In Touch
                </h2>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container contact-form">
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-lg-6 mb-3">
                                    <input type="text" name="name" placeholder="Your Name" class="form-control"
                                        required />
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <input type="text" name="subject" placeholder="Subject" class="form-control"
                                        required />
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea name="message" placeholder="Message" class="form-control message-box" rows="5" required></textarea>
                            </div>
                            <div class="btn_box">
                                <button type="submit" class="btn btn-primary">SEND</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="image-container">
                        <div class="img-box">
                            <img src="{{ asset('images/contact.jpg') }}" alt="Contact Us Image" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end contact section -->
    <style>
        .img-box img {
            border-radius: 15px;
        }

        .layout_padding {
            padding: 90px 0;
        }
    </style>
@endsection
