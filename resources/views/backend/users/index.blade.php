@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Users</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ route('admins.create') }}" class="btn btn-sm btn-primary btn-round" title=""><i
                                class="fa fa-user-plus"></i> Add New</a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card planned_task">
                    <div class="header">
                        <h2>Manage Users, Role & Permission</h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                        </ul>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th width="280px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->is_admin == 1)
                                            <label class="badge badge-success">Super Admin</label>
                                        @else
                                            <label class="badge badge-success">Customer</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->is_admin ==1)
                                        <a class="btn btn-info"
                                           href="{{ route('admins.show',$user->id) }}">Show</a>
                                        <a class="btn btn-primary"
                                           href="{{ route('admins.edit',$user->id) }}">Edit</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['admins.destroy', $user->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        @else
                                            <a class="btn btn-info"
                                               href="{{ route('admins.user.show',$user->id) }}">Show</a>
                                            <a class="btn btn-primary"
                                               href="{{ route('admins.user.edit',$user->id) }}">Edit</a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['admins.user.destroy', $user->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


{{--                        {!! $data->render() !!}--}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
