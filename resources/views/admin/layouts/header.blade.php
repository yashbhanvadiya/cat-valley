@section('title', 'Dashboard')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Clarity Valley - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <link href="{{ URL::to('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />
    @yield('css')
    <link rel="stylesheet" href="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css')}}">
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ URL::to('/')}}">
              <img src="{{ asset('img/logo.png')}}" alt="logo">
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <li class="menu-item {{Request::segment(2) === 'dashboard' ? 'active' : ''}}">
              <a class="menu-link" href="{{ route('/dashboard') }}">Dashboard</a>
            </li>

            <li class="menu-item {{Request::segment(2) === 'users' ? 'active' : ''}}">
              <a class="menu-link" href="{{ route('users') }}">Users</a>
            </li>

            <li class="menu-item {{Request::segment(2) === 'category' ? 'active' : ''}}">
              <a class="menu-link" href="{{ route('category') }}">Category</a>
            </li>
            
            <li class="menu-item {{Request::segment(2) === 'sub-category' ? 'active' : ''}}">
              <a class="menu-link" href="{{ route('sub-category') }}">Sub Category</a>
            </li>

            <li class="menu-item {{Request::segment(2) === 'media' ? 'active' : ''}}">
              <a class="menu-link" href="{{ route('media') }}">Media</a>
            </li>

            <li class="menu-item {{Request::segment(2) === 'quiz' ? 'active' : ''}}">
              <a class="menu-link" href="{{ route('quiz') }}">Quiz</a>
            </li>

            <li class="menu-item {{Request::segment(2) === 'quote' ? 'active' : ''}}">
              <a class="menu-link" href="{{ route('quote') }}">Quote</a>
            </li>

            @if(in_array(Auth::user()->role, [1]))
              <li class="menu-item {{Request::segment(2) === 'site-bg' ? 'active' : ''}}">
                <a class="menu-link" href="{{ route('site-bg') }}">Site Background</a>
              </li>
            @endif

            <li class="menu-item {{Request::segment(2) === 'trainer' ? 'active' : ''}}">
              <a class="menu-link" href="{{ route('trainer') }}">Trainer</a>
            </li>

            <li class="menu-item {{Request::segment(2) === 'subscription' ? 'active' : ''}}">
              <a class="menu-link" href="{{ route('subscription') }}">Subscription</a>
            </li>

            {{-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Layouts</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="layouts-without-menu.html" class="menu-link">
                    <div data-i18n="Without menu">Without menu</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-without-navbar.html" class="menu-link">
                    <div data-i18n="Without navbar">Without navbar</div>
                  </a>
                </li>
              </ul>
            </li> --}}
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              {{-- <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search --> --}}

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset('/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">
                              @switch(Auth::user()->role)
                                  @case(1)
                                      <span>Admin</span>
                                      @break
                                  @default
                                      <span></span>
                              @endswitch
                            </small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    {{-- <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li> --}}
                      <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                      {{-- <form id="logout-form" action="{{ url('logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="ti-power-off text-primary"></i>Logout</button>
                      </form> --}}
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
