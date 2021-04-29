@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Users</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ route('admins.list') }}" class="btn btn-sm btn-primary btn-round" title=""><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <ul class="list-group ">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Name <span
                                        class="text-right">{{ $user->name }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Email <span
                                        class="text-right">{{ $user->email }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Role
                                @if($user->is_admin == 1)
                                    <span class="badge badge-warning">Super Admin</span>
                                @else
                                    <span class="badge badge-warning">Customer</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Created
                                At<span
                                        class="text-right">{{ $user->created_at->diffForHumans() }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
