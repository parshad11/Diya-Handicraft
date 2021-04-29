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
                    <h2>Update Attribute</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('attributes.list') }}">Attribute</a></li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right ">
                    <a href="{{ route('attributes.list') }}" class="btn btn-sm btn-primary btn-round" title=""><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>
        <form action="{{route('attributes.update',$attribute->id)}}" method="post">
            @csrf
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">

                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Enter Attributes Name
                                        </div>
                                    </div>
                                    <input type="text" name="name" class="form-control" value="{{$attribute->name}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-footer bg-white">
                <a href="{{ route('attributes.list') }}" class="btn btn-danger btn-sm">Cancel</a>
                <button type="submit" class="btn btn-success btn-sm" style="float: right" value="submit">Save
                </button>
            </div>
        </div>
        </form>
    </div>
@endsection

