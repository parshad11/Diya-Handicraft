
@extends('frontend.includes.app')
@section('title','Category')
@section('content')
@section('og')
<meta property="og:title" content="@if(isset($category)) {{$category->title}} @else 'Category' @endif" />
<meta property="og:type" content="video.movie" />
<meta property="og:url" content="@if(isset($category)) {{URL::current() }}@endif" />
<meta property="og:image" content="@if(isset($category)) {{asset('storage/categories/'.$category->image)}} @else https://ia.media-imdb.com/images/rock.jpg @endif" />
@endsection
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-lg-2 col-sm-12">
            <div class="aside"> 
                <div class="fact-wrapper">
                    <div class="facet-category-title">Show Results For</div>
                </div>
                <div class="categories">

                    <div class="categories">
                        <div class="categorie">
                            <h1>CATEGORIES</h1>
                        </div>
                        @foreach($categories as $key=> $category)

                            <div class="categories-menus">
                                <div class="categories-menu">
                                    <a href="javascript:void(0)" class="fact-item active">
                                        @if($category->parent_id === 0)
                                            <span class="fact-name">
                        <i class="fa fa-angle-right"></i>
                            {{$category->title}}
                        </span>
                                    </a>
                                    @endif

                                    @php
                                        $subNav = \App\Models\Category::where([['status',1],['parent_id',$category->id]])->get();
                                    @endphp
                                    @foreach($subNav as $key => $sub)
                                        <div class="categories-menu1">
                                            <a href="{{ url('category/'.$sub->id) }}" class="fact-item active">
                        <span class="fact-name">
                        <i class="fa fa-angle-right"></i>
                      {{ $sub->title }}
                        </span>

                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        @endforeach
                    </div>
                    <div class="fact-wrapper">
                        <div class="categories">
                            <div class="categorie">
                                <h1>Location</h1>
                            </div>

                            <div class="brands">
                                <div class="facet-brands">
                                    <span class="facet-item custom-checkbox">

                                        <input type="checkbox" class="list--checkbox" value="Omni" id="omni">
                                        <label for="omni">Nepal</label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="categories">--}}
{{--                        <div class="categorie">--}}
{{--                            <h1>Prices</h1>--}}
{{--                        </div>--}}

{{--                        <div id="slider-range" data-price-min="230" data-price-max="1233"></div>--}}
{{--                        <p class="price-filters">--}}
{{--                            <label for="price-filter-min">Rs</label>--}}
{{--                            <input type="number" id="price-filter-min" placeholder=230--}}
{{--                                   aria-label="Minimum price for filtering products">--}}
{{--                            <label for="price-filter-max" aria-label="Maximum price for filtering products">Rs</label>--}}
{{--                            <input type="number" id="price-filter-max" placeholder=1233>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="fact-wrapper">--}}
{{--                        <div class="categories">--}}
{{--                            <div class="categorie">--}}
{{--                                <h1>BRANDS </h1>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="brands">--}}
{{--                            <div class="facet-item custom-checkbox">--}}
{{--                                <input type="checkbox" class="list--checkbox" id="omni1">--}}
{{--                                <label for="omni1">Omni</label>--}}
{{--                                <span class="facet-count">(4)</span>--}}
{{--                            </div>--}}
{{--                            <div class="facet-item custom-checkbox">--}}
{{--                                <input type="checkbox" class="list--checkbox" id="generic">--}}
{{--                                <label for="generic">Generic</label>--}}
{{--                                <span class="facet-count">(1)</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>


            </div>

        </div>
        <div class="col-md-10 col-lg-10 col-sm-12">

            <nav aria-label="breadcrumb " class="bcrumb">
                <ol class="breadcrumb bcrumb-ol">
                    <li class="breadcrumb-item bcrumb-ol-li"><a href="#">Home</a></li>
                    <li class="breadcrumb-item bcrumb-ol-li"><a href="#">{{$navtitle->title}}</a></li>

                </ol>
            </nav>

            <div class="result-wrapper">

                <div class="result-top">

                    <div class="result-topbar">
                        <div class="text-muted mb-2">
                            <span>{{$products->count()}} results founds</span>
                        </div>

                    </div>

                    <div class="categories-sortby">
                        <div class="sortby-title text-muted ">Sort By:</div>
                        <span class="sortby-select">
                                    <select name="" id="sorting" class="select-item">
                                            <option value="high_dis"> Highest Discount </option>
                                            <option value="low_price">Price Low to High </option>
                                            <option value="high_price">Price High to Low</option>
                                            <option value="new_product">New Product</option>
                                            <option value="old_product">Old Product</option>

                                    </select>
                                </span>
                    </div>

                </div>
                <div class="row" id="output">

                    @if($products->count()== 0)
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <strong>Sorry!</strong> There are no Products available at the moment.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    @foreach($products as $product)
                        <div class="col-md-3 col-ms-6">
                            <div class=" product-item active" ><a href="{{url('shop-item/'.$product->slug)}}">
                                    <div class="products-card products-cards">
                                        <img src="{{asset('storage/products/'.$product->slug.'/thumbs/small_'.$product->image)}}" alt="" class="products-card-img">

                                        <div class="products-card-details item">
                                            <h3 class="products-card-details-title">{{ $product->title }}</h3>
                                            <div class="products-card-details-price">

                                                <span class="products-card-details-price-item price-current"> <em
                                                        class="rupeeSymbol">रू</em>{{$product->discount_price}}</span>
                                                <span class="products-card-details-price-item price-before"> <em
                                                        class="rupeeSymbol">रू</em>{{$product->price}}</span>
                                            </div>
                                            <span class="products-card-details-price-item price-disPercent">(Save {{$product->discount()}}%)</span>

                                        </div>

                                    </div>
                                </a></div>
                        </div>
                        @endforeach
                        </section>

                        {{$products->links()}}

                        <div class="container">

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>



                </div>
                <div class="row" id="result">

                </div>

            </div>


        </div>
    </div>
</div>
</div>


@endsection
@push('scripts')
<script>
    $("#sorting").change(function() {
        // var selectedVal = $("#myselect option:selected").text();
        var selectedVal = $("#sorting option:selected").val();
        var product = {!! json_encode($products)!!}

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'get',
            url: "{{route('sorting')}}",
            data:{data:selectedVal,product:product['data']},
            success:function (response){

                $("#result").html(response.view);
                $("#output").hide();
            }

        });
    });

</script>
@endpush
