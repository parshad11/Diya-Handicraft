
@extends('frontend.includes.app')
@section('title','Shop')
@section('content')


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




            <div class="result-wrapper">
{{--
                <div class="result-top">

                    <div class="result-topbar">
                        <div class="text-muted mb-2">
                            <span>4 results founds</span>
                        </div>
                        <div class="categories-value-list">

                            <a href="" class="categories-title-list">Omini
                                <span class="categories-value">4</span>
                            </a>
                            <a href="" class="categories-title-list">Kitchen Hood and Chimney
                                <span class="categories-value">4</span>
                            </a>


                        </div>
                    </div>


                    <div class="categories-sortby">
                        <div class="sortby-title text-muted ">Sort By:</div>
                        <span class="sortby-select">

                                    <select name="" class="select-item">
                                            <option value=""> Relevance </option>
                                            <option value=""> Highest Discount </option>
                                            <option value="">Price Low to High </option>
                                            <option value="">Price High to Low</option>

                                    </select>
                                </span>
                    </div>

                </div> --}}

    <div class="row">

                @php
                $cats = \App\Models\Category::where([['status',1]])->where("title", "LIKE", "%{$q}%")->get();
                @endphp
                 @if($products->count()==0 && $cats->count() == 0 )
                 <div class="col-md-12">
                    <div class="alert alert-info">
                        <strong>Sorry!</strong> There are no Products available at the moment.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif
                @foreach($cats as $key=>$cat)

                @php
                $prods = \App\Models\Product::where([['status',1]])->where("category_id",$cat->id)->get();
                @endphp


                @foreach($prods as $key=>$prod)
                <div class="col-md-3 col-ms-6">
                    <div class=" product-item active" ><a href="{{url('shop-item/'.$prod->slug)}}">
                      <div class="products-card products-cards">
                       <img src="{{asset('storage/products/'.$prod->slug.'/thumbs/small_'.$prod->image)}}" alt="" class="products-card-img">

                         <div class="products-card-details item">
                           <h3 class="products-card-details-title">{{ $prod->title }}</h3>
                            <div class="products-card-details-price">

                                  <span class="products-card-details-price-item price-current"> <em
                                              class="rupeeSymbol">रू</em>{{$prod->price}}</span>
                              <span class="products-card-details-price-item price-before"> <em
                                          class="rupeeSymbol">रू</em>{{$prod->price}}</span>
                          </div>
                          <span class="products-card-details-price-item price-disPercent">(Save 35%)</span>

                      </div>

                  </div>
              </a></div>
      </div>
                @endforeach
                @endforeach
                    @foreach($products as $key=>$product)
                    <div class="col-md-3 col-ms-6">
                        <div class=" product-item active" ><a href="{{url('shop-item/'.$product->slug)}}">
                                <div class="products-card products-cards">
                                    <img src="{{asset('storage/products/'.$product->slug.'/thumbs/small_'.$product->image)}}" alt="" class="products-card-img">

                                    <div class="products-card-details item">
                                    <h3 class="products-card-details-title">{{ $product->title }}</h3>
                                        <div class="products-card-details-price">

                                                <span class="products-card-details-price-item price-current"> <em
                                                            class="rupeeSymbol">रू</em>{{$product->price}}</span>
                                            <span class="products-card-details-price-item price-before"> <em
                                                        class="rupeeSymbol">रू</em>{{$product->price}}</span>
                                        </div>
                                        <span class="products-card-details-price-item price-disPercent">(Save 35%)</span>

                                    </div>

                                </div>
                            </a></div>
                    </div>
                   @endforeach
                    </section>














                    <div class="container">

   {{-- <div class="row">
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



                </div> --}}

            </div>


        </div>
    </div>
</div>
</div>

@endsection
