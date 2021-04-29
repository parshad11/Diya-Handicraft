@extends('frontend.includes.app')
@section('title','About')
@section('og')

@endsection
@section('content')
<div class="container-fluid site-header-responsive">
    <div class=" row header-responsive">
        <div class="col-sm-3 link">
            <div class="responsive-menu">
                <a href="" class="bar-menu" id="barMenu"><i class="fas fa-bars"></i></a>
                    <div class="logo-images">
                        <a href="#" class="logo floatleft">


                            <img src="{{asset('frontend/images/logo.png')}}" alt="">
                        </a>

                    </div>
            </div>
        </div>
        <div class="col-sm-9 links">
            <ul class=" user-links">
                <li class="myaccountnav">
                    <div class="account-img">

                <a href=""><i class=" search fas fa-search"></i></a>
                </div>
                </li>
                <li class="myaccountnav">
                    <div class="account-img">
                        <a href=""><i class=" fas fa-cart-plus"></i></a>

                            </div>
                        </li>

                            <li class="myaccountnav">
                                <div class="account-img">
                                    <a href="register.html"><i class="fas fa-user"></i></a>

                                        </div>
                                    </li>
                                <li class="myaccount">
                                    <div class="account-img">
                                    <a href="login.html"><i class="fas fa-heart"></i>
                                    </a></div>
                                </li>
                                <li class="myaccount">
                                    <div class="account-img">
                                    <a href="track.html"> <i class="fab fa-first-order-alt"></i></a>
                                    </div>
                                </li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="bx-wrapper">
<div class="container-fluid  padding-section">

  <div class="work-slidebar">
<div class="work-slidebar-box">
    <div class="owl-slider">
      <div id="carousel" class="owl-carousel fullwidth-banner">


        <div class="work-slidebar-boxs">
          <img class="work-slidebar-boxs-pic"
            src="{{asset('frontend/images/banner1.png')}}">

        </div>


        <div class="work-slidebar-boxs">
          <img class="work-slidebar-boxs-pic"
            src="{{asset('frontend/images/banner2.png')}}">
        </div>


      </div>

    </div>
  </div>

</div>

</div>
</div>


<section class="aboutus-container">
<div class="innerpage container ">
<div class="innerpage-title">About us</div>
<div class="innerpage-content">
    <p>
        With an intent to create a disruptive sourcing marketplace Infra Bazaar was ideated. Our aim was to bridge the
        gaps in Infrastructure domain. Having understood the challenges in sourcing and delivery we came up with our Innovative
        Digital and Mobile Platform. We have created this platform to educate and create a marketplace/exchange for the infrastructure industry.
        The idea is to actively engage both domestic and international suppliers and purchasers with value propositions.
    </p>
</div>
<hr class="hr-style">
</div>
<div class="container">
<div class="row bg-titles">
    <div class="col-md-3 col-sm-6">
        <div class="bg-title">
            <div class="bg-title-icon">
                <i class=" fas fa-cart-plus"></i>

            </div>
            <h2>22M+</h2>
            <h3>Product</h3>

        </div>
    </div>
     <div class="col-md-3 col-sm-6">
      <div class="bg-title">
            <div class="bg-title-icon">
             <i class="fas fa-user"></i>

            </div>
            <h2>10M+</h2>
            <h3>Monthly Users</h3>
        </div>
    </div>
     <div class="col-md-3 col-sm-6">
      <div class="bg-title">
            <div class="bg-title-icon">
                <i class="fas fa-star"></i>
            </div>
            <h2>2,000</h2>
            <h3>Brand</h3>

        </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="bg-title">
            <div class="bg-title-icon">
                <i class="fas fa-cube"></i>
              </div>
            <h2>2M+</h2>
            <h3>Package delivered monthly</h3>
        </div>
    </div>
</div>
<div class="row our-mission">
<div class="col-md-5 col-sm-6">
    <div class="our-mission-h">
        <p class="pull-right">Our Mission</p>
    </div>
</div>
<div class="col-md-7 col-sm-6">
<div class="vl-border">
<p>"Make it easy to do business anywhere in the era of digital economy”</p>
</div>
</div>
</div>
</section>

    @endsection
