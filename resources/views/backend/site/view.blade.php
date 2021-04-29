@extends('backend.layouts.app')
@push('styles')
    <style>
        .img-thumbnail {
            padding: .25rem;
            background-color: #dee2e6;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            max-width: 100%;
            height: auto;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}"/>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Setting</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
                            <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin-dashboard')}}" class="btn btn-sm btn-round btn-outline-primary" title=""><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                        </div>
                        <div class="body">
                            <form id="advanced-form" data-parsley-validate="" novalidate=""

                                action="{{route('admin-site-update')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">

                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fa fa-file-image-o"></i> &nbsp;Logo </span>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" name="logo" class="custom-file-input"
                                                                       id="inputGroupFile03">
                                                                <label class="custom-file-label" for="inputGroupFile03">Choose
                                                                    Logo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <img src="{{ asset('storage/setting/logo/'.$setting->logo) }}"
                                                             data-toggle="tooltip" data-placement="top" title=""
                                                             alt="Logo"
                                                             class="rounded img-thumbnail" width="80px"
                                                             data-original-title="Logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fa fa-file-image-o"></i> &nbsp;Favicon </span>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" name="favicon"
                                                                       class="custom-file-input"
                                                                       id="inputGroupFile03">
                                                                <label class="custom-file-label" for="inputGroupFile03">Choose
                                                                    Favicon</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <img
                                                                src="{{ asset('storage/setting/favicon/'.$setting->favicon) }}"
                                                                data-toggle="tooltip" data-placement="top" title=""
                                                                alt="Favicon"
                                                                class="rounded img-thumbnail" width="50px"
                                                                data-original-title="Favicon">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;Site Title</span>
                                            </div>
                                            <input type="text" name="sitetitle" value="{{ $setting->site_title }}"
                                                   class="form-control" aria-label="Default"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-envelope fa-lg"></i> &nbsp;Site Email</span>
                                            </div>
                                            <input type="email" name="siteemail" value="{{ $setting->site_email }}"
                                                   class="form-control" aria-label="Default"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-phone-square fa-lg"></i> &nbsp; Phone</span>
                                            </div>
                                            <input type="text" name="phone" value="{{ $setting->site_phone }}"
                                                   class="form-control"
                                                   aria-label="Default"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-mobile-phone fa-lg"></i> &nbsp; Mobile</span>
                                            </div>
                                            <input type="text" name="mobile" value="{{ $setting->site_mobile }}"
                                                   class="form-control" aria-label="Default"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-map-marker fa-lg"></i> &nbsp; Address</span>
                                            </div>
                                            <input type="text" value="{{ $setting->site_address }}" name="address"
                                                   class="form-control" aria-label="Default"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-fax fa-lg"></i> &nbsp; Fax</span>
                                            </div>
                                            <input type="text" value="{{ $setting->fax }}" name="fax"
                                                   class="form-control"
                                                   aria-label="Default"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                    @php
                                        $social = json_decode($setting->social_links,False);

                                    @endphp
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-facebook-square fa-lg"></i> &nbsp;Facebook Url</span>
                                            </div>
                                            <input type="text" name="facebook" value="{{ $social->facebook }}"
                                                   class="form-control" aria-label="Default"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-twitter fa-lg"></i> &nbsp;Twitter Url</span>
                                            </div>
                                            <input type="text" name="twitterurl" value="" disabled
                                                   class="form-control" aria-label="Default"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-instagram fa-lg"></i>&nbsp; Instagram Url</span>
                                            </div>
                                            <input type="text" name="instagram" value="{{ $social->instagram }}"
                                                   class="form-control" aria-label="Default"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-youtube-play fa-lg"></i>&nbsp; Youtube Url</span>
                                            </div>
                                            <input type="text" name="youtubeurl" value="{{ $setting->youtubeurl }}"
                                                   class="form-control" aria-label="Default" disabled
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-file-text-o fa-lg"></i>&nbsp; About Your Site</span>
                                            </div>
                                            <textarea class="form-control summernote" name="site_about"
                                                      aria-label="Default">{!! $setting->about!!}</textarea>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-map fa-lg"></i>&nbsp; Google Map Url</span>
                                            </div>
                                            <textarea name="googlemapurl" class="form-control" aria-label="Default"
                                                      aria-describedby="inputGroup-sizing-default">{{ $setting->googlemapurl }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-danger">Cancel</button>
                                <button style="float: right" type="submit" class="btn btn-outline-success">Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script src="{{ asset('backend/assets/vendor/summernote/dist/summernote.js') }}"></script>

@endpush