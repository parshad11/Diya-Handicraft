<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') || {{$site->site_title}} </title>
    @yield('og')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

    <!-- include summernote css/js -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300i,400,400i,500,500i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/app.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/sweetalert.css') }}">
    @stack('styles')
</head>
<body>


<header class="site-header">
    <div class="container-fluid main-heading">
        <div class="headerTop main-header fullwidth">
            <div class=" row">
                <div class="col-md-3">
                    <div class="logo-img">
                        <h3 class="logo-img-txt">
                            <a href="{{url('/')}}"><img src="{{asset('storage/setting/logo/'.$site->logo)}}" alt=""></a>
                        </h3>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="contact-head">
                        <div class="row check-head">
                            <div class="col-md-6 head-contact">
                                <ul class="check-content floatleft">
                                    <li class="first">
                                        <i class=" fas fa-phone"></i>Call Us-
                                        <a href="tel:{{$site->site_phone}}">{{$site->site_phone}}</a>
                                    </li>
                                    <li class="first">
                                        Connect With Us-
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-facebook"></i></a>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-ms-12 users-link ">
                                <ul class=" user-link ">
                                    @if(!Auth::check())
                                    <li class="myaccountnav">
                                        <div class="account-img">
                                            <i class="fas fa-user"></i>
                                        </div>

                                        <a href="{{url('/register')}}" id="LoginBtn" class="">
                                            <i class=""></i>LOGIN/
                                            REGISTER</a>

                                    </li>
                                    @else
                                    <li class="myaccountnav">
                                        <div class="account-img">
                                            <i class="fas fa-user"></i>
                                        </div>
                                            <i class=""></i>WELCOME,
                                            {{ Str::upper(auth()->user()->name) }}

                                    </li>
                                    <li class="myaccountnav">
                                        <div class="account-img">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </div>

                                        <a href="{{url('/user/logout')}}" id="LoginBtn" class="">
                                            <i class=""></i>LOGOUT</a>

                                    </li>
                                    @endif
                                    <li class="myaccountnav">
                                        <div class="account-img">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                        <a href="#">WISHLIST</a>
                                    </li>
                                    <li class="myaccountnav">
                                        <div class="account-img">
                                            <i class="fab fa-first-order-alt"></i>
                                        </div>

                                        <a href="#">TRACK ORDER</a>

                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12">
                                <ul class="fullwidth search-cart">
                                    <li class="searchToggle fleft spiritImg"></li>
                                    <li class="seacrh-warp floatleft">
                                        <div class="searchDiv">
                                            <form id="sastodeal_search" name="sastodeal_search" method="get"
                                                  action="{{route('searchinput')}}">
                                                <div class="inputField">
                                                    <i class=" search fas fa-search"></i>
                                                    <input type="text" class="typeahead form-control"
                                                           placeholder="Find Products,Categories...." id="searchkey"
                                                           name="q" value="">
                                                    <div id="searchResultDiv"></div>
                                                </div>
                                                <input type="submit" value="SEARCH">
                                            </form>

                                        </div>
                                    </li>
                                    <li id="cartCountTiles">
                                        <div class="cartdiv shopcartlink" id="cartCount">
                                            <a class="cart-icon spiritImg" href="{{url('/cart')}}">
                                                <span>{{count((array)session()->get('carts'))}}</span>
                                                <i class=" fas fa-cart-plus"></i></a>
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
</header>


