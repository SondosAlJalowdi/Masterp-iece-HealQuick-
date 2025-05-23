<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset(path: 'images/favicon.png') }}" type="image/png">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications -->
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />

    <!-- Light Bootstrap Dashboard core CSS -->
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet" />

    <!-- CSS for Demo Purpose -->
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />

    <!-- Fonts and icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
</head>
<style>

</style>

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="mycolor" data-image="{{ asset('assets/img/sidebar6.jpg') }}">

            <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="http://www.creative-tim.com" class="simple-text">
                        <img src="{{ asset('images/favicon.png') }}" alt="" width="20px" height="20px">
                        HealQuick
                    </a>
                </div>

                <ul class="nav">
                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="pe-7s-user"></i>
                            <p>Users </p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('organizations.index') ? 'active' : '' }}">
                        <a href="{{ route('organizations.index') }}">
                            <i class="fa-solid fa-building"></i>
                            <p>Organizations</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('bookings.index') ? 'active' : '' }}">
                        <a href="{{ route('bookings.index') }}">
                            <i class="fa fa-calendar-check-o fa-3x"></i>
                            <p>Bookings</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('admin-reviews.index') ? 'active' : '' }}">
                        <a href="{{ route('admin-reviews.index') }}">
                            <i class="fa fa-star fa-3x"></i>
                            <p>Reviews</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('contacts.index') ? 'active' : '' }}">
                        <a href="{{ route('contacts.index') }}">
                            <i class="fa fa-envelope fa-3x"></i>
                            <p>Contacts</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        {{-- <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-lg hidden-md"></b>
                                    <p class="hidden-lg hidden-md">
                                        5 Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-search"></i>
                                    <p class="hidden-lg hidden-md">Search</p>
                                </a>
                            </li>
                        </ul> --}}

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{ route('admin.profile') }}">
                                    <p> <i class="fa fa-user"></i> My Profile</p>
                                </a>
                            </li>
                            {{-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        Dropdown
                                        <b class="caret"></b>
                                    </p>

                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li> --}}
                            <li>
                                <a href="{{ route('logout') }}">
                                    <p>Log out</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>
    </div>


</body>

<!-- Core JS Files -->
<script src="{{ asset('assets/js/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Charts Plugin -->
<script src="{{ asset('assets/js/chartist.min.js') }}"></script>

<!-- Notifications Plugin -->
<script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>

<!-- Google Maps Plugin -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Dashboard Core -->
<script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>

<!-- Demo Scripts (Remove in production) -->
<script src="{{ asset('assets/js/demo.js') }}"></script>

<!-- CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Optional External Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/5ab58071a0.js" crossorigin="anonymous"></script>


</html>
