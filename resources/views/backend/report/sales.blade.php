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
                            <li class="breadcrumb-item active">Sales report</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="float-right pull-right">
            <span class="bold font-20">Search By Date</span>
            <form action=" {{route('reports.sales')}}" method="post">
                @csrf
                <div>
                    <label for="">From</label>
                    <input type="date" name="from">
                    <label for="">To</label>
                    <input type="date" name="to">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="body">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                <div class="pull-right">
                                    <form action="{{route('reports.sales')}}" method="post">
                                        @csrf
                                        <div class="input-group">
                                            <div class="form-outline ml-2">
                                                <input type="search" class="form form-control"
                                                       placeholder="Search by order number" name="order_no"/>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <thead>
                                <tr class="text-center">
                                    <th>S.N</th>
                                    <th>Order Number</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Order Date</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$sale->order_no}}</td>
                                        <td>{{$sale->user_name}}</td>
                                        <td>{{$sale->total_price}}</td>
                                        <td>{{$sale->created_at}}</td>
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
