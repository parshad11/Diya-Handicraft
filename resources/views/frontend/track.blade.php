@extends('frontend.includes.app')
@section('title','Track')
@section('content')
<nav aria-label="breadcrumb " class="bcrumb">
    <ol class="breadcrumb bcrumb-ol">
        <li class="breadcrumb-item bcrumb-ol-li"><a href="#">Home</a></li>
        <li class="breadcrumb-item bcrumb-ol-li"><a href="#">Mens</a></li>
        <li class="breadcrumb-item  active" aria-current="page">GRAVIATE By Coolwinks E12C6693 Glossy Black Full Frame Oval Eyeglasses For Women</li>
    </ol>
</nav>


<section class="track-body">
<div class="container">
    <div class="track-heading">
        <a href="index.njk" class=""><span class="track-home">Home</span></a>
    <i class="fas fa-angle-double-right"></i>
    <span>Track Order</span>
    </div>
    <div class="orderstatus">
    <div class="order-track">
        <div class="order-icon">
        <i class="fa fa-truck" aria-hidden="true"></i>

        </div>
        </div>
        <div class="order-track">
       <div class="track-progress">
       <h6>Track the progress of your order right here!</h6>
       </div>
       <div class="form-inner">
            <label class="form-lable">Enter your Order ID below</label><br>
            <input type="text" placeholder="ORDERID" name="Name"  id="" class="login-input-style" required>  
            <label class="form-lable">Enter your Mobile No</label><br>
            <input type="text" placeholder="" name="Name"  id="" class="login-input-style" required>
             <button type="button" class="track-btn ">TRACK NOW</button>

        </div>

    </div>
    

</div>
</section>
    @endsection