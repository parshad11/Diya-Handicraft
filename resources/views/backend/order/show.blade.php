@extends('backend.layouts.app')
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">

                    <h2>E-Shop {{ $order->order_no }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"> View Order details Here</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="" class="btn btn-outline-primary btn-round"><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>

        <form method="post" id="ChangeOrderStatus"
              class="bg-white" style="padding-top: 20px;">
            @csrf
            <input type="hidden" value="{{$order->id}}" name="id" id="orderId">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 ">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"><b>Order Status</b></label>
                        </div>
                        <select class="custom-select" onchange="changeStatus(this)" name="status"
                                id="inputGroupSelect01">
                            <option value="0" @if($order->status == 0) selected @endif>Pending</option>
                            <option value="1" @if($order->status == 1) selected @endif>On Process</option>
                            <option value="2" @if($order->status == 2) selected @endif>Delivered</option>
                            <option value="3" @if($order->status == 3) selected @endif>Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-muted text-center">Product Details</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col"></th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Other
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $totalprice = 0;
                            @endphp
                            <?php
                            $product = json_decode($order->products);
                            //                                                        dd($product);
                            ?>
                            @foreach($product as $key => $item)

                                <tr class="text-center">
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <th>
                                        @php
                                            $product = \App\Models\Product::findorFail(@$item->cart_id);
                                        @endphp
                                        {{@$product->product_title}}
                                        @if($product)
                                            <img width="60px"
                                                 src="{{ asset('storage/products/'.$product->slug.'/'.$product->image) }}">
                                        @endif
                                    </th>
                                    <td>{{ @$item->product_title}}
                                    </td>
                                    <td>{{ @$item->quantity }}</td>
                                    <td>{{ @$item->sub_total }}</td>
                                    <td>{{ @$item->quantity * $item->sub_total }}</td>
                                    <td><a data-toggle="modal" data-target="#exampleModalLong{{$item->id}}"
                                           class="btn btn-sm btn-success center-block"
                                           title="View"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                @php
                                    $totalprice += $item->quantity * $item->sub_total;
                                @endphp
                                <div class="modal fade  bd-example-modal-lg" id="exampleModalLong{{$item->id}}"
                                     tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Order Detail</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                //                                                    dd($item->id);
                                                $product = json_decode($order->products);
                                                //                                            dd($attribute);
                                                //                                                ?>
                                                {{--<h3>Product Detail</h3>--}}
                                                @foreach($product as $product)
                                                    <div class="col-md-12 row">
                                                        <div class="col-md-3">
                                                            <h5>Product title</h5>
                                                            <p>{{@$product->product_title}}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <h5>Quantity</h5>
                                                            <p>{{@$product->quantity}}</p>
                                                        </div>
                                                        @if(@$product->attribute)
                                                            @foreach($product->attribute as $attribute)
                                                                <div class="col-md-3">
                                                                    <h5>{{ \App\Models\Attribute::find($attribute)->name }}</h5>
                                                                    <p>{{@$product->$attribute}}</p>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <hr>
                                                @endforeach

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-center">Total Price :</td>
                                <td></td>
                                <td>{{ $totalprice }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- .row -->
        <style>
            .list-group li > .float-right {
                font-size: 14px !important;
            }
        </style>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-muted text-center">Shipping Details</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group ">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Name
                                <span class="float-right">{{ $order->user_name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Phone
                                <span class="float-right">{{ @$order->phone}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Email
                                <span class="float-right">{{ @$order->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Address
                                <span class="float-right">{{ $order->shipping_details}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"><br></div>


@endsection
@push('scripts')
    <script>
        function changeStatus(arg) {
            console.log('change');
            var status = arg.value;
            id = $("#orderId").val();
            $.ajax({
                url: "{{route('orders.changeStatus','/')}}/" + id,
                type: "POST",
                data: {
                    '_token': '{{ csrf_token() }}',
                    status: status,
                },
                success: function (arg) {
                    response = jQuery.parseJSON(arg);
                    if (response.status == 'success') {
                        swal({
                            title: 'Success!',
                            buttonsStyling: false,
                            confirmButtonClass: "btn btn-success",
                            html: '<b>Order</b> Status Changed Successfully',
                            timer: 1000,
                            type: "success"
                        }).catch(swal.noop);
                    }
                    ;
                }
            })
            ;
        }
    </script>
@endpush



