@extends('frontend.includes.app')
@section('title','Contact')
@section('content')

    <section class="contact-page my-3">
        <div class="container">

            <nav aria-label="breadcrumb " class="bcrumb">
                <ol class="breadcrumb bcrumb-ol">
                    <li class="breadcrumb-item bcrumb-ol-li"><a href="#">Home</a></li>
                    <li class="breadcrumb-item bcrumb-ol-li"><a href="#">Contact US</a></li>
                </ol>
            </nav>


            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <div class="contact-form mt-2">
                        <h3><strong>Message Us</strong></h3>
                        <form action="" method="post" class="contactus-container">
                            <div class="contactus-inner">
                                <input type="text" placeholder="Enter your name" name="name" id="contact-label"
                                       class="contact-input" required>
                            </div>
                            <div class="contactus-inner">
                                <input type="email" placeholder="Enter your email" name="email" id="contact-label"
                                       class="contact-input" required>
                            </div>
                            <div class="contactus-inner">
                                <input type="text" placeholder="Message Subject" name="subject" id="contact-label"
                                       class="contact-input" required>
                            </div>
                            <div class="contactus-inner">
                                <input type="text" placeholder="Phone Number" name="phone" id="contact-label"
                                       class="contact-input" required>
                            </div>
                            <div class="contactus-inner">
                                <textarea class="contact-message" name="msg" rows="5" placeholder="Message"></textarea>
                            </div>
                            <div class="contactus-inner">
                                <button type="button" class="contact-btn ">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="contact-form mt-2">
                        <h3><strong>Contact Address</strong></h3>
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3533.430392401309!2d85.34972601506134!3d27.673089682806285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sKoteshwor-35+narephant+Kathmandu%2C+Nepal+44600!5e0!3m2!1sne!2snp!4v1528451030783"
                                    width="100%" height="250" frameborder="0" style="border:0" allowfullscreen>
                            </iframe>
                        </div>
                        <div class="contact-info">
                            <p class="contact-info-list">{{$site->site_address}}</p>

                            <ul>
                                <li>Location: {{$site->site_address}}</li>
                                <li>Call us: {{$site->site_mobile}}</li>
                                <li>Email Us: {{$site->site->site_email}}</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection