@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Dashboard</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('@dashboard@') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ol>
                    </nav>
                </div>
                @if(Auth::user()->is_admin != 0)
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary" title=""><i
                                    class="fa fa-plus-circle"></i> Create
                            Products</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-12">
                <div class="table-responsive">
                    @if(count($products) > 0)
                        <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                            <thead>
                            <th class=""></th>
                            <th class="">Title</th>
                            <th class="">Status | Feature</th>
                            <th class="">Action</th>
                            </thead>
                            <tbody>

                            @foreach($products as $row)
                                <tr>
                                    <td class="w60">

                                        <div class="avtar-pic w35 bg-red" data-toggle="tooltip" data-placement="top"
                                             title=""
                                             data-original-title="{{ $row->title }}">
                                        <span><img src="{{asset('storage/products/'.$row->slug.'/'.$row->image)}}"
                                                   class="img-thumbnail"></span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($row->unit)
                                            <div class="font-16">{{ $row->title.' '.'('.$row->unit.')'}}</div>
                                        @else
                                            <div class="font-16">{{ $row->title }}</div>
                                        @endif
                                        <span class="text-muted">
                                                <small> <i>Category: {{$row->category->title }} </i></small></span>
                                    </td>
                                    <td>
                                        @if($row->status == 1)
                                            <span class="badge badge-success text-uppercase">Display</span>
                                        @else
                                            <span class="badge badge-danger text-uppercase">Not Display</span>
                                        @endif
                                        @if($row->feature == 1)
                                            <span class="badge badge-success text-uppercase"> Featured</span>
                                        @else
                                            <span class="badge badge-danger text-uppercase">Not Featured</span>
                                        @endif
                                        @if($row->special == 1)
                                            <span class="badge badge-success text-uppercase"> specail</span>
                                        @else
                                            <span class="badge badge-danger text-uppercase">Not specail</span>
                                        @endif
                                        @if($row->quantity<=10 && $row->quantity>=1)
                                            <span class="badge badge-danger text-uppercase">Low Inventory </span>
                                        @endif
                                        @if($row->quantity<=0)
                                            <span class="badge badge-danger text-uppercase">out of Inventory</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->is_admin === 1)
                                            <a href="{{ url('@dashboard@/product/'.base64_encode($row->id).'/edit') }}"
                                               data-toggle="tooltip"
                                               data-title="EDIT" class="btn btn-outline-success btn-sm"><i
                                                        class="fa fa-edit"></i></a>
                                        @endif
                                        {!! Form::open(['method' => 'DELETE','route' => ['products.destroy',base64_encode($row->id)],'style'=>'display:inline']) !!}
                                        <button type="submit" data-toggle="tooltip" data-title="DELETE"
                                                class="btn btn-outline-danger btn-sm" value="submit"><i
                                                    class="fa fa-trash"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    @else
                        <div class="alert alert-warning">
                            NO product Listed Please <a href="{{ route('products.create') }}"> Add New</a>
                        </div>
                    @endif

                </div>
                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection
