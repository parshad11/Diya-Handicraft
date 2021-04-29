<!doctype html>
<html lang="en">
<head>
    <title>{{isset($site->site_title) ? $site->site_title : null }} | Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description"
          content="Oculux Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
    <meta name="author" content="GetBootstrap, design by: puffintheme.com">
    @if(isset($site->site_title))
    <link rel="icon" href="{{asset('storage/setting/favicon/'.$site->site_title)}}" type="image/x-icon">
    @endif
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/animate-css/vivify.min.css')}}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('backend/html/assets/css/site.min.css')}}">

</head>
<body class="theme-cyan font-montserrat box_layout h-menu">

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

<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
            <a class="navbar-brand" href="javascript:void(0);"><img
                        src="{{asset('backend/assets/images/icon.svg')}}"
                        width="30"
                        height="30" class="d-inline-block align-top mr-2"
                        alt=""></a>
        </div>
        <div class="card">
            <div class="body">
                <p class="lead">Login to your account</p>
                <form class="form-auth-small m-t-20" action="{{route('login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">Email</label>
                        <input type="email" name="email" class="form-control round" id="signin-email"
                               value="user@domain.com"
                               placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input type="password" class="form-control round" id="signin-password"
                               value="thisisthepassword"
                               placeholder="Password" name="password">
                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox" name="rememberMe">
                            <span>Remember me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block">LOGIN</button>
                    <div class="bottom">
                            <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a
                                        href="page-forgot-password.html">Forgot password?</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>
<!-- END WRAPPER -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('backend/html/assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('backend/html/assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('backend/html/assets/bundles/mainscripts.bundle.js')}}"></script>


@if ($errors->any())
    @php $top = 0; @endphp

    @foreach ($errors->all() as $error)

        <div data-notify="container"
             class="col-11 col-md-4 alert alert-danger alert-with-icon animated fadeInDown error-alert-message vivify "
             role="alert" data-notify-position="bottom-right"
             style="display: none; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: {{$top}}px; right: 20px; font-size: 12px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            <i data-notify="icon" class="fa fa-bell"></i>
            <span data-notify="title"></span>
            <span data-notify="message">
                Sorry!! <br> {{ $error }}
            </span>
            <a href="#" target="_blank" data-notify="url"></a>
        </div>

        @php $top = $top + 90; @endphp
    @endforeach

    <script type="text/javascript">
        var $error_alert = $('.error-alert-message');

        var i = 0;
        setInterval(function () {
            $($error_alert[i]).show();
            $($error_alert[i]).addClass('fadeInRight');
            i++;
        }, 500);

        setTimeout(function () {
            $('.error-alert-message').addClass('fadeOutRight');
        }, $error_alert.length * ($error_alert.length == 1 ? 5000 : 2000));
    </script>

@endif

@if (session('error'))
    <div data-notify="container"
         class="col-11 col-md-5 alert alert-danger alert-with-icon animated fadeInDown alert-message"
         style="display: none; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 70px; right: 20px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
        <p data-notify="title">
            <i data-notify="icon" class="fa fa-bell"></i>
            {{ session('error') }}
        </p>

        <a href="#" target="_blank" data-notify="url"></a>
    </div>
@endif

@if(session('error'))

    <!-- alert message dismiss -->
    <script type="text/javascript">
        var $alert = $('.alert-message');
        $alert.hide();

        var i = 0;
        setInterval(function () {
            $($alert[i]).show();
            $($alert[i]).addClass('fadeInRight');
            i++;
        }, 500);

        setTimeout(function () {
            $('.alert-message').addClass('fadeOutRight');
        }, 2000);
    </script>
@endif

</body>
</html>
