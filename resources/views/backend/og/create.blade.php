@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}"/>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Create OG</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.list') }}">Open Graph</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right ">
                    <a href="{{ route('products.list') }}" class="btn btn-sm btn-primary btn-round" title=""><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>
        {!! Form::open(array('route' => 'og.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
        <div class="row clearfix">
           
            <div class="col-md-4">
                <div class="card">
                    <br>
                    <div class="card">
                        <div class="card-header">
                            OG Images
                        </div>
                     
                        <div class="body">
                            <div class="row">
                                <div class="col">
                                    <input data-default-file="{{ asset('storage/og/'.$image->image) }}" type="file" name="image" class="dropify"  required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="alert alert-warning">
                                <i class="fa fa-warning"></i> Image Size Must Be 270 X 284 PX
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>

        </div>

        <div class="card">
            <div class="card-footer bg-white">
                <a href="{{ route('products.list') }}" class="btn btn-danger btn-sm">Cancel</a>
                <button type="submit" class="btn btn-success btn-sm" style="float: right" value="submit">Save
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/summernote/dist/summernote.js') }}"></script>

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
