<!DOCTYPE html>
<html>

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
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <title> HealQuick </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

</head>


<body>

    <div class="hero_area">

        @yield('hero-bg')

        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="{{route('landing')}}">
                        <span>
                            HealQuick
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('landing') }}">Home <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('services') }}">Services</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('organizations') }}">Organizations</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('contact.create')}}">Contact Us</a>
                            </li>
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('registration') }}"><i class="fa-solid fa-user-plus mr-1"></i> Sign up</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket mr-1"></i> Login</a>
                                </li>
                            @endguest
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.profile') }}"><i class="fa-solid fa-user mr-1"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket mr-1"></i>Log Out</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->

        @yield('slider')
        <!-- end slider section -->
    </div>

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
                        <span>Location</span>
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-phone me-2"></i>
                        <span>+01 1234567890</span>
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-envelope me-2"></i>
                        <span>demo@gmail.com</span>
                    </li>
                </ul>
                <div class="footer_social">
                    <a href="">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <a href="">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <!-- About -->
            <div class="col-md-6 col-lg-4">
                <h5 class="mb-3">About HealQuick</h5>
                <p>
                    HealQuick offers a wide range of home healthcare services including blood draws, injections,
                    oxygen therapy, and physical therapy. We deliver compassionate, professional care right to your door.
                </p>
            </div>

            <!-- Navigation Links -->
            <div class="col-md-6 col-lg-2">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="">
                    <li><a href="index.html" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="about.html" class="text-white text-decoration-none">About</a></li>
                    <li><a href="departments.html" class="text-white text-decoration-none">Organizations</a></li>
                    <li><a href="doctors.html" class="text-white text-decoration-none">Doctors</a></li>
                    <li><a href="contact.html" class="text-white text-decoration-none">Contact Us</a></li>
                </ul>
            </div>
        </div>

        <!-- Footer bottom -->
        <div class="text-center mt-4 border-top pt-3 small">
            <p class="mb-0">
                &copy; <span id="displayYear"></span> All Rights Reserved by
                <a href="https://html.design/" class="text-white fw-bold text-decoration-underline">Sondos Al Jalowdi</a>
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
</body>

</html>
