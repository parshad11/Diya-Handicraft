
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
            <div class=" product-item active" ><a href="{{url('shop-item/'.$product['slug'])}}">
                    <div class="products-card products-cards">
                        <img src="{{asset('storage/products/'.$product['slug'].'/thumbs/small_'.$product['image'])}}" alt="" class="products-card-img">

                        <div class="products-card-details item">
                            <h3 class="products-card-details-title">{{ $product['title'] }}</h3>
                            <div class="products-card-details-price">

                                                <span class="products-card-details-price-item price-current"> <em
                                                        class="rupeeSymbol">रू</em>{{$product['price']}}</span>
                                <span class="products-card-details-price-item price-before"> <em
                                        class="rupeeSymbol">रू</em>{{$product['price']}}</span>
                            </div>
                            <span class="products-card-details-price-item price-disPercent">(Save 35%)</span>

                        </div>

                    </div>
                </a></div>
        </div>
        @endforeach
        </section>

{{--        {{$products->links()}}--}}

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


