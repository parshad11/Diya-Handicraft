@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/multi-select/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Add Users</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('@dashboard@') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('@dashboard@/user') }}">Users</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ url('@dashboard/user') }}" class="btn btn-sm btn-primary btn-round" title=""><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card planned_task">
                    <div class="header">
                        <h2>Manage Users & Roles </h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>
                    {!! Form::open(array('route' => 'admins.store','method'=>'POST')) !!}
                    <div class="body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Name:</span>
                                    </div>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Email:</span>
                                    </div>
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Password:</span>
                                    </div>
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Confirm Password:</span>
                                    </div>
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="multiselect_div">

                                    {!! Form::select('role',['Select Role','Super Admin','User'], array('class' => 'from-control multiselect multiselect-custom','id' => 'multiselect-color','multiple'=>'multiple')) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admins.list') }}" class="btn btn-outline-danger">Cancel</a>
                        <button type="submit" style="float: right" class="btn btn-outline-success">Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
@push('script')
    <script
            src="{{ asset('backend/assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script><!-- Multi Select Plugin Js -->
    <script src="{{ asset('backend/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script>
        $('#multiselect-color').multiselect({
            buttonClass: 'btn btn-primary',
            nonSelectedText: 'Choose Role'
        });
    </script>
@endpush

