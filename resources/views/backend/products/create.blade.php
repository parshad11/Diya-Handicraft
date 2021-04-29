@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        .label{
            border:1px solid #fff0ff;
        }
        .label-info{
            background-color:dodgerblue;
        }
        .label-info[href]:focus,.label-info[href]:hover{
            background-color:#31b0d5
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Create Products</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.list') }}">Products</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right ">
                    <a href="{{ route('products.list') }}" class="btn btn-sm btn-primary btn-round" title=""><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>
        {!! Form::open(array('route' => 'products.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        Product Title, Category, Price, Brand and Unit
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Enter Product Title
                                        </div>
                                    </div>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="input-group mb-3">
                                    <select name="category" id="category" class="form-control">
                                        <option value="default" selected>Choose Product Category</option>
                                        @foreach($categories as $key => $category)
                                            {{--@if($category->parent_id === 0)--}}
                                                {{--<option value="#" disabled--}}
                                                        {{--class="text-info font-weight-bold">{{$category->title}}</option>--}}
                                            {{--@else --}}
                                            <option value="{{$category->id}}"
                                            >{{$category->title}}</option>
                                            {{--@endif--}}
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Product Price
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            {{ env('CURRENCY')?? 'Nrs' }}
                                        </div>
                                    </div>
                                    <input type="number" name="price" class="form-control">

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Discount Price
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            {{ env('CURRENCY')?? 'Nrs' }}
                                        </div>
                                    </div>
                                    <input type="number" name="discount_price" class="form-control">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header ">
                        Product Variation/Quantity
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Color
                                        </div>
                                    </div>
                                    <select class="js-example-basic-multiple form-control" name="color[]"
                                            multiple="multiple">
                                        <option value="AliceBlue">AliceBlue</option>
                                        <option value="Amethyst">Amethyst</option>
                                        <option value="AntiqueWhite">AntiqueWhite</option>
                                        <option value="Aqua">Aqua</option>
                                        <option value="Aquamarine">Aquamarine</option>
                                        <option value="Azure">Azure</option>
                                        <option value="Beige">Beige</option>
                                        <option value="Bisque">Bisque</option>
                                        <option value="Black">Black</option>
                                        <option value="BlanchedAlmond">BlanchedAlmond</option>
                                        <option value="Blue">Blue</option>
                                        <option value="BlueViolet">BlueViolet</option>
                                        <option value="Brown">Brown</option>
                                        <option value="BurlyWood">BurlyWood</option>
                                        <option value="CadetBlue">CadetBlue</option>
                                        <option value="Chartreuse">Chartreuse</option>
                                        <option value="Chocolate">Chocolate</option>
                                        <option value="Coral">Coral</option>
                                        <option value="CornflowerBlue">CornflowerBlue</option>
                                        <option value="Cornsilk">Cornsilk</option>
                                        <option value="Crimson">Crimson</option>
                                        <option value="Cyan">Cyan</option>
                                        <option value="DarkBlue">DarkBlue</option>
                                        <option value="DarkCyan">DarkCyan</option>
                                        <option value="DarkGoldenrod">DarkGoldenrod</option>
                                        <option value="DarkGray">DarkGray</option>
                                        <option value="DarkGreen">DarkGreen</option>
                                        <option value="DarkKhaki">DarkKhaki</option>
                                        <option value="DarkMagenta">DarkMagenta</option>
                                        <option value="DarkOliveGreen">DarkOliveGreen</option>
                                        <option value="DarkOrange">DarkOrange</option>
                                        <option value="DarkOrchid">DarkOrchid</option>
                                        <option value="DarkRed">DarkRed</option>
                                        <option value="DarkSalmon">DarkSalmon</option>
                                        <option value="DarkSeaGreen">DarkSeaGreen</option>
                                        <option value="DarkSlateBlue">DarkSlateBlue</option>
                                        <option value="DarkSlateGray">DarkSlateGray</option>
                                        <option value="DarkTurquoise">DarkTurquoise</option>
                                        <option value="DarkViolet">DarkViolet</option>
                                        <option value="DeepPink">DeepPink</option>
                                        <option value="DeepSkyBlue">DeepSkyBlue</option>
                                        <option value="DimGray">DimGray</option>
                                        <option value="DodgerBlue">DodgerBlue</option>
                                        <option value="FireBrick">FireBrick</option>
                                        <option value="FloralWhite">FloralWhite</option>
                                        <option value="ForestGreen">ForestGreen</option>
                                        <option value="Fuchsia">Fuchsia</option>
                                        <option value="Gainsboro">Gainsboro</option>
                                        <option value="GhostWhite">GhostWhite</option>
                                        <option value="Gold">Gold</option>
                                        <option value="Goldenrod">Goldenrod</option>
                                        <option value="Gray">Gray</option>
                                        <option value="Green">Green</option>
                                        <option value="GreenYellow">GreenYellow</option>
                                        <option value="Honeydew">Honeydew</option>
                                        <option value="HotPink">HotPink</option>
                                        <option value="IndianRed">IndianRed</option>
                                        <option value="Indigo">Indigo</option>
                                        <option value="Ivory">Ivory</option>
                                        <option value="Khaki">Khaki</option>
                                        <option value="Lavender">Lavender</option>
                                        <option value="LavenderBlush">LavenderBlush</option>
                                        <option value="LawnGreen">LawnGreen</option>
                                        <option value="LemonChiffon">LemonChiffon</option>
                                        <option value="LightBlue">LightBlue</option>
                                        <option value="LightCoral">LightCoral</option>
                                        <option value="LightCyan">LightCyan</option>
                                        <option value="LightGoldenrodYellow">LightGoldenrodYellow</option>
                                        <option value="LightGreen">LightGreen</option>
                                        <option value="LightGrey">LightGrey</option>
                                        <option value="LightPink">LightPink</option>
                                        <option value="LightSalmon">LightSalmon</option>
                                        <option value="LightSalmon">LightSalmon</option>
                                        <option value="LightSeaGreen">LightSeaGreen</option>
                                        <option value="LightSkyBlue">LightSkyBlue</option>
                                        <option value="LightSlateGray">LightSlateGray</option>
                                        <option value="LightSteelBlue">LightSteelBlue</option>
                                        <option value="LightYellow">LightYellow</option>
                                        <option value="Lime">Lime</option>
                                        <option value="LimeGreen">LimeGreen</option>
                                        <option value="Linen">Linen</option>
                                        <option value="Magenta">Magenta</option>
                                        <option value="Maroon">Maroon</option>
                                        <option value="MediumAquamarine">MediumAquamarine</option>
                                        <option value="MediumBlue">MediumBlue</option>
                                        <option value="MediumOrchid">MediumOrchid</option>
                                        <option value="MediumPurple">MediumPurple</option>
                                        <option value="MediumSeaGreen">MediumSeaGreen</option>
                                        <option value="MediumSlateBlue">MediumSlateBlue</option>
                                        <option value="MediumSlateBlue">MediumSlateBlue</option>
                                        <option value="MediumSpringGreen">MediumSpringGreen</option>
                                        <option value="MediumTurquoise">MediumTurquoise</option>
                                        <option value="MediumVioletRed">MediumVioletRed</option>
                                        <option value="MidnightBlue">MidnightBlue</option>
                                        <option value="MintCream">MintCream</option>
                                        <option value="MistyRose">MistyRose</option>
                                        <option value="Moccasin">Moccasin</option>
                                        <option value="NavajoWhite">NavajoWhite</option>
                                        <option value="Navy">Navy</option>
                                        <option value="OldLace">OldLace</option>
                                        <option value="Olive">Olive</option>
                                        <option value="OliveDrab">OliveDrab</option>
                                        <option value="Orange">Orange</option>
                                        <option value="OrangeRed">OrangeRed</option>
                                        <option value="Orchid">Orchid</option>
                                        <option value="PaleGoldenrod">PaleGoldenrod</option>
                                        <option value="PaleGreen">PaleGreen</option>
                                        <option value="PaleTurquoise">PaleTurquoise</option>
                                        <option value="PaleVioletRed">PaleVioletRed</option>
                                        <option value="PapayaWhip">PapayaWhip</option>
                                        <option value="PeachPuff">PeachPuff</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Pink">Pink</option>
                                        <option value="Plum">Plum</option>
                                        <option value="PowderBlue">PowderBlue</option>
                                        <option value="Purple">Purple</option>
                                        <option value="Red">Red</option>
                                        <option value="RosyBrown">RosyBrown</option>
                                        <option value="RoyalBlue">RoyalBlue</option>
                                        <option value="SaddleBrown">SaddleBrown</option>
                                        <option value="Salmon">Salmon</option>
                                        <option value="SandyBrown">SandyBrown</option>
                                        <option value="SeaGreen">SeaGreen</option>
                                        <option value="Seashell">Seashell</option>
                                        <option value="Sienna">Sienna</option>
                                        <option value="Silver">Silver</option>
                                        <option value="SkyBlue">SkyBlue</option>
                                        <option value="SlateBlue">SlateBlue</option>
                                        <option value="SlateGray">SlateGray</option>
                                        <option value="Snow">Snow</option>
                                        <option value="SpringGreen">SpringGreen</option>
                                        <option value="SteelBlue">SteelBlue</option>
                                        <option value="Tan">Tan</option>
                                        <option value="Teal">Teal</option>
                                        <option value="Thistle">Thistle</option>
                                        <option value="Tomato">Tomato</option>
                                        <option value="Turquoise">Turquoise</option>
                                        <option value="Violet">Violet</option>
                                        <option value="Wheat">Wheat</option>
                                        <option value="White">White</option>
                                        <option value="WhiteSmoke">WhiteSmoke</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="YellowGreen">YellowGreen</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Size
                                        </div>
                                    </div>
                                    <select class="js-example-basic-multiple form-control " name="size[]"
                                            multiple="multiple">
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XS">XS</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                            <option value="3XL">3XL</option>
                                            <option value="4XL">4XL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Quantity
                                        </div>
                                    </div>
                                    <input type="text" name="quantity" class="form-control" required>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        Add Product Description
                    </div>
                    <div class="body">
                        <textarea class="form-control summernote" name="description"></textarea>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        Excerpt
                    </div>
                    <div class="body">
                        <textarea class="form-control summernote" name="excerpt_description"></textarea>
                    </div>
                </div>
                <br>
                <div class="card" id="optional">

                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Product Display & Featured Status
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><input type="checkbox" name="status" value="1"
                                                                             checked></div>
                                    </div>
                                    <input type="text" class="form-control" value="Display Status" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><input type="checkbox" name="feature" value="1"
                                                                             checked></div>
                                    </div>
                                    <input type="text" class="form-control" value="Featured Status" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-header">
                        Shipping and Tax
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Shipping Method
                                        </div>
                                    </div>
                                    <input type="text" name="shipping_method" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Shipping Charge
                                        </div>
                                    </div>
                                    <input type="number" name="shipping_charge" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            tax
                                        </div>
                                    </div>
                                    <input type="number" name="tax" class="form-control">


                                </div>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            Product Images
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col">
                                    <input type="file" name="image" class="dropify" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="alert alert-warning">
                                <i class="fa fa-warning"></i> Image Size Must Be 270 X 284 PX
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Featured Images
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col">
                                    <input type="file" name="featured_image" class="dropify" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="alert alert-warning">
                                <i class="fa fa-warning"></i> Image Size Must Be 270 X 284 PX
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" id="option" class="btn-btn info badge-info">Add Option</a>
            </div>

        </div>

        <div class="card">
            <div class="card-footer bg-white">
                <a href="{{ route('products.list') }}" class="btn btn-danger btn-sm">Cancel</a>
                <button type="submit" class="btn btn-success btn-sm" style="float: right" value="submit">Save
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>




    <script type="text/javascript">

        var i = 0;

        $("#add").click(function () {

            ++i;

            $("#dynamicTable").append('<tr><td><div class="row">\n' +
                '                            <div class="col-6">\n' +
                '                                <div class="input-group mb-3">\n' +
                '                                    <div class="input-group-prepend">\n' +
                '                                        <div class="input-group-text">\n' +
                '                                            Unit\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <input type="text" name="unit[]" class="form-control" required>\n' +
                '\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div class="col-5">\n' +
                '                                <div class="input-group mb-3">\n' +
                '                                    <div class="input-group-prepend">\n' +
                '                                        <div class="input-group-text">\n' +
                '                                            Quantity\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <input type="text" name="quantity[]" class="form-control" required>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div class="container1">\n' +
                '\n' +
                '                            </div>\n' +
                '                         \n' +
                '                        </div></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function () {
            $(this).parents('tr').remove();
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/summernote/dist/summernote.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('#option').click(function () {

                $.ajax({
                    url: "{{url('@dashboard@/product/addOption/')}}/",
                    cache: false,
                    complete: function ($response, $status) {
                        if ($status != "error" && $status != "timeout") {
                            $('#optional').append($response.responseText);
                        }
                    },
                    error: function ($responseObj) {
                        alert("Something went wrong while processing your request.\n\nError => "
                            + $responseObj.responseText);
                    }
                });
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id).remove();
            });
        });
    </script>






@endpush

