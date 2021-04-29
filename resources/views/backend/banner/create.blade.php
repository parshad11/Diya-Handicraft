@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">

                    <h2>Banners</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"> Manage Your Banner</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ url('@dashboard@/banner') }}" class="btn btn-outline-primary btn-round"><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="card">
                <div class="header card-header">
                    <h6 class="title mb-0">Add Banners</h6>
                </div>
                <div class="body mt-2">
                    @if(isset($banner))
                        <form method="post" action="{{ route('banners.update',$banner->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @else

                                <form method="post" action="{{ route('banners.store') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @endif
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-text-width fa-lg"></i> &nbsp;Banner Position</span>
                                                </div>

                                                @if(isset($banner->position))
                                                    <select name="position" id="banner_position" class="form-control">
                                                        @if($banner->position == "top")
                                                            <option value="top">Top</option>
                                                            <option value="middle">Middle</option>
                                                        @elseif($banner->position == "middle")
                                                            <option value="middle">Middle</option>
                                                            <option value="top">Top</option>
                                                        @endif
                                                    </select>
                                                @else
                                                    <select name="position" id="banner_position" class="form-control">
                                                        <option value="#" disabled selected>Select Position</option>
                                                        <option value="top">Top</option>
                                                        <option value="middle">Middle</option>
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">

                                                        @if(isset($banner->status))
                                                            <input type="checkbox" name="status"
                                                                   value="{{ $banner->status }}"
                                                                   aria-label="Checkbox for following text input"
                                                                   @if($banner->status == 1) checked @else @endif>
                                                        @else
                                                            <input type="checkbox" name="status" value="1"
                                                                   aria-label="Checkbox for following text input"
                                                                   checked>
                                                        @endif
                                                    </div>
                                                </div>
                                                <input type="button" class="form-control bg-indigo text-muted"
                                                       value="Display" disabled>
                                            </div>
                                        </div>


                                        <div class="col-md-4">

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-image fa-lg"></i> &nbsp;Image</span>
                                                </div>
                                                @if(isset($banner->image))
                                                    <img src="{{ asset('storage/banners/images/'.$banner->type.'_small_'.$banner->image)}}"
                                                         data-toggle="tooltip"
                                                         data-placement="top" title="Current Image" alt="Avatar"
                                                         class="w35 rounded">
                                                    <input type="hidden" name="image" value="{{ $banner->image }}">
                                                    <input type="file" name="image" value="{{ $banner->image }}"
                                                           class="bg-primary text-white form-control">
                                                @else
                                                    <input type="file" name="image"
                                                           class="bg-primary text-white form-control">
                                                @endif

                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-text-width fa-lg"></i> &nbsp;URL</span>
                                                </div>
                                                <input type="text" name="url" placeholder="Enter URL"
                                                       value="{{ isset($banner->url) ? $banner->url : null }}"
                                                       class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="alert alert-warning">[ Best Image Size 1440 X 810 PX ]
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="col-md-12">
                                            <a href="{{ route('banners.list') }}"
                                               class="btn btn-outline-danger">Cancel</a>
                                            @if(isset($banner))
                                                <button type="submit" style="float: right;"
                                                        class="btn btn-outline-success">
                                                    Update
                                                </button>
                                            @else
                                                <button type="submit" style="float: right;"
                                                        class="btn btn-outline-success">
                                                    save
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="launch-pricing-modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>View Slider
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
                            <small class="text-muted" id="PageSubTitle"></small>
                        </div>
                        <div class="card-body">
                            <img id="ViewImage" class="img-fluid"
                                 src="https://via.placeholder.com/1584x1058?text=Sample + Image + For + Slider">
                            <hr>
                            <div class="row">
                                <div class="col-md-6" id="">
                                    <b>Button Name : <span id="viewButtonName"></span></b>
                                </div>
                                <div class="col-md-6" id="">
                                    <b>Url : <span id="viewButtonUrl"></span></b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>


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
                    <h5 class="modal-title text-white" id="exampleModalLabel">Delete Slider</h5>
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

@endsection
@push('scripts')
    <script>
        function view(id, title, subtitle, status, image, btnname, link) {
            $('#viewId').val(id);
            $('#PageTitle').html(title);
            $('#PageSubTitle').html(subtitle);

            if (status == 0) {
                $('#viewDisplay').html('<small class="badge badge-danger">Not Displayed</small>');
            } else {
                $('#viewDisplay').html('<small class="badge badge-success">Displayed</small>');
            }

            $('#ViewImage').attr('src', "{{ asset('storage/slider/thumbs/slide_')}}" + image);
            $('#viewButtonName').html(btnname);
            $('#viewButtonUrl').html(link);
        }

        function delete_menu(id) {
            var conn = './sliders/delete/' + id;
            $('#delete a').attr("href", conn);
        }

    </script>
    <script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script><!-- Jquery Nestable -->
    <script src="{{ asset('backend/html/assets/js/pages/ui/sortable-nestable.js') }}"></script>
    <script>
        function bannerPage(arg) {
            var p = arg.value;
            if (p == 'single') {
                $('#banner_type').attr('disabled', 'disabled');

                $("#banner_type option[value = 'horizontal']")
                    .attr("selected", "selected");

                $('#banner_position').attr('disabled', 'disabled');

                $("#banner_position option[value = 'bottom']")
                    .attr("selected", "selected");

            }

            if (p == 'home') {

                $('#banner_type').prop('disabled', false);

                $("#banner_type option[value = '#']")
                    .attr("selected", "selected");

                $("#banner_position").prop('disabled', false);

            }
        }
    </script>
@endpush
