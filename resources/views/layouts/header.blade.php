@section('title', 'Dashboard')
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Clarity Valley - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <link href="{{ URL::to('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap') }}" rel="stylesheet" />
    <link href="{{ URL::to('https://fonts.googleapis.com') }}" rel="preconnect">
    <link href="{{ URL::to('https://fonts.gstatic.com') }}" rel="preconnect" crossorigin>
    <link href="{{ URL::to('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,400&display=swap') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/fonts/boxicons.css') }}"  rel="stylesheet" />
    <link href="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('/vendor/css/bootstrap.min.css') }}" rel="stylesheet"  />
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet"  />
    @yield('css')
</head>

<body>
    <header role="banner">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid d-flex justify-content-between">
                <img src="{{ asset('/img/logo.png') }}" class="logo-main" alt="logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
                    aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarsExample05">
                    <ul class="navbar-nav pl-md-5">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="classes.html" id="dropdown04"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Classes</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="classes.html">Health Mind Meditation</a>
                                <a class="dropdown-item" href="classes.html">Mind Balance Yoga</a>
                                <a class="dropdown-item" href="classes.html">Body Strength Pilates</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.html">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

