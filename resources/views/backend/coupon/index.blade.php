@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Coupons</h1>
                    <small>Manage Your coupons From Here</small>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Coupons</li>
                        </ol>
                    </nav>
                </div>
                @if(Auth::user()->is_admin != 0)
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ route('coupons.create') }}" class="btn btn-sm btn-primary" title=""><i
                                class="fa fa-plus-circle"></i> Create
                        Coupons</a>
                </div>
            @endif
            </div>
        </div>
        <div class="tab-pane show active" id="e_departments">
            <div class="table-responsive">
                <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Coupon Name</th>
                        <th>Coupon Code</th>
                        <th>Coupon Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($coupons))
                    @foreach($coupons as $coupon)
                        <tr class="text-center">
                            <td>{{$loop->index+1}}</td>
                            <td>
                                <div class="font-15">{{ucfirst($coupon->title)}}</div>
                            </td>
                            <td>{{$coupon->coupon_code}}</td>
                            <td>{{$coupon->type}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-default" title="View" data-toggle="modal"
                                   onclick="clientView('{{$coupon->id}}','{{$coupon->title}}','{{ $coupon->expiry_date }}','{{ $coupon->coupon_code }}','{{ $coupon->price }}','{{ $coupon->description }}','{{ $coupon->type }}','{{ $coupon->status ? 'Active' : 'Not Active' }}')"><i
                                            class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('coupons.edit',$coupon->id) }}" class="btn btn-sm btn-default"><i class="fa fa-edit text-info"></i></a>
                                <form id="deleteContact"
                                      action="{{route('coupons.delete',['id'=>base64_encode($coupon->id)])}}"
                                      method="Post" style="display: inline">
                                    @csrf
                                    <a href="#" id="contactDelete"
                                       class="btn btn-sm btn-default js-sweetalert" title="Delete"
                                       data-type="confirm"><i class="fa fa-trash-o text-danger"></i></a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    {{--View Modal--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         id="contactView"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Detail of <span id="title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="name" class="font-weight-bold">Coupon Name:</label>
                            <span id="clientName"></span>
                        </div>
                        <div class="col-6">
                            <label for="email" class="font-weight-bold">Expiry Date:</label>
                            <span id="clientEmail"></span>
                        </div>
                        <div class="col-6">
                            <label for="subject" class="font-weight-bold">Coupon Code:</label>
                            <span id="subject"></span>
                        </div>
                        <div class="col-6">
                            <label for="address" class="font-weight-bold">Price:</label>
                            <span id="address"></span>
                        </div>
                        <div class="col-6">
                            <label for="phone" class="font-weight-bold">Type:</label>
                            <span id="clientPhone"></span>
                        </div>
                        <div class="col-6">
                            <label for="phone" class="font-weight-bold">Status:</label>
                            <span id="clientStatus"></span>
                        </div>
                        <div class="col-12">
                            <label for="message" class="font-weight-bold">Description:</label>
                            <br>
                            <span id="clientMessage"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Modal--}}
@endsection
@push('scripts')
    <script src="{{asset('backend/html/assets/js/pages/tables/jquery-datatable.js')}}"></script>
    <script>
        $('.dataTable').dataTable({searching: false});
    </script>
    <script>
        function clientView(id, name, email, subject, address, message, phone,status) {
            $('#contactView').modal('show');
            $('#clientName').html(name);
            $('#clientEmail').html(email);
            $('#subject').html(subject);
            $('#address').html(address);
            $('#clientMessage').html(message);
            $('#clientStatus').html(status);
            $('#title').html(name);
            if (phone != '') {
                $('#clientPhone').html(phone)
            } else {
                $('#clientPhone').html('N/A');
            }

        }

        $('#contactDelete').click(function (e) {
            e.preventDefault();
            swal({
                    title: "Are You Sure!",
                    text: "Would you like to Delete item?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                },
                function (isConfirm) {
                    if (isConfirm) {
                        document.getElementById('deleteContact').submit();
                    }
                }
            )
        });
    </script>

@endpush