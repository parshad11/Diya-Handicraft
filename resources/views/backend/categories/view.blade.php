@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>View Categories</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('categories.list') }}">Categories</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $categories->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ route('categories.list') }}" class="btn btn-sm btn-primary" title=""><i
                                class="fa fa-list-ul"></i> list Categories</a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Title :
                                <span>{{ $categories->title }}</span>
                            </li>
                            @if($categories->parent_id != 0)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Parent Categories
                                    <span>{{ \App\Category::where('parent_id',$categories->parent_id)->first()->title }}</span>
                                </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Display Type
                                <span>
                                    @if($categories->display_type == 1)
                                        SubCategories @elseif($categories->display_type == 2) Products @else
                                        Subcategories & Categories @endif</span>
                            </li>
                          {{--  <li class="list-group-item d-flex justify-content-between align-content-center ">Images</li>
                            <li class="list-group-item d-flex justify-content-between align-content-center">

                                <span><img class="img-thumbnail"
                                           src="{{ asset('storage/categories/'.$categories->slug.'/'.$categories->image) }}"></span>
                            </li>--}}
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Display Status :
                                @if($categories->status == 1)<span class="badge badge-success"> Active</span> @else
                                    <span class="badge badge-danger"> Not Active </span> @endif</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Featured :
                                @if($categories->feature == 1)<span class="badge badge-success"> Featured</span> @else
                                    <span class="badge badge-danger"> Not Featured </span> @endif</span>
                            </li>
                           {{-- <li class="list-group-item d-flex justify-content-between align-items-center">Description
                            </li>--}}
                            {{--<li class="list-group-item d-flex justify-content-between align-items-center">

                                <span>{{ $categories->description }}</span>
                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript"
            src="{{ asset('backend/assets/vendor/table-dragger/table-dragger.min.js') }}"></script>
    <script>
        // tableDragger(document.querySelector("#only-bodytable"), { mode: "row", onlyBody: true });
        var el = document.getElementById('only-bodytable');
        var dragger = tableDragger(el, {
            mode: 'row',
            dragHandler: '.handle',
            onlyBody: true,
        });

        dragger.on('drop', function (el, mode) {
            console.log(el);
            console.log(mode);
        });
    </script>
@endpush


