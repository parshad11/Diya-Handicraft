@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">

                    <h2>Orders</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"> Manage Your Order Here</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ url('@dashboard@') }}" class="btn btn-outline-primary btn-round"><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                    <a href="{{ route('orders.create') }}" class="btn btn-outline-success btn-round"><i
                                class="fa fa-plus"></i> Create Order</a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="only-bodytable" class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th class="w60">Order No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th class="w100">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td class="width45">
                                        {{ $order->order_no  }}
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $order->user_name}}</h6>
                                    </td>
                                    <td>
                                        {{$order->total_price}}
                                    </td>
                                    <td>
                                        {{ date('d M, Y',strtotime($order->created_at)) }}
                                    </td>
                                    <td>
                                        @if($order->status==0)<span class="badge badge-info">Pending</span>@endif
                                        @if($order->status==1)<span class="badge badge-dark">On Process</span>@endif
                                        @if($order->status==2)<span class="badge badge-success">Delivered</span>@endif
                                        @if($order->status==3)<span class="badge badge-Danger">Cancelled</span>@endif
                                    </td>

                                    <td>

                                        <a href="{{route('orders.show',$order->id)}}"
                                           class="btn btn-sm btn-success center-block"
                                           title="View"><i class="fa fa-eye"></i></a>
                                        <a href="#delete"
                                           data-toggle="modal"
                                           data-id="{{ $order->id }}"
                                           id="delete{{ $order->id }}"
                                           class="btn btn-sm btn-danger center-block"
                                           onClick="delete_menu({{ $order->id }} )"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade  bd-example-modal-lg" id="exampleModalLong{{$order->id}}"
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
                                                $product = json_decode($order->products);
                                                ?>
                                                <div class="col-md-12 row">
                                                    <div class="col-md-3">
                                                        <h5>Name</h5>
                                                        <p>{{$order->user_name}}</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h5>Shipping Details</h5>
                                                        <p>{{$order->shipping_details}}</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h5>Billing Details</h5>
                                                        <p>{{$order->billing_details}}</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h5>Status</h5>
                                                        <select name="status" id="update_delivery_status">
                                                            <option @if($order->status==0) selected @endif value="0">
                                                                pending
                                                            </option>
                                                            <option @if($order->status==1) selected @endif value="1">On
                                                                Process
                                                            </option>
                                                            <option @if($order->status==2) selected @endif value="2">
                                                                Deliverd
                                                            </option>
                                                            <option @if($order->status==3) selected @endif value="3">
                                                                Cancelled
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <h3>Product Detail</h3>
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
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Page</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <p>Are you Sure...!!</p>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                        <a href="" class="btn btn-round btn-primary">Delete</a>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('scripts')
    <script>
        function delete_menu(id) {
            var conn = './orders/delete/' + id;
            $('#delete a').attr("href", conn);
        }
    </script>

    <script type="text/javascript">
        $('#update_delivery_status').on('change', function (args) {
            var order_id = {{$order->id}};
            // console.log(order_id);
            var status = $('#update_delivery_status').val();
            // console.log(status);
            $.post('{{ route('orders.changeStatus',$order->id) }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function () {
                console.log('success');
            });
        });
    </script>

@endpush
