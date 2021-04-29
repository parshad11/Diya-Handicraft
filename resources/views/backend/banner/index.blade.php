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
                            <li class="breadcrumb-item active">Banner</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ route('banners.create') }}" class="btn btn-success btn-primary btn-round" title=""><i
                                class="fa fa-plus"></i>Add Banner</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="body">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Display</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach ($banners as $key => $banner)

                                    <tr>
                                        <td>
                                            {{$loop->index+1}}
                                        </td>
                                        <td class="w60">
                                            <img src="{{ asset('storage/banners/images/'.$banner->image)}}"
                                                 data-toggle="tooltip"
                                                 data-placement="top" title="banner-{{$banner->image}}" alt="banner-{{$banner->image}}"
                                                 class="w35 rounded" >
                                        </td>
                                        <td>
                                            @if($banner->status == 1)
                                                <span class="btn btn-info btn-primary">Displayed</span>
                                            @else
                                                <span class="btn btn-primary btn-warning">Not Displayed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('@dashboard@/banner/edit/'.base64_encode($banner->id))}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{url('@dashboard@/banner/destroy',base64_encode($banner->id))}}"
                                               class="btn-outline-danger"><i class="fa fa-trash"></i>
                                            </a>
                                        </td>
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

    <script>
        $(document).ready(function () {
            $('#delete-banner').on('submit', function () {
                if (confirm("Are you sure you want to delete it?")) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
    <!-- Javascript -->
    <script src="{{ asset('backend/html/assets/bundles/libscripts.bundle.js')}}"></script>
    <script src="{{ asset('backend/html/assets/bundles/vendorscripts.bundle.js')}}"></script>

    <script src="{{ asset('backend/html/assets/bundles/mainscripts.bundle.js')}}"></script>

@endpush