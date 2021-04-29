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
                    <h2>Create Brand</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('brands.list') }}">Brand</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right ">
                    <a href="{{ route('brands.list') }}" class="btn btn-sm btn-primary btn-round" title=""><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>
        <form action="{{route('brands.update',$brand->id)}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        Brand Title, logo & Meta title
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Enter Brand Title
                                        </div>
                                    </div>
                                    <input type="text" name="title" class="form-control" required value="{{$brand->title}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Meta title
                                        </div>
                                    </div>
                                    <input type="text" name="meta_title" class="form-control" value="{{$brand->meta_title}}">

                                </div>
                            </div>
                            <div class="col-8">
                                <div class="card">
                                    <div class="card">
                                        <div class="card-header">
                                            Brand Logo
                                        </div>
                                        <div class="body">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="file" name="logo" class="dropify" value="{{$brand->logo}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Add Brand Description
                                </div>
                                <div class="body">
                                    <textarea class="summernote"  name="description">{{$brand->description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-footer bg-white">
                <a href="{{ route('brands.list') }}" class="btn btn-danger btn-sm">Cancel</a>
                <button type="submit" class="btn btn-success btn-sm" style="float: right" value="submit">Save
                </button>
            </div>
        </div>
        </form>
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
