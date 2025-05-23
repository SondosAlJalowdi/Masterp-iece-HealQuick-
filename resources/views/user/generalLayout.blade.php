<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> HealQuick </title>

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />

    <!-- Fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- Owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- Font Awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    <!-- Responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
    <style>
        .active-link {
            position: relative;
        }

        .active-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #fff;
            /* or your primary color */
        }
    </style>
</head>

<body>
    <header class="header_section" style="background: #178066">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="{{ route('landing') }}">
                    <span>
                        HealQuick
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('landing') ? 'active-link' : '' }}"
                                href="{{ route('landing') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active-link' : '' }}"
                                href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('services') ? 'active-link' : '' }}"
                                href="{{ route('services') }}">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact.create') ? 'active-link' : '' }}"
                                href="{{ route('contact.create') }}">Contact Us</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('registration') ? 'active-link' : '' }}"
                                    href="{{ route('registration') }}">
                                    <i class="fa-solid fa-user-plus mr-1"></i> Sign up
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('login') ? 'active-link' : '' }}"
                                    href="{{ route('login') }}">
                                    <i class="fa-solid fa-right-to-bracket mr-1"></i> Login
                                </a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.profile') ? 'active-link' : '' }}"
                                    href="{{ route('user.profile') }}">
                                    <i class="fa-solid fa-user mr-1"></i>
                                    {{ explode(' ', auth()->user()->name)[0] }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">
                                    <i class="fa-solid fa-right-from-bracket mr-1"></i>Log Out
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>

            </nav>
        </div>
    </header>
    @yield('content')
    <!-- footer section -->
    <footer class="footer_section text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4 justify-content-around">
                <!-- Contact Info -->
                <div class="col-md-6 col-lg-3">
                    <h5 class="mb-3">Reach Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fa fa-map-marker me-2"></i>
                            <span>Amman, Jordan</span>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-mobile me-2"></i>
                            <span>077 865 3663</span>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-envelope me-2"></i>
                            <span>sondosjalowdi@gmail.com</span>
                        </li>
                    </ul>
                    <div class="footer_social">
                        <a href="https://wa.me/962778653663?text=Hello%2C%20I%20would%20like%20to%20inquire%20about%20your%20services" target="_blank">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        </a>

                        <a href="#">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/sondos-a-321398253/" target="_blank">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <!-- About -->
                <div class="col-md-6 col-lg-4">
                    <h5 class="mb-3">About HealQuick</h5>
                    <p>
                        HealQuick offers a wide range of home healthcare services including blood draws, injections,
                        oxygen therapy, and physical therapy. We deliver compassionate, professional care right to your
                        door.
                    </p>
                </div>

                <!-- Navigation Links -->
                <div class="col-md-6 col-lg-2">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="">
                        <li><a href="{{ route('landing') }}" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-white text-decoration-none">About</a></li>
                        <li><a href="{{ route('services') }}" class="text-white text-decoration-none">Services</a>
                        </li>
                        <li><a href="{{ route('contact.create') }}" class="text-white text-decoration-none">Contact
                                Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer bottom -->
            <div class="text-center mt-4 border-top pt-3 small">
                <p class="mb-0">
                    &copy; <span id="displayYear"></span> All Rights Reserved by
                    <a href="#" class="text-white fw-bold text-decoration-underline">Sondos Al
                        Jalowdi</a>
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Auto-update year
        document.getElementById("displayYear").innerText = new Date().getFullYear();
    </script>

    <!-- footer section -->
    <!-- jQery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- owl slider -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- custom js -->
    <script type="text/javascript" src="js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->
    <script src="https://kit.fontawesome.com/5ab58071a0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
