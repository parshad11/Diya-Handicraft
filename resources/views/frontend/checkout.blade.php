@extends('frontend.includes.app')
@section('title','Checkout')
@section('content')
    <nav aria-label="breadcrumb " class="bcrumb">
        <ol class="breadcrumb bcrumb-ol">
            <li class="breadcrumb-item bcrumb-ol-li"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item bcrumb-ol-li"><a href="{{url('/checkout')}}">Checkout</a></li>
        </ol>
    </nav>
    <div class="container reglog">
        <div class="row">
            <div class=" col-lg-6">
                <div class="loginpage">
                    <div class="row ">
                        <div class="col-md-6 col-sm-12">
                            <div class="loginpage-heading">
                                <h1> Shipping Details</h1>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="register-inners">
                    <form action="{{route('checkout.details')}}" method="post">
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
                                    <label class="form-label"><span class="red-text">*</span>Delivery Address</label><br>
                                    <input type="text" placeholder="" name="address" id="login-label"
                                    class="login-input-style" required> <br>
                                </div>
                            </div>
                            <div class="col-md-6  col-lg-6 col-sm-12 login-form">

                                <div class="form-inner">
                                    <label class="form-label"><span class="red-text">*</span>E-mail ID</label><br>
                                    <input type="text" placeholder="Email" name="email" id="login-label"
                                           class="login-input-style" required> <br>
                                    <label class="form-label"><span class="red-text">*</span>ZIP
                                        CODE</label><br>
                                    <input type="text" placeholder="98xxxxx" name="phone_2" id="login-label"
                                           class="login-input-style" required> <br>
                                    <label class="form-label">Payment Method</label><br>
                                    <div class="reg-gender-button">
                                        <input type="radio" id="male" name="payment_method" value="paypal" class="checkbox-input">
                                        <label for="male" class="checkbox-label">Paypal</label>
                                        <input type="radio" id="female" name="payment_method" value="cash delivery"
                                               class="checkbox-input">
                                        <label for="female" class="checkbox-label">Cash on Delivery</label><br>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="register-btn ">PROCEED</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class=" col-lg-6">
                <div class="loginpage">
                    <div class="row ">
                        <div class="col-md-6 col-sm-12">
                            <div class="loginpage-heading">
                                <h1> Order Details</h1>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="register-inners">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 register-inner">
                                <div class="form-inner">
                                    @if(isset($carts))
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                $total = 0;
                                                $quantity=0;
                                            ?>
                                            @foreach($carts as $key => $value)
                                            <tr>
                                                <td>{{ $value['product_title'] }}</td>
                                                <td>{{ $quantity+=$value['quantity'] }}</td>
                                                <td>Rs. {{ $total+=$value['sub_total'] }}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>
                                                    <h5>Sub- Total</h5>
                                                </td>
                                                <td>{{ $quantity }}</td>
                                                <td>Rs. {{ $total }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
