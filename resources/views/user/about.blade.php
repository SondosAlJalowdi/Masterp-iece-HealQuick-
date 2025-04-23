@extends('user.generalLayout')
@section('content')
    <!-- About Section -->
    <section class="about_section layout_padding py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <!-- Image Box -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="img-box text-center">
                        <img src="{{ asset('images/hero-test.png') }}" alt="About HealQuick"
                            class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
                    </div>
                </div>

                <!-- Detail Box -->
                <div class="col-md-6">
                    <div class="detail-box bg-white p-4 rounded shadow-sm">
                        <div class="heading_container mb-3">
                            <h2 class="font-weight-bold text-primary">
                                About <span class="text-dark">HealQuick</span>
                            </h2>
                        </div>
                        <p class="text-secondary mb-3">
                            <strong>HealQuick</strong> brings essential healthcare services straight to your home. We offer:
                        </p>
                        <ul class="list-unstyled text-secondary mb-3 pl-3">
                            <li><i class="fa fa-check text-success mr-2"></i> Blood Draws</li>
                            <li><i class="fa fa-check text-success mr-2"></i> Injections</li>
                            <li><i class="fa fa-check text-success mr-2"></i> Oxygen Therapy</li>
                            <li><i class="fa fa-check text-success mr-2"></i> Physical Therapy</li>
                        </ul>
                        <p class="text-secondary mb-3">
                            We are dedicated to helping patients who need medical care in the comfort of their homes —
                            especially seniors and people with chronic conditions.
                        </p>
                        <p class="text-secondary">
                            Count on us for reliable, friendly, and professional care — right where you need it most.
                        </p>
                        <a href="{{ route('contact.create') }}"
                            class="btn mt-3 px-4 py-2 rounded-pill shadow-sm" style="transition: 0.3s;">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us -->
            <div class="row mt-5">
                <div class="col-12 text-center mb-4">
                    <h3 class="font-weight-bold">Why Choose <span class="text-primary">HealQuick?</span></h3>
                </div>

                <div class="col-md-4 text-center mb-4">
                    <div class="p-4 bg-white border rounded shadow-sm h-100 hover-shadow transition">
                        <i class="fa fa-user-md fa-3x text-primary mb-3"></i>
                        <h5 class="font-weight-bold">Expert Team</h5>
                        <p class="text-secondary">Certified professionals delivering reliable in-home care.</p>
                    </div>
                </div>

                <div class="col-md-4 text-center mb-4">
                    <div class="p-4 bg-white border rounded shadow-sm h-100 hover-shadow transition">
                        <i class="fa fa-calendar-check-o fa-3x text-primary mb-3"></i>
                        <h5 class="font-weight-bold">Flexible Appointments</h5>
                        <p class="text-secondary">You choose the time — we come to you.</p>
                    </div>
                </div>

                <div class="col-md-4 text-center mb-4">
                    <div class="p-4 bg-white border rounded shadow-sm h-100 hover-shadow transition">
                        <i class="fa fa-heartbeat fa-3x text-primary mb-3"></i>
                        <h5 class="font-weight-bold">Compassionate Care</h5>
                        <p class="text-secondary">We put your comfort, dignity, and health first.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional CSS inside your layout or a custom CSS file -->
    <style>
        .hover-shadow:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
            transition: all 0.3s ease-in-out;
        }

        .transition {
            transition: all 0.3s ease-in-out;
        }
        .text-primary {
            color: #62d2a2 !important;
        }
    </style>
@endsection
