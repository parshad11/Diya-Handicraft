@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}"/>
@endpush
@section('content')
    <script>
        $(document).ready(function () {
            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target), output = list.data('output');

                $.ajax({
                    method: "POST",
                    url: "{{url('@dashboard@/page/set_order')}}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        list_order: list.nestable('serialize'),
                        parentid: "{{ isset($page)?$page->id:0 }}",
                        table: "pages"
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
                    sweetAlert('Failure', 'Something Went Wrong!', 'error');
                });
            };

            $('#nestable').nestable({
                group: 1,
                maxDepth: 3,
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
                <small><i>{{ $item->slug }}</i></small>
                <span class="content-right">
                    <a href="#launch-pricing-modal"
                       class="btn btn-sm btn-outline-success" data-toggle="modal"
                       data-id="{{ $item->id }} "
                       id="launch-pricing-modal{{ $item->id }}"
                       onclick="view('{{ $item->id }}','{{ $item->title }}','{{ $item->slug }}','{{ $item->links }}','{{ $item->display }}','{{ $item->feature }}','{{ $item->content }}')"
                       title="View"><i class="fa fa-eye"></i></a>
                                                <a href="{{ url('@dashboard@/page/edit/'.$item->id) }}"
                                                   class="btn btn-sm btn-outline-primary" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                        @if(\App\Models\Pages::checkstatic($item->id))
                        <a href="#delete"
                           data-toggle="modal"
                           data-id="{{ $item->id }}"
                           id="delete{{ $item->id }}"
                           class="btn btn-sm btn-outline-danger center-block"
                           onClick="delete_menu({{ $item->id }} )"><i class="fa fa-trash"></i></a>
                    @endif

                </span>
            </div>

            <?php if (isset($item->children)): ?>
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

                    <h2>@if($page) {{ $page->title }} @else Pages @endif</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"> @if($page) {{ $page->title }} @else
                                    Pages @endif</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ url('@dashboard@/page') }}" class="btn btn-outline-primary btn-round"><i
                            class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">

                <div class="tab-content mt-0">
                    <div class="tab-pane" id="Pages">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">All @if($page) {{ $page->title }} @else Pages @endif</h6>
                            </div>
                            <div class="body mt-0">
                                <div class="dd nestable-with-handle" id="nestable">
                                    <?php isset($pages) ? displayList($pages) : '' ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane show active" id="addPage">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">Update @if($page) {{ $page->title }} @else Pages @endif</h6>
                            </div>
                            <div class="body mt-2">
                                <form method="post" action="{{ route('pages.update',$page->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="parentId" value="{{ isset($page)?$page->id :0 }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                class="fa fa-text-width fa-lg"></i> &nbsp;Title</span>
                                                </div>
                                                <input type="text" value="{{ isset($page)?$page->title :null }}" name="title" class="form-control"
                                                       aria-label="Default"
                                                       aria-describedby="inputGroup-sizing-default" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                class="fa fa-text-width fa-lg"></i> &nbsp;Link</span>
                                                </div>
                                                <input type="text" name="links" value="{{ isset($page)?$page->links : null}}" class="form-control"
                                                       aria-label="Default"
                                                       aria-describedby="inputGroup-sizing-default">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="display" value="1"
                                                               aria-label="Checkbox for following text input" @if($page->display) checked @endif>
                                                    </div>
                                                </div>
                                                <input type="button " class="form-control bg-indigo text-muted"
                                                       value="Display" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="feature" value="1"
                                                               aria-label="Checkbox for following text input" @if($page->feature) checked @endif>
                                                    </div>
                                                </div>
                                                <input type="button " class="form-control bg-indigo text-muted"
                                                       value="Featured" disabled>
                                            </div>
                                        </div>



                                        <div class="clearfix"></div>

                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                class="fa fa-file-text-o fa-lg"></i> &nbsp;Content</span>
                                                </div>
                                                <textarea class="summernote"
                                            name="description">{{$page->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="{{ route('pages.list') }}"
                                               class="btn btn-outline-danger">Cancel</a>

                                            <button type="submit" style="float: right;" class="btn btn-outline-success">
                                                save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="clearfix"></div>
            <div class="col-md-12">

            </div>

        </div>

        <div class="modal fade " id="launch-pricing-modal" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6>View Page
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
                                <h5 id="PageTitle"></h5>
                                <small class="text-muted" id="PageSubTitle">Page Subtitle</small>
                            </div>
                            <div class="card-body">
                                <img id="ViewImage" class="img-fluid"
                                     src="https://via.placeholder.com/750x300?text=Sample + Image + For + Page">
                            </div>
                        </div>
                        <br>
                        <div class="card  mb-4">
                            <div class="card-header">
                                <h6>Excerpt</h6>
                            </div>
                            <div class="card-body border ">
                                <p id="viewExcerpt"></p>
                            </div>
                        </div>
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
                        <h5 class="modal-title text-white" id="exampleModalLabel">Delete Page</h5>
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
        function view(id, title, slug, subtitle, status, feature, image, excerpt, content) {
            $('#viewId').val(id);
            $('#PageTitle').html(title);
            $('#PageSubTitle').html(subtitle);

            if (status == 0) {
                $('#viewDisplay').html('<small class="badge badge-danger">Not Displayed</small>');
            } else {
                $('#viewDisplay').html('<small class="badge badge-success">Displayed</small>');
            }
            if (feature == 0) {
                $('#viewFeatured').html('<small class="badge badge-danger">Not Featured</small>');
            } else {
                $('#viewFeatured').html('<small class="badge badge-success">Featured</small>');
            }


            $('#ViewImage').attr('src', "{{ asset('storage/pages/')}}/" + slug + "/thumbs/cover_" + image);
            $('#viewExcerpt').html(excerpt);
            $('#viewContents').html(content);
        }

        function delete_menu(id) {
            var conn = './page/delete/' + id;

            $('#delete a').attr("href", conn);
        }

    </script>
    <script src="{{ asset('backend/assets/vendor/summernote/dist/summernote.js') }}"></script>
    <script>
        $(".summernote").summernote({
            disableResizeEditor: true,
            height: 300,
            width: '100%',
        });
    </script>
    <script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script><!-- Jquery Nestable -->
    <script src="{{ asset('backend/html/assets/js/pages/ui/sortable-nestable.js') }}"></script>
@endpush
