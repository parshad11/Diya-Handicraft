@extends('frontend.includes.app')
@section('title',$product->title)
@section('content')


    <div class="container productspage mt-3">

        <nav aria-label="breadcrumb " class="bcrumb">
            <ol class="breadcrumb bcrumb-ol">
                <li class="breadcrumb-item bcrumb-ol-li"><a href="#">Home</a></li>
                <li class="breadcrumb-item bcrumb-ol-li"><a href="#">{{$product->category->title}}</a></li>
                <li class="breadcrumb-item  active" aria-current="page">{{$product->title}}
                </li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-4 col-md-12 productspage-image">
                <img src="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}" alt=""></div>
            <div class="col-lg-5 col-md-8 col-sm-12 productspage-details">
                @if($product->unit)
                    <h3 class="productspage-title">{{$product->title.'('.$product->unit.')'}}</h3>
                @else
                    <h3 class="productspage-title">{{$product->title}}</h3>
                @endif
                <div class="productspage-reviewdiv">
                    <div class="productspage-reviewdiv-review">
                        <div class="productspage-reviewdiv-review-rating">
                            @php $rating = $product->overrallRating(); @endphp

                            @foreach(range(1,5) as $i)
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>

                                    @if($rating >0)
                                        @if($rating >0.5)
                                            <i class="fas fa-star fa-stack-1x"></i>
                                        @else
                                            <i class="fas fa-star-half fa-stack-1x"></i>
                                        @endif
                                    @endif
                                    @php $rating--; @endphp
                                </span>
                            @endforeach
                            {{-- @for($i=0; $i < $product->rate; $i++)
                                <i class="fas fa-star"></i>
                            @endfor --}}
                            <span>{{$product->comments ? $product->comments->count() : '0'}} Reviews</span>
                        </div>
                    </div>
                    <div class="productspage-reviewdiv-share">

                        <i class="fas fa-share-alt"></i>
                        <span>Share</span>
                    </div>
                </div>
                <div class="productspage-highlights col-md-12">
                    <form id="option-choice-form">
                        @csrf
                        <input type="hidden" name="id" value="{{base64_encode($product->id)}}">
                        <div class="pull-right float-right col-md-6">
                            @if ($product->choice_options != null)
                                @foreach (json_decode($product->choice_options) as $key => $choice)
                                    <div class="row no-gutters">
                                        <div>
                                            <div class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-3">
                                                @foreach ($choice->values as $key => $value)
                                                    <input type="radio" class="ml-1 attribute_id"
                                                           id="{{ $choice->attribute_id }}-{{ $value }}"
                                                           name="{{ $choice->attribute_id }}"
                                                           value="{{ $value }}" @if($key == 0) checked @endif>
                                                    <label class="form-check-label"
                                                           for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
                                                @endforeach
                                                    <input type="hidden" class="float-right" name="attribute[]" readonly value="{{$choice->attribute_id}}" />
                                                <span class="text-bold form-check-label ml-3">{{ \App\Models\Attribute::find($choice->attribute_id)->name }}
                                                    </span>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                        <h5>Description</h5>
                        <p>{!! $product->description !!}</p>
                        {{-- <a href="#details" class="productspage-highlights-viewall">View all item details</a> --}}
                        <h5>Excerpt Description</h5>
                        <p>{!! $product->excerpt_description !!}</p>
                        @if($product->quantity)
                            <h5>Quantity</h5>
                            <p>{{$product->quantity}}</p>
                        @endif
                        @if($product->color)
                            <h5>Color</h5>
                            <p>{{$product->color}}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 productspage-buy">

                <div class="productspage-buy-cart">
                    <div class="productspage-buy-cart-quantity">
                        <p> QUANTITY:</p>
                        <span class="products-page-buy-cart-quantity-add">
                            <button class="btn btn-number" type="button" data-type="plus" data-field="quantity"
                                    onclick="increment()">+</button>
                            <input id="quantity" class="input-number" type="number" value="1" name="quantity"
                                   max="{{$product->quantity}}" min="1">
                            <button class="btn btn-number" type="button" data-type="minus" data-field="quantity"
                                    onclick="decrement()">-</button>
                            <p>Quantity:{{$product->quantity}}</p>
                        </span>
                        </span>
                    </div>
                    </form>
                    <br>
                    <div class=" productspage-buy-cart-detail">
                        @if($product->getPrice())
                            <div class=" productspage-buy-cart-detail-price">
                                <h1>Rs {{$product->getPrice()}}</h1>
                            </div>
                        @endif
                        <div class=" productspage-buy-cart-detail-discount">
                            <span class="discount-prices"> Rs {{$product->price}}</span>
                            <span class="discount-offer">(save {{$product->discount()}}%)</span>
                        </div>
                    </div>
                    <div class="add-to-cart-btn productspage-buy-cart-btn ">
                        {{--  <button type="button" class="btn-cart ">BUY NOW</button>--}}
                        <button type="button" class="btn-cart1" onclick="addToCart('{{base64_encode($product->id)}}')">
                            ADD TO CART
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>

    @if($product->option > 0)
        <div class="container description" id="details">
            <ul class="nav nav-pills">
                <?php
                $additionalDescription = json_decode($product->option);

                ?>
                @foreach($additionalDescription->option_title as $key => $optional)
                    <li class="nav-item ">
                        <a href="option-{{$loop->index+1}}" class="nav-link{{$key+1  == 0 ? 'active' : ''}}"
                           data-toggle="tab">
                            <h3 class="products-title">{{$optional}}</h3>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content clearfix">
            @foreach($additionalDescription->option_value  as $key => $value)
                <div class="tab-pane {{$key+1 %2=== 0}} container detail-content" id="option-{{$loop->index+1}}">
                    <p>{!! $value !!}</p>
                </div>
            @endforeach
        </div>
    @endif
    <div class="container products">
        <ul class="nav nav-pills">
            <li class="nav-item ">
                <a href="#cat" class="nav-link active" data-toggle="tab">
                    <h3 class="products-title">Review</h3>
                </a>
            </li>

        </ul>
        <form action="{{url('review/create')}}" method="post">
            @csrf
            <div class="tab-content clearfix">
                @if(Auth::check())
                    <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">

                @endif
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <input type="number" data-role="rating" name="rating" min="0" max="5" data-value="5">
                <div class="tab-pane active" id="cat">
                    <textarea name="comments" placeholder="Write Something!!" class="form-control" id="" cols="15"
                              rows="5"></textarea>
                </div>

            </div>
            <br>
            <div class="col-md-2" style="float: right">
                <button type="submit" class="btn-cart1">
                    Comment
                </button>

            </div>
        </form>
    </div>

    <div class="container">
        <h2 class="text-center">All Comments</h2>
        @if(!$product->comments->isEmpty())
            <div class="card">
                <div class="card-body">
                    @foreach($product->comments as $key => $value)
                        <div class="row">
                            <div class="col-md-2">
                                <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                <p class="text-secondary text-center">{{$value->updated_at ? $value->updated_at->diffForhumans(): $value->created_at>diffForhumans()}}</p>
                            </div>
                            <div class="col-md-10">
                                <p>
                                    <a class="float-left" href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>{{$value->user ? $value->user->name : null }}</strong></a>
                                    @for($i = 0; $i < (5-$value->rating); $i++)
                                        <span class="float-right"><i class="text-warning far fa-star"></i></span>
                                    @endfor
                                    @for($i = 0; $i < $value->rating; $i++)
                                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                    @endfor


                                </p>
                                <div class="clearfix"></div>

                                <p>{{$value->comments}}</p>
                                <p>
                                    {{-- <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a> --}}
                                    <a href="{{url('/review/delete/'.$value->id)}}"
                                       class="float-right btn text-white btn-danger"> <i class="fa fa-trash"></i> Delete</a>
                                </p>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        @else
            <div class="alert alert-info text-center">
                <p>No Comments!!</p>
            </div>
        @endif

    </div>
    @foreach($singleProducts->take(2) as $key => $subCategory)
        @if($subCategory->parent_id != 0 && $subCategory->child === 0)
            <div class="container products">
                <ul class="nav nav-pills">
                    <li class="nav-item ">
                        <a href="#cat{{$loop->index+1}}" class="nav-link active" data-toggle="tab">
                            <h3 class="products-title">{{$subCategory->title}}</h3>
                        </a>
                    </li>
                </ul>
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="cat{{$loop->index+1}}">
                        <div class="products owl-carousel">
                            @foreach($subCategory->products as  $item)
                                <a href="{{url('shop-item',$item->slug)}}">
                                    <div class="products-card">
                                        <img src="{{asset('storage/products/'.$item->slug.'/thumbs/thumb_'.$item->image)}}"
                                             alt="" class="products-card-img">

                                        <div class="products-card-details item">
                                            <h3 class="products-card-details-title">{{$item->title}}</h3>
                                            <div class="products-card-details-price">
                                                @if($item->discount_price != '')
                                                    <span class="products-card-details-price-item price-current"> <em
                                                                class="rupeeSymbol">रू {{$item->getPrice()}}</em></span>
                                                @endif
                                                <span class="products-card-details-price-item price-before"> <em
                                                            class="rupeeSymbol">रू</em> {{$item->price}}</span>
                                            </div>
                                            @if($item->discount_price != '')
                                                <span class="products-card-details-price-item price-disPercent">(Save {{$item->discount()}}
                                                    %    )</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


@endsection

@push('scripts')
    <script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>
    <script>
        function increment() {
            document.getElementById('quantity').stepUp();
        }

        function decrement() {
            document.getElementById('quantity').stepDown();
        }


        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function () {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4.3.2/css/metro-all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked) > input {
            position: absolute;
            top: -9999px;
        }

        .rate:not(:checked) > label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked) > label:before {
            content: '★ ';
        }

        .rate > input:checked ~ label {
            color: #ffc700;
        }

        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }

        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }

        /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
    </style>

@endpush