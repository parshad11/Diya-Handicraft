@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Create Coupons</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('coupons.list') }}">Coupons</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right ">
                    <a href="{{ route('coupons.list') }}" class="btn btn-sm btn-primary btn-round" title=""><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>
        @if(isset($coupon_edit))
        {!! Form::open(array('route' => ['coupons.update',$coupon_edit->id],'method'=>'POST')) !!}
        @else
        {!! Form::open(array('route' => 'coupons.store','method'=>'POST')) !!}
        @endif
       
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        Coupons Title, Type & Code
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Enter Coupon Title
                                        </div>
                                    </div>
                                    <input type="text" value="{{ isset($coupon_edit) ? $coupon_edit->title : null }}" name="title" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="input-group mb-3">
                                    <select name="type" id="category" class="form-control">
                                        @if(isset($coupon_edit))
                                            @if($coupon_edit->type == 'discount')
                                            <option value="discount" class="text-info font-weight-bold">Discount</option>
                                            <option value="product" class="text-info font-weight-bold">Product</option>
                                            @else
                                            <option value="product" class="text-info font-weight-bold">Product</option>
                                            <option value="discount" class="text-info font-weight-bold">Discount</option>
                                            @endif  
                                         @else
                                        <option value="default" selected>Choose Coupon Type</option>
                                            <option value="discount" class="text-info font-weight-bold">Discount</option>
                                            <option value="product" class="text-info font-weight-bold">Product</option>
                                            @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Coupon Price
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            {{ env('CURRENCY')?? 'Nrs' }}
                                        </div>
                                    </div>
                                    <input type="number" value="{{ isset($coupon_edit) ? $coupon_edit->price : null }}" name="price" class="form-control">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Coupon Code
                                        </div>
                                    </div>
                                    <input type="text" value="{{ isset($coupon_edit) ? $coupon_edit->coupon_code : null }}" name="coupon_code" class="form-control">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Add Coupon Description
                    </div>
                    <div class="body">
                        <textarea  class="form-control summernote" name="description">@if(isset($coupon_edit)) {{ $coupon_edit->description }} @endif</textarea>
                    </div>
                </div>
                <br>
                {{-- <div class="card" id="optional">

                </div> --}}
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Coupon Status
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            @if(isset($coupon_edit))
                                            <input type="checkbox" name="status" value="1"  @if($coupon_edit->status == 1)checked @else @endif></div>
                                            @else
                                            <input type="checkbox" name="status" value="1"  checked></div>
                                            @endif
                                    </div>
                                    <input type="text" class="form-control" value="Coupon Active" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="card">
                    <div class="card-header">
                        Expire Date
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"  value="{{ isset($coupon_edit) ? $coupon_edit->expiry_date : null }}"   name="expiry_date" placeholder="Expire Date" id="datepicker">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                {{-- <a href="#" id="option" class="btn-btn info badge-info">Add Option</a> --}}
            </div>

        </div>

        <div class="card">
            <div class="card-footer bg-white">
                <a href="{{ route('coupons.list') }}" class="btn btn-danger btn-sm">Cancel</a>
                @if(isset($coupon_edit))
                <button type="submit" class="btn btn-success btn-sm" style="float: right" value="submit">Update
                </button>
                @else
                <button type="submit" class="btn btn-success btn-sm" style="float: right" value="submit">Save
                </button>
                @endif
                
            </div>  
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/summernote/dist/summernote.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
          $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "mm/dd/yy",
            minDate: new Date()
            
          });
        } );
        </script>
    <script>
        $(document).ready(function () {

            $('#option').click(function () {

                $.ajax({
                    url: "{{url('@dashboard@/product/addOption/')}}/",
                    cache: false,
                    complete: function ($response, $status) {
                        if ($status != "error" && $status != "timeout") {
                            $('#optional').append($response.responseText);
                        }
                    },
                    error: function ($responseObj) {
                        alert("Something went wrong while processing your request.\n\nError => "
                            + $responseObj.responseText);
                    }
                });
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id).remove();
            });
        });
    </script>
@endpush
