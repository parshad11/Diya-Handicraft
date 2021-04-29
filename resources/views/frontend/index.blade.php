    @extends('frontend.includes.app')
    @section('title','Home')
    @section('content')

        <div class="bx-wrapper">
            <div class="container-fluid  padding-section">

                <div class="work-slidebar">
                    <div class="work-slidebar-box">
                        <div class="owl-slider">
                            <div id="carousel" class="owl-carousel fullwidth-banner">
                                @foreach($banners as $key => $banner)
                                    @if($banner->type === 'vertical' && $banner->position === 'top')
                                        <div class="work-slidebar-boxs">
                                            <img class="work-slidebar-boxs-pic"
                                                src="{{asset('storage/banners/images/'.$banner->type.'_'.$banner->image)}}">

                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        @foreach($featured as $key => $category)
            <div class="container products">

            <ul class="nav nav-pills">

                    <li class="nav-item ">
                        <a href="#{{$category->slug}}" class="<?php if ($loop->index == "0") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link";
                        }?>" data-toggle="tab">
                            <h3 class="products-title">{{$category->title}}</h3>
                        </a>
                    </li>


            </ul>

            <div class="tab-content clearfix">
                        <div class="tab-pane active" id="">
                            <div class="products">
                                <div class="row">
                              @foreach($category->products as $product)
                                 <div class="col-md-4">
                                    <a href="{{url('shop-item',$product->slug)}}">
                                        <div class="products-card">
                                            <img
                                                src="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}"
                                                alt="" class="products-card-img">

                                            <div class="products-card-details item">
                                                @if($product->unit)
                                                    <h3 class="products-card-details-title">{{$product->title.'('.$product->unit.')'}}</h3>
                                                @else
                                                    <h3 class="products-card-details-title">{{$product->title}}</h3>
                                                @endif
                                                <div class="products-card-details-price">
                                                    @if($product->discount_price != '')
                                                        <span class="products-card-details-price-item price-current"> <em
                                                                class="rupeeSymbol">रू {{$product->getPrice()}}</em></span>
                                                    @endif
                                                    <span class="products-card-details-price-item price-before"> <em
                                                            class="rupeeSymbol">रू</em> {{$product->price}}</span>
                                                </div>
                                                @if($product->discount_price != '')
                                                    <span class="products-card-details-price-item price-disPercent">(Save {{$product->discount()}} % )</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>

                        @endforeach
                    </div>
                         </div>
                            </div>
                        </div>



            </div>

        </div>
        @endforeach


        <div class="bx-wrapper">
            <div class="container-fluid">
                <div class="work-slidebar">
                    <div class="work-slidebar-box">
                        <div class="owl-slider">
                            <div class="owl-carousel fullwidth-banner">
                                @foreach($banners as $ban => $bottomBanner)
                                    @if($bottomBanner->position == 'bottom' &&  $bottomBanner->type == 'vertical')
                                        <div class="work-slidebar-boxs">
                                            <a href="{{ isset($bottomBanner->url) ? $bottomBanner->url : null }}">
                                                <img
                                                    class="work-slidebar-boxs-pic"
                                                    src="{{asset('storage/banners/images/'.$bottomBanner->type.'_'.$bottomBanner->image)}}"></a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