<div class="container-fluid site-header-responsive">
    <div class=" row header-responsive">
        <div class="col-sm-3 link">
            <div class="responsive-menu">
                <a href="" class="bar-menu" id="barMenu"><i class="fas fa-bars"></i></a>
                <div class="logo-images">
                    <a href="#" class="logo floatleft">
                        <img src="{{asset('storage/setting/logo/'.$site->logo)}}" alt="">
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
                        <a href=""><i class="fas fa-user"></i></a>

                    </div>
                </li>
                <li class="myaccount">
                    <div class="account-img">
                        <a href=""><i class="fas fa-heart"></i>
                        </a></div>
                </li>
                <li class="myaccount">
                    <div class="account-img">
                        <a href=""> <i class="fab fa-first-order-alt"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="megasections">
    <div class="megasections-content">
        <div class="megasections-menu desktop-megamenu">
            <ul>
                @php
                    $categories = \App\Models\Category::where([['status',1],['feature',1]])->get();
                @endphp
                @foreach($categories as $key => $category)
                    <li>
                        @if($category->parent_id === 0)
                            <a href=""><span>{{$category->title}} <i
                                            class=@if($category->child != 0)"fas fa-angle-down"@endif></i></span></a>
                            @php
                                $subNav = \App\Models\Category::where([['status',1],['parent_id',$category->id]])->get();
                            @endphp
                            <ul>`
						@if(count($subNav) > 0)
                                @foreach($subNav as $key => $sub)
										@if(count($sub->products) > 0)
                                    <li class="level1 parent">
                                        <a href="{{ url('category/'.$sub->id) }}"><span>{{$sub->title}}</span></a>
                                        @if($sub->child == 0)
                                            <ul class="level1 submenu">
												
                                                @foreach($sub->products as $key => $product)
                                                    <li class="level2 ">
                                                        <a href="{{url('shop-item/'.$product->slug)}}"><span>{{$product->title}}</span></a>
                                                    </li>
                                                @endforeach
												                                            </ul>
                                        @endif
                                    </li>
								 @endif
                                @endforeach
								@endif
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
      
    </div>
</div>


@yield('content')
<footer class="footer-section">
    <div class="container-fluid">
        <div class="footer-wrapper">
            <div class="row">
                @php
                    $pages = App\Models\Pages::where('display',1)->where('parent_id',0)->get();

                @endphp
                @foreach($pages as $page)
                <div class="col-md-2 ">
                    <div class="footer-menu-heading">
                        <h2>{{$page->title}}</h2>
                    </div>
                    <div class="footer-menu">
                        <ul class="expandible">
                            @php
                                $childs = App\Models\Pages::where('parent_id',$page->id)->get();
                            @endphp
                            @foreach($childs as $child )
                                <li><a href="{{$child->links}}">{{$child->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
                <div class="col-md-4 email-search">
                    <div class="footer-menu-heading">
                        <h2>Sign Up Our Newsletter</h2>
                    </div>
                    <div class="footer-menu">
                        <ul class="expandible">
                            <li><a href="">No junk. Just exclusive offer and <p>latest trends</p></a></li>
                            <li class="seacrh-warp">
                                <div class="searchDiv footerEmail">
                                    <form id="sastodeal_search" name="sastodeal_search"
                                          action="#">
                                        <div class="inputField inputEmail">
                                            <input type="text" autocomplete="off" placeholder="Enter your email here.."
                                                   id="searchkey" name="q" value="" class="placeholder">
                                            <div id="searchResultDiv"></div>
                                        </div>
                                        <div class="submit">
                                            <input type="submit" value="Submit">
                                        </div>
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-menu-heading1">
                        <h2>Contact With </h2>
                        <p>Us</p>
                    </div>
                    <div class="footer-menu1">
                        <a href="#" class="social-icon">
                            <i class=" icons fab fa-facebook"></i></a>
                        <a href="#" class="social-icon">
                            <i class=" icons fab fa-instagram"></i></a>
                    </div>
                </div>

            </div>

            <div>
            </div>
            <div class="container-fluid">
                <div class="footer-wrapper">
                    <div class="row footer-bottom">
                        <div class="col-md-12">
                            <ul class="footer-cout ">
                                <div class="footer-img">
                                    <li>
                                    </li>
                                </div>
                                <div class="footer-heading">
                                   <p>{!! $site->about !!}</p>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="{{asset('frontend/js/app.min.js')}}"></script>
<script src="{{ asset('frontend/js/sweetalert2.js') }}"></script>


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


@if (session('success_status'))
    <div data-notify="container"
         class="col-11 col-md-5 alert alert-success alert-with-icon animated fadeInDown alert-message"
         style="display: none; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 70px; right: 20px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
        <p data-notify="title">
            <i data-notify="icon" class="fa fa-bell"></i>
            {{ session('success_status') }}
        </p>

        <a href="#" target="_blank" data-notify="url"></a>
    </div>
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

@if(session('error') || session('success_status'))

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
        }, 3000);
    </script>
@endif
{{--Cart Section--}}
<script>
    function addToCart(arg) {
        productId = arg;
        quantity = $('#quantity').val() ? $('$quantity').val() : 1;
        $.ajax({
            url: '{{'/add-to-cart'}}',
            method: 'POST',
            data: {
                '_token': '{{csrf_token()}}',
                id: productId,
                quantity: quantity,
            },
            success: function (response) {
                console.log("success");
                console.log("response " + response);

                var obj = jQuery.parseJSON(response);

                if (obj.status == 'success') {
                    var totalQty = obj.totalQty;

                    if (totalQty == 0) {
                        window.top.location.reload();
                    } else {

                        $('#cartCount').load(location.href + ' #cartCount>*');
                        $('#cartQuickView').load(location.href + ' #cartQuickView>*');
                        $('#cartTable').load(document.URL + ' #cartTable>*');

                        swal({
                            title: 'Added!',
                            buttonsStyling: false,
                            confirmButtonClass: "btn btn-sm btn-success",
                            html: '<b>Product Added To Cart Successfully!</b>',
                            timer: 2000,
                            type: "success"
                        }).catch(swal.noop);

                    }
                }
            }
        });
    }

    function deleteCart(cart_id) {
        if (confirm('Are You Sure You Want To Remove This Product From Your Cart !!')) {
            $.ajax({
                url: "{{ url('delete_cart_item') }}",
                type: "POST",
                data: {
                    '_token': '{{ csrf_token() }}',
                    action: 'delete',
                    id: cart_id
                },
                success: function (response) {
                    console.log("success");
                    console.log("response " + response);

                    var obj = jQuery.parseJSON(response);

                    if (obj.status == 'deleted') {
                        var totalQty = obj.totalQty;

                        if (totalQty == 0) {
                            window.top.location.reload();
                        } else {
                            $('#cartQuickView').load(document.URL + ' #cartQuickView>*');
                            $('#cartTable').load(location.href + ' #cartTable>*');
                            $('#orderSummary').load(location.href + ' #orderSummary>*');

                            swal({
                                title: 'Removed!',
                                buttonsStyling: false,
                                confirmButtonClass: "btn btn-sm btn-success",
                                html: '<b>Product Removed From Cart Successfully!</b>',
                                timer: 2000,
                                type: "success"
                            }).catch(swal.noop);

                        }
                    }

                }
            });
        }
    }

    function updateCart(cart, quantity) {
        orderedQuantity = quantity.value;
        let product_id = cart;

        $.ajax({
            url: "{{url('update_cart')}}",
            method: "POST",
            data: {
                '_token': '{{ csrf_token() }}',
                updatedQuantity: orderedQuantity,
                product_id: product_id,
            },
            success: function (response) {
                var obj = jQuery.parseJSON(response);
                if (obj.status == 'success') {
                    $('#cartTable' + product_id).load(location.href + ' #cartTable' + product_id + '>*');
                    $('#orderSummary').load(location.href + ' #orderSummary>*');
                    swal({
                        title: 'Updated!',
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-sm btn-success",
                        html: '<b>Product Quantity Updated  Successfully!</b>',
                        timer: 2000,
                        type: "success"
                    }).catch(swal.noop);
                    // sweetAlert('Success!', 'Product Added Successfully', 'success');

                }
            }

        });
    }
</script>
@stack('scripts')
</body>
</html>

