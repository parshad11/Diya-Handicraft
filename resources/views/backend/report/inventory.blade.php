@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Users</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Inventory report</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="body">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                <div class="pull-right">
                                    <form action="{{route('reports.inventory')}}" method="post">
                                        @csrf
                                        <div class="input-group">
                                            <div class="form-outline ml-2">
                                                <input type="search" class="form form-control" placeholder="Search" name="title" />
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Product Title</th>
                                    <th>Units</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach ($product as $key => $product)

                                    <tr>
                                        <td>
                                            {{$loop->index+1}}
                                        </td>
                                        <td>{{$product->title}}</td>
                                        <td>{{$product->unit}}</td>
                                        <td>{{$product->quantity}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Javascript -->
    <script src="{{ asset('backend/html/assets/bundles/libscripts.bundle.js')}}"></script>
    <script src="{{ asset('backend/html/assets/bundles/vendorscripts.bundle.js')}}"></script>

    <script src="{{ asset('backend/html/assets/bundles/mainscripts.bundle.js')}}"></script>

@endpush