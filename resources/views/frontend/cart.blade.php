@extends('frontend.includes.app')
@section('title','Cart')
@section('content')

    <section class="cartpages">
        <div class="container cartpage my-3">
            <nav aria-label="breadcrumb " class="bcrumb">
                <ol class="breadcrumb bcrumb-ol">
                    <li class="breadcrumb-item bcrumb-ol-li"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item bcrumb-ol-li"><a href="{{url()->current()}}">Cart</a></li>
                    <li class="breadcrumb-item  active" aria-current="page"> Products In Cart</li>
                </ol>
            </nav>

            <div class="cart-items">
                <a class="shopping-cart-item"></a>
                <h3>Shopping Cart <span>({{count($carts)}} Item)</span></h3>
            </div>

            <div class="row cart-table-page">
                <div class="col-md-8">
                    <form action="" method="post">
                        <table class=" shop_table" cellspacing="0">
                            <thead class="hidden-xs">
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">Item Details</th>
                                <th class="product-name">Product</th>
                                <th class="product-price" style="color:#ffffff">Price</th>
                                <th class="product-quantity">Quantity</th>

                                <th class="product-subtotal" style="color:#ffffff">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $key => $cart)
                                @php
                                    $product  = \App\Models\Product::where('id',$cart['cart_id'])->first();
                                @endphp
                                <tr class="cart-item" id="cartTable">
                                    <td class="product-remove">
                                        <a href="#" class="remove" title="Remove this item"
                                           onclick="deleteCart('{{$key}}')">× <span>Remove</span>
                                        </a>
                                    </td>
                                    <td class="product-thumbnail hidden-xs">
                                        <a href="">
                                            <img src="{{asset('storage/products/'.$product->slug.'/thumbs/thumb_'.$product->image)}}"
                                                 alt=""
                                                 class=" "
                                                 style="height: auto;width: 100px;">
                                        </a>
                                    </td>
                                    <td class="product-name" data-title="Product">
                                        <a href="{{url('shop-item',$product->slug)}}">{{$product->slug}}</a>
                                    </td>
                                    <td class="product-price" data-title="Price">
                                    <span class="amount">
                                        <span class="Price-currencySymbol">Rs.</span>
                                        <span class="price">{{$product->getPrice()}}</span>
                                    </span>

                                    </td>
                                    <td class="product-quantity" data-title="Quantity">
                                        <div class="quantity">
                                            <input type="number" min="1" value="{{$cart['quantity']}}" title="Qty"
                                                   class="input-text qty text" name="updatedQuantity"
                                                   onchange="updateCart('{{$cart['cart_id']}}',this)">
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Total">
                                    <span class="amount">
                                        <span class="Price-currencySymbol">Rs.</span>
                                        <span class="price">{{$cart['sub_total']}}</span>
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="coupon">
                            <input type="text" name="coupon_code" class="coupon_code" placeholder="Coupon code">
                            <input type="submit" class="coupon_btn" name="APPLY_COUPON" value="Apply Coupon">
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>

                <div class="col-md-4">
                    <div class="cart_totals">
                        <h3>Cart Totals</h3>
                        <table cellspacing="0" class="  shop_table shop-table-responsive">
                            <tbody>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td data-title="Subtotal">
                                <span class="Price-amount amount">
                                    <span class="Price-currencySymbol">Rs.</span>
                                    <span class="price totals_value" id="subtotal">{{$total_price}}</span>
                                </span>
                                </td>
                            </tr>
                            @if(isset($product))
                                @if($product->discounted_price != '')
                                    <tr class="cart-subtotal">
                                        <th>Discount</th>
                                        <td data-title="ProductDiscount">
                                <span class="Price-amount amount">
                                    <span class="Price-currencySymbol">Rs.</span>
                                    <span class="price totals_value" id="subtotal">{{$product->discount()}}</span>
                                </span>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                            <tr class="order-total">
                                <th>Total</th>
                                <td data-title="Total">
                                    <strong>
                                    <span class="Price-amount amount">
                                        <span class="Price-currencySymbol">Rs.</span>
                                        <span class="price totals_value" id="grandtotal">{{$total_price}}</span>
                                    </span>
                                    </strong>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                        <div class="proceed-to-checkout">
                            <button onclick="window.location.href='/checkout'" class="checkout-button ">PROCESSED TO
                                CHECKOUT
                            </button>
                        </div>

                        <a href="" class="cart-links">BACK TO SHOPPING</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
@endsection