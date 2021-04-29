@extends('frontend.includes.app')
@section('title','Register/Login')
@section('content')

    <nav aria-label="breadcrumb " class="bcrumb">
        <ol class="breadcrumb bcrumb-ol">
            <li class="breadcrumb-item bcrumb-ol-li"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item bcrumb-ol-li"><a href="{{url('/login')}}">Login</a></li>
        </ol>
    </nav>
    <div class="container reglog">
        <div class="row">
            <div class=" col-lg-6">
                <div class="loginpage">
                    <div class="row ">
                        <div class="col-md-6 col-sm-12">
                            <div class="loginpage-heading">
                                <h1> Register</h1>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="register-inners">
                    <form action="{{url('/register')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12 register-inner">
                                <div class="form-inner">
                                    <label class="form-label"><span class="red-text">*</span>Name</label><br>
                                    <input type="text" placeholder="Name" name="name" id="login-label"
                                           class="login-input-style" required> <br>
                                    <label class="form-label"><span class="red-text">*</span>Mobile Number</label><br>
                                    <input type="text" placeholder="+977 98xxxxxxx" name="phone" id="login-label"
                                           class="login-input-style" required> <br>
                                    <label class="form-label"><span class="red-text">*</span>Password</label><br>
                                    <input type="password" placeholder="Password" name="password" id="password"
                                           class="login-input-style" required onkeyup="checkPassword()"> <br><br>
                                    <label class="form-label"><span class="red-text">*</span>Confirm
                                        Password</label><br>
                                    <input type="password" placeholder="Confirm Password" name="confirm_password"
                                           id="confirmPassword" onkeyup="checkPassword()"
                                           class="login-input-style" required> <br><br>

                                </div>
                            </div>
                            <div class="col-md-6  col-lg-6 col-sm-12 login-form">

                                <div class="form-inner">
                                    <label class="form-label"><span class="red-text">*</span>E-mail ID</label><br>
                                    <input type="text" placeholder="Email" name="email" id="login-label"
                                           class="login-input-style" required> <br>
                                    <label class="form-label"><span class="red-text">*</span>Alternate
                                        Number</label><br>
                                    <input type="text" placeholder="+977 98xxxxx" name="phone_2" id="login-label"
                                           class="login-input-style" required> <br>
                                    <label class="form-label">Gender</label><br>
                                    <div class="reg-gender-button">
                                        <input type="radio" id="male" name="gender" value="male" class="checkbox-input">
                                        <label for="male" class="checkbox-label">Male</label>
                                        <input type="radio" id="female" name="gender" value="female"
                                               class="checkbox-input">
                                        <label for="female" class="checkbox-label">Female</label><br>
                                    </div>
                                    <small class="float-right" style="color:green;" id="success"> Password Matched
                                    </small>
                                    <small style="color:red;" class="float-right" id="fail"> Password mis-matched
                                    </small>

                                </div>


                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="register-btn ">CREATE MY ACCOUNT</button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="rin col-lg-6">

                <div class="loginpage">
                    <div class="row ">
                        <div class="col-md-6 col-sm-12">
                            <div class="loginpage-heading">
                                <h1> Login</h1>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="login-inners">

                        <div class="row">

                            <div class="col-md-6 col-lg-6 col-sm-12 login-inner">
                                <form action="{{ url('/user/login') }}" method="post">
                                    @csrf
                                <div class="form-inner">
                                    <label class="form-label"><span class="red-text">*</span>E-mail ID</label><br>
                                    <input type="text" placeholder="Email" name="email" id="login-label"
                                           class="login-input-style" required> <br>
                                    <label class="form-label"><span class="red-text">*</span>Password</label><br>
                                    <input type="password" placeholder="Password" name="password" id="login-label"
                                           class="login-input-style" required> <br><br><br>

                                </div>

                                <div class="col-md-12 flogin">
                                    <div class="forget-password"><a href="">Forget Password</a></div>
                                    <button type="submit" class=" login-btn ">Login</button>

                                </div>
                            </form>
                            </div>


                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#success').hide();
        $('#fail').hide();
        var flag = 0;

        function checkPassword() {
            if ($('#password').val() != '' && $('#confirmPassword').val() != '') {

                if ($("#password").val() == $("#confirmPassword").val()) {
                    $("#fail").hide();
                    $("#success").show();
                    flag = 1;

                } else {
                    $("#fail").show();
                    $("#success").hide();
                    flag = 0

                }
            } else {

                flag = 0;

                $("#success").hide();
                $("#fail").hide();
            }

            if (flag == 1) {
                return 1;
            } else {
                return 0;
            }
        }
    </script>
@endpush