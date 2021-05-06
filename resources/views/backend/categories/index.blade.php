@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}"/>
@endpush
@section('content')

    <script>
        $(document).ready(function () {
            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target), output = list.data('output');
                console.log(list);

                $.ajax({
                    method: "POST",
                    url: "{{route('categories.orderCategory')}}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        list_order: list.nestable('serialize'),
                        parentid: "{{ isset($category) ? $category->id:0 }}",
                        table: "categories"

                    },
                    success: function (response) {
                        console.log("success");
                        console.log("response " + response);
                        var obj = jQuery.parseJSON(response);
                        if (obj.status == 'success') {
                            swal({
                                title: 'Success!',
                                buttonsStyling: false,
                                confirmButtonClass: "btn btn-success",
                                html: '<b>Content</b> Sorted Successfully',
                                timer: 1000,
                                type: "success"
                            }).catch(swal.noop);
                        }
                        ;

                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    sweetAlert('Failure', 'Something Went Wrong!', 'error');
                });
            };

            $('#nestable').nestable({
                group: 1,
                maxDepth: 2
                ,
            }).on('change', updateOutput);
        });
    </script>

    <?php
    function displayList($list)
    {
    ?>
       <ol class="dd-list">
        <?php

        foreach ($list as $item):
        ?>
        <li class="dd-item dd3-item" data-id="{{ $item->id }} ">
            <div class="dd-handle dd3-handle"></div>
            <div class="dd3-content">
                <b>{{ $item->title }}</b>&nbsp;|&nbsp;
                <small>
                    <i>
                        @if($item->status == 1)
                            <span class="badge badge-success mr-0 ml-0" style="font-size: 7px;">Displayed</span>
                        @else
                            <span class="badge badge-danger mr-0 ml-0" style="font-size: 7px;">Not Displayed</span>
                        @endif

                        @if($item->feature == 1)
                            <span class="badge badge-info mr-0 ml-0" style="font-size: 7px;">Featured</span>
                        @else
                            <span class="badge badge-danger mr-0 ml-0" style="font-size: 7px;">Not Featured</span>
                        @endif


                    </i>
                </small>
                <span class="content-right">
                    <a href="{{ url('@dashboard@/category/'.base64_encode($item->id).'/edit')}}"
                       class="btn btn-sm btn-outline-primary" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="#delete"
                           data-toggle="modal"
                           data-id="{{ $item->id }}"
                           id="delete{{ $item->id }}"
                           title="Delete"
                           class="btn btn-sm btn-outline-danger center-block"
                           onClick="delete_menu({{ $item->id }} )">
                        <i class="fa fa-trash  "></i>
                   </a>
                </span>
            </div>

            <?php if(isset($item->children)): ?>
                        <?php displayList($item->children); ?>
                    <?php endif; ?>
        </li>
        <?php
        endforeach; ?>
    </ol>
    <?php
    }
    ?>

    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">

                    <h2>Categories</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('@dashboard@')  }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('categories.list') }}">Categories</a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page">All Categories
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{url('@dashboard@')}}"
                       class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fa fa-angle-double-left"></i> Go Back
                    </a>
                    <a href="{{route('categories.create')}}"
                       class="btn btn-sm btn-info" title="Go Back">
                        <i class="fa fa-plus pr-2"></i>Add New Category
                    </a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <ul class="nav nav-tabs">

                    <li class="nav-item"><a class="nav-link show  active" data-toggle="tab"
                                            href="#Categories">Categories</a>
                    </li>

                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="Categories">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">
                                    All Categories</h6>
                            </div>
                            <div class="body mt-0">
                                <div class="dd nestable-with-handle" id="nestable">
                                    <?php isset($categories) ? displayList($categories) : '' ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="clearfix"></div>
            <div class="col-md-12">

            </div>

        </div>

        <div class="modal fade " id="viewModal" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6>View Category
                            <span id="viewDisplay">
                            </span>
                            <span id="viewFeatured">
                            </span>
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body pricing_page text-center pt-4 mb-4">
                        <div class="card ">
                            <div class="card-header">
                                <h5 id="CategoryTitle"></h5>
                            </div>
                            <div class="card-body">
                                <img id="ViewImage" class="img-fluid"
                                     src="https://via.placeholder.com/750x300?text=Sample + Image + For + Category">
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-header">
                                <h6>Content</h6>
                            </div>
                            <div class="card-body border " style="overflow: scroll;">
                                <p id="viewContents"></p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button style="text-align: right;" type="button" data-dismiss="modal"
                                class="btn btn-outline-danger">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-white">
                        <p>Are you Sure...!!</p>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                        <a href="" class="btn btn-round btn-primary">Delete</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@push('scripts')
    <script>
        function view(id, title, slug, display, featured) {
            $('#viewId').val(id);
            $('#CategoryTitle').html(title);

            content = $("#view" + id).attr('data-content');

            if (display == 0) {
                $('#viewDisplay').html('<small class="badge badge-danger">Not Displayed</small>');
            } else {
                $('#viewDisplay').html('<small class="badge badge-success">Displayed</small>');
            }
            if (featured == 0) {
                $('#viewFeatured').html('<small class="badge badge-danger">Not Featured</small>');
            } else {
                $('#viewFeatured').html('<small class="badge badge-success">Featured</small>');
            }
            $('#ViewImage').attr('src', "{{ asset('storage/categories')}}/thumbs/cover_" + image);
            $('#viewContents').html(content);
        }

        function delete_menu(id) {
            var conn = './categories/delete/' + id;
            $('#delete a').attr("href", conn);
        }

    </script>
    <script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script><!-- Jquery Nestable -->
@endpush
