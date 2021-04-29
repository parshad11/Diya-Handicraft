@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Categories</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('@dashboard@') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('categories.list') }}">Categories</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ route('categories.list') }}" class="btn btn-sm btn-primary" title=""><i
                                class="fa fa-list"></i> List Categories</a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-12">
                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Title</span>
                                        </div>
                                        <input type="text" class="form-control" name="title"
                                               placeholder="Title"
                                               aria-label="Title"
                                               aria-describedby="basic-addon1" required>
                                    </div>
                                </div>
                               {{-- <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Image</span>
                                        </div>
                                        <input type="file" class="form-control" name="image">
                                        <label class="badge badge-warning pt-2">Image Size Must be 350 X 350 PX
                                            Px</label>
                                    </div>
                                </div>--}}
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><input type="checkbox" name="status" checked></span>
                                        </div>
                                        <input type="text" class="form-control" value="Display Status" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text"><input type="checkbox" name="feature"></span>
                                        </div>
                                        <input type="text" class="form-control" value="Feature Status" disabled>
                                    </div>
                                </div>
                               {{-- <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Description</span>
                                        </div>
                                        <textarea rows="5" class="form-control" name="description"
                                                  aria-label="With textarea"></textarea>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('categories.list') }}" class="btn btn-danger">Cancel</a>
                            <span class="float-right">
                        <button type="submit" name="submit" class="btn btn-success" value="save">Save</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
