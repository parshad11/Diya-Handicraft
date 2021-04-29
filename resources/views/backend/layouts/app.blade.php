<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $site->site_title }} || Admin Panel</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="icon" href="{{ asset('storage/setting/favicon/'.$site->favicon) }}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/animate-css/vivify.min.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('backend/html/assets/css/site.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/toastr.min.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}"/>

    <script
            src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
            crossorigin="anonymous"></script>
</head>
<body class="theme-cyan font-montserrat light_version">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>


<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<div id="wrapper">
    <nav class="navbar top-navbar">
        <div class="container-fluid">
            <div class="navbar-left">
                <div class="navbar-btn">
                    <a href="{{ url('@dashboard@') }}">{{ $site->site_title }}</a>
                    <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                </div>
            </div>
            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav text-muted">
                        <li><a title="Visit Site" data-toggle="tooltip" data-placement="top" class="icon-menu"
                               href="{{ url('@dashboard@') }}" target="_blank"><i
                                        class="icon-screen-desktop text-blue"></i> </a>
                        </li>&nbsp;|&nbsp;
                        <li><a title="Log Out" data-toggle="tooltip" data-placement="top" class="icon-menu"
                               id="nav-logout"><i
                                        class="icon-power text-red"></i></a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>

                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </nav>
    <div id="left-sidebar" class="sidebar">
        <div class="navbar-brand">
            <a href="{{ url('@dashboard@') }}"><img style="width: 30px;" src="{{ asset('storage/setting/favicon/'.$site->favicon) }}"
                                                    class="img-fluid logo"><span
                        style="font-size: 15px;">{{ Str::limit($site->site_title,20,'') }}</span></a>
            <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i
                        class="lnr lnr-menu icon-close"></i></button>
        </div>
        <div class="sidebar-scroll">
            <div class="user-account">
                <div class="user_div">
                    <img src="{{ asset('backend/assets/images/user.png') }}" style="border-radius: 50%;"
                         class="user-photo img-circle"
                         alt="User Profile Picture">
                </div>
                <div class="dropdown">
                    <span style="font-size: 10px;">Welcome,</span>
                    <a href="javascript:void(0);"
                       class=" user-name"><strong
                                style="font-size: 12px;">{{ Auth::user()->name }}</strong></a>
                </div>
                <hr>

            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="header">Main</li>
                    @php
                        $sidebars = Config::get('sidebar');
                    @endphp

                    @foreach($sidebars as $key => $sidebar)

                        <li>
                            @if($sidebar['route'])
                                <a href="{{route($sidebar['route'])}}">
                                    @else
                                        <a href="#">
                                            @endif
                                            <i class="{{$sidebar['icon']}}">
                                            </i>
                                            {{$sidebar['name']}}
                                        </a>
                                </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="#">
                            <i class="fa fa-file">
                            </i>
                            Reports
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('reports.inventory')}}">Inventory Reports</a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="{{route('reports.sales')}}">Sales Reports</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div id="main-content">
        @yield('content')
    </div>


</div>
<!-- Javascript -->
<!-- Scripts -->
<script src="{{ asset('backend/html/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/html/assets/bundles/vendorscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/html/assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/toastr.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

@if (session('status'))
    <script>
        $(function () {
            toastr.success("{{ session('status') }}");
        });
    </script>
@endif
@if (session('error'))
    <script>
        $(function () {
            toastr.error("{{ session('error') }}");
        });
    </script>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $key=>$error)
        <script>
            $(function () {
                toastr.error("{{ $error }}");
            });
        </script>
    @endforeach
@endif
<script>
    $("#nav-logout").click(function (e) {
        e.preventDefault()
        swal({
                title: "Are You Sure!",
                text: "Would you like to log out from the system?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
            },
            function (isConfirm) {
                if (isConfirm) {
                    document.getElementById('logout-form').submit();
                }
            })
    });
</script>
@stack('scripts')
</body>
</html>

