@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        .label {
            border: 1px solid #fff0ff;
        }

        .label-info {
            background-color: dodgerblue;
        }

        .label-info[href]:focus, .label-info[href]:hover {
            background-color: #31b0d5
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Edit Products</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.list') }}">Products</a></li>
                            <li class="breadcrumb-item active">edit</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right ">
                    <a href="{{ route('products.list') }}" class="btn btn-sm btn-primary btn-round" title=""><i
                                class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>
        {!! Form::open(array('route' => 'products.update','method'=>'POST','enctype'=>'multipart/form-data')) !!}
        <input type="hidden" name="id" value="{{ base64_encode($product->id) }}">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        Product Title, Category and Price
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Enter Product Title
                                        </div>
                                    </div>
                                    <input type="text" name="title" value="{{$product->title}}" class="form-control"
                                           required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <select name="category" id="category" class="form-control">
                                        <option value="default" selected>Choose Product Category</option>
                                        @foreach($categories as $key => $category)
                                            {{-- @if($category->parent_id === 0)
                                                <option value="#" disabled
                                                        class="text-info font-weight-bold">{{$category->title}}</option>
                                            @else --}}
                                            <option value="{{$category->id}}"
                                                    @if($category->id === $product->category_id) selected @endif>{{$category->title}}</option>
                                            {{-- @endif --}}
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
                                    <input type="number" name="price" value="{{$product->price}}" class="form-control">

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
                                    <input type="number" name="discount_price" value="{{$product->discount_price}}"
                                           class="form-control">

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
                                    <?php
                                    $color = explode(",", $product->color);
                                    $count = count($color);

                                    ?>

                                    <select class="js-example-basic-multiple form-control" name="color[]"
                                            multiple="multiple">
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='AliceBlue') selected @endif @endfor value="AliceBlue">
                                                AliceBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Amethyst') selected @endif @endfor value="Amethyst">
                                                Amethyst
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='AntiqueWhite') selected
                                                    @endif @endfor value="AntiqueWhite">AntiqueWhite
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Aqua') selected @endif @endfor value="Aqua">Aqua</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Aquamarine') selected @endif @endfor value="Aquamarine">
                                                Aquamarine
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Azure') selected @endif @endfor value="Azure">Azure
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Beige') selected @endif @endfor value="Beige">Beige
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Bisque') selected @endif @endfor value="Bisque">Bisque
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Black') selected @endif @endfor value="Black">Black
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='BlanchedAlmond') selected
                                                    @endif @endfor value="BlanchedAlmond">BlanchedAlmond
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Blue') selected @endif @endfor value="Blue">Blue</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='BlueViolet') selected @endif @endfor value="BlueViolet">
                                                BlueViolet
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Brown') selected @endif @endfor value="Brown">Brown
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='BurlyWood') selected @endif @endfor value="BurlyWood">
                                                BurlyWood
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='CadetBlue') selected @endif @endfor value="CadetBlue">
                                                CadetBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Chartreuse') selected @endif @endfor value="Chartreuse">
                                                Chartreuse
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Chocolate') selected @endif @endfor value="Chocolate">
                                                Chocolate
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Coral') selected @endif @endfor value="Coral">Coral
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='CornflowerBlue') selected
                                                    @endif @endfor value="CornflowerBlue">CornflowerBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Cornsilk') selected @endif @endfor value="Cornsilk">
                                                Cornsilk
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Crimson') selected @endif @endfor value="Crimson">Crimson
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Cyan') selected @endif @endfor value="Cyan">Cyan</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkBlue') selected @endif @endfor value="DarkBlue">
                                                DarkBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkCyan') selected @endif @endfor value="DarkCyan">
                                                DarkCyan
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkGoldenrod') selected
                                                    @endif @endfor value="DarkGoldenrod">DarkGoldenrod
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkGray') selected @endif @endfor value="DarkGray">
                                                DarkGray
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkGreen') selected @endif @endfor value="DarkGreen">
                                                DarkGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkKhaki') selected @endif @endfor value="DarkKhaki">
                                                DarkKhaki
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkMagenta') selected @endif @endfor value="DarkMagenta">
                                                DarkMagenta
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkOliveGreen') selected
                                                    @endif @endfor value="DarkOliveGreen">DarkOliveGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkOrange') selected @endif @endfor value="DarkOrange">
                                                DarkOrange
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkOrchid') selected @endif @endfor value="DarkOrchid">
                                                DarkOrchid
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkRed') selected @endif @endfor value="DarkRed">DarkRed
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkSalmon') selected @endif @endfor value="DarkSalmon">
                                                DarkSalmon
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkSeaGreen') selected
                                                    @endif @endfor value="DarkSeaGreen">DarkSeaGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkSlateBlue') selected
                                                    @endif @endfor value="DarkSlateBlue">DarkSlateBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkSlateGray') selected
                                                    @endif @endfor value="DarkSlateGray">DarkSlateGray
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkTurquoise') selected
                                                    @endif @endfor value="DarkTurquoise">DarkTurquoise
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DarkViolet') selected @endif @endfor value="DarkViolet">
                                                DarkViolet
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DeepPink') selected @endif @endfor value="DeepPink">
                                                DeepPink
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DeepSkyBlue') selected @endif @endfor value="DeepSkyBlue">
                                                DeepSkyBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DimGray') selected @endif @endfor value="DimGray">DimGray
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='DodgerBlue') selected @endif @endfor value="DodgerBlue">
                                                DodgerBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='FireBrick') selected @endif @endfor value="FireBrick">
                                                FireBrick
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='FloralWhite') selected @endif @endfor value="FloralWhite">
                                                FloralWhite
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='ForestGreen') selected @endif @endfor value="ForestGreen">
                                                ForestGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Fuchsia') selected @endif @endfor value="Fuchsia">Fuchsia
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Gainsboro') selected @endif @endfor value="Gainsboro">
                                                Gainsboro
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='GhostWhite') selected @endif @endfor value="GhostWhite">
                                                GhostWhite
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Gold') selected @endif @endfor value="Gold">Gold</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Goldenrod') selected @endif @endfor value="Goldenrod">
                                                Goldenrod
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Gray') selected @endif @endfor value="Gray">Gray</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Green') selected @endif @endfor value="Green">Green
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='GreenYellow') selected @endif @endfor value="GreenYellow">
                                                GreenYellow
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Honeydew') selected @endif @endfor value="Honeydew">
                                                Honeydew
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='HotPink') selected @endif @endfor value="HotPink">HotPink
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='IndianRed') selected @endif @endfor value="IndianRed">
                                                IndianRed
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Indigo') selected @endif @endfor value="Indigo">Indigo
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Ivory') selected @endif @endfor value="Ivory">Ivory
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Khaki') selected @endif @endfor value="Khaki">Khaki
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Lavender') selected @endif @endfor value="Lavender">
                                                Lavender
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LavenderBlush') selected
                                                    @endif @endfor value="LavenderBlush">LavenderBlush
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LawnGreen') selected @endif @endfor value="LawnGreen">
                                                LawnGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LemonChiffon') selected
                                                    @endif @endfor value="LemonChiffon">LemonChiffon
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightBlue') selected @endif @endfor value="LightBlue">
                                                LightBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightCoral') selected @endif @endfor value="LightCoral">
                                                LightCoral
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightCyan') selected @endif @endfor value="LightCyan">
                                                LightCyan
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightGoldenrodYellow') selected
                                                    @endif @endfor value="LightGoldenrodYellow">LightGoldenrodYellow
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightGreen') selected @endif @endfor value="LightGreen">
                                                LightGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightGrey') selected @endif @endfor value="LightGrey">
                                                LightGrey
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightPink') selected @endif @endfor value="LightPink">
                                                LightPink
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightSalmon') selected @endif @endfor value="LightSalmon">
                                                LightSalmon
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightSalmon') selected @endif @endfor value="LightSalmon">
                                                LightSalmon
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightSeaGreen') selected
                                                    @endif @endfor value="LightSeaGreen">LightSeaGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightSkyBlue') selected
                                                    @endif @endfor value="LightSkyBlue">LightSkyBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightSlateGray') selected
                                                    @endif @endfor value="LightSlateGray">LightSlateGray
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightSteelBlue') selected
                                                    @endif @endfor value="LightSteelBlue">LightSteelBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LightYellow') selected @endif @endfor value="LightYellow">
                                                LightYellow
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Lime') selected @endif @endfor value="Lime">Lime</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='LimeGreen') selected @endif @endfor value="LimeGreen">
                                                LimeGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Linen') selected @endif @endfor value="Linen">Linen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Magenta') selected @endif @endfor value="Magenta">Magenta
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Maroon') selected @endif @endfor value="Maroon">Maroon
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumAquamarine') selected
                                                    @endif @endfor value="MediumAquamarine">MediumAquamarine
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumBlue') selected @endif @endfor value="MediumBlue">
                                                MediumBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumOrchid') selected
                                                    @endif @endfor value="MediumOrchid">MediumOrchid
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumPurple') selected
                                                    @endif @endfor value="MediumPurple">MediumPurple
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumSeaGreen') selected
                                                    @endif @endfor value="MediumSeaGreen">MediumSeaGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumSlateBlue') selected
                                                    @endif @endfor value="MediumSlateBlue">MediumSlateBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumSlateBlue') selected
                                                    @endif @endfor value="MediumSlateBlue">MediumSlateBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumSpringGreen') selected
                                                    @endif @endfor value="MediumSpringGreen">MediumSpringGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumTurquoise') selected
                                                    @endif @endfor value="MediumTurquoise">MediumTurquoise
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MediumVioletRed') selected
                                                    @endif @endfor value="MediumVioletRed">MediumVioletRed
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MidnightBlue') selected
                                                    @endif @endfor value="MidnightBlue">MidnightBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MintCream') selected @endif @endfor value="MintCream">
                                                MintCream
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='MistyRose') selected @endif @endfor value="MistyRose">
                                                MistyRose
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Moccasin') selected @endif @endfor value="Moccasin">
                                                Moccasin
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='NavajoWhite') selected @endif @endfor value="NavajoWhite">
                                                NavajoWhite
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Navy') selected @endif @endfor value="Navy">Navy</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='OldLace') selected @endif @endfor value="OldLace">OldLace
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Olive') selected @endif @endfor value="Olive">Olive
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='OliveDrab') selected @endif @endfor value="OliveDrab">
                                                OliveDrab
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Orange') selected @endif @endfor value="Orange">Orange
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='OrangeRed') selected @endif @endfor value="OrangeRed">
                                                OrangeRed
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Orchid') selected @endif @endfor value="Orchid">Orchid
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='PaleGoldenrod') selected
                                                    @endif @endfor value="PaleGoldenrod">PaleGoldenrod
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='PaleGreen') selected @endif @endfor value="PaleGreen">
                                                PaleGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='PaleTurquoise') selected
                                                    @endif @endfor value="PaleTurquoise">PaleTurquoise
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='PaleVioletRed') selected
                                                    @endif @endfor value="PaleVioletRed">PaleVioletRed
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='PapayaWhip') selected @endif @endfor value="PapayaWhip">
                                                PapayaWhip
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='PeachPuff') selected @endif @endfor value="PeachPuff">
                                                PeachPuff
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Peru') selected @endif @endfor value="Peru">Peru</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Pink') selected @endif @endfor value="Pink">Pink</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Plum') selected @endif @endfor value="Plum">Plum</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='PowderBlue') selected @endif @endfor value="PowderBlue">
                                                PowderBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Purple') selected @endif @endfor value="Purple">Purple
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Red') selected @endif @endfor value="Red">Red</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='RosyBrown') selected @endif @endfor value="RosyBrown">
                                                RosyBrown
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='RoyalBlue') selected @endif @endfor value="RoyalBlue">
                                                RoyalBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='SaddleBrown') selected @endif @endfor value="SaddleBrown">
                                                SaddleBrown
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Salmon') selected @endif @endfor value="Salmon">Salmon
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='SandyBrown') selected @endif @endfor value="SandyBrown">
                                                SandyBrown
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='SeaGreen') selected @endif @endfor value="SeaGreen">
                                                SeaGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Seashell') selected @endif @endfor value="Seashell">
                                                Seashell
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Sienna') selected @endif @endfor value="Sienna">Sienna
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Silver') selected @endif @endfor value="Silver">Silver
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='SkyBlue') selected @endif @endfor value="SkyBlue">SkyBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='SlateBlue') selected @endif @endfor value="SlateBlue">
                                                SlateBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='SlateGray') selected @endif @endfor value="SlateGray">
                                                SlateGray
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Snow') selected @endif @endfor value="Snow">Snow</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='SpringGreen') selected @endif @endfor value="SpringGreen">
                                                SpringGreen
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='SteelBlue') selected @endif @endfor value="SteelBlue">
                                                SteelBlue
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Tan') selected @endif @endfor value="Tan">Tan</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Teal') selected @endif @endfor value="Teal">Teal</option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Thistle') selected @endif @endfor value="Thistle">Thistle
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Tomato') selected @endif @endfor value="Tomato">Tomato
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Turquoise') selected @endif @endfor value="Turquoise">
                                                Turquoise
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Violet') selected @endif @endfor value="Violet">Violet
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Wheat') selected @endif @endfor value="Wheat">Wheat
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='White') selected @endif @endfor value="White">White
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='WhiteSmoke') selected @endif @endfor value="WhiteSmoke">
                                                WhiteSmoke
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='Yellow') selected @endif @endfor value="Yellow">Yellow
                                            </option>
                                            <option @for ($i = 0; $i < $count; $i++) @if($color[$i]=='YellowGreen') selected @endif @endfor value="YellowGreen">
                                                YellowGreen
                                            </option>
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
                                    <?php
                                    $size = explode(",", $product->size);
                                    $count = count($size);

                                    ?>
                                    <select class="js-example-basic-multiple form-control" name="size[]"
                                            id="choice_attributes"
                                            multiple="multiple">

                                        <option @for ($i = 0; $i < $count; $i++) @if($size[$i]=='S') selected
                                                @endif @endfor value="S">S
                                        </option>
                                        <option @for ($i = 0; $i < $count; $i++) @if($size[$i]=='M') selected
                                                @endif @endfor value="M">M</option>
                                        <option @for ($i = 0; $i < $count; $i++) @if($size[$i]=='L') selected
                                                @endif @endfor value="L">L</option>
                                        <option @for ($i = 0; $i < $count; $i++) @if($size[$i]=='XS') selected
                                                @endif @endfor value="XS">XS</option>
                                        <option @for ($i = 0; $i < $count; $i++) @if($size[$i]=='XL') selected
                                                @endif @endfor value="XL">XL</option>
                                        <option @for ($i = 0; $i < $count; $i++) @if($size[$i]=='XXL') selected
                                                @endif @endfor value="XXL">XXL</option>
                                        <option @for ($i = 0; $i < $count; $i++) @if($size[$i]=='3XL') selected
                                                @endif @endfor value="3XL">3XL</option>
                                        <option @for ($i = 0; $i < $count; $i++) @if($size[$i]=='4XL') selected
                                                @endif @endfor value="4XL">4XL</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Quantity
                                        </div>
                                    </div>
                                    <input type="text" name="quantity" class="form-control"
                                           value="{{$product->quantity}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Add Product Description
                    </div>
                    <div class="body">
                        <textarea class="form-control summernote"
                                  name="description">{!! $product->description !!}</textarea>
                    </div>
                </div>
                <br>
                <br>
                <div class="card">
                    <div class="card-header">
                        Excerpt
                    </div>
                    <div class="body">
                        <textarea class="form-control summernote"
                                  name="excerpt_description">{!! $product->excerpt_description !!}</textarea>
                    </div>
                </div>
                <br>
                <div class="card" id="optional">

                </div>
                <div class="card" id="optional">

                    @php $options = json_decode($product->option);
                //   dd($options);
                    @endphp
                    @if(isset($options))
                        @foreach($options->option_title as $index=>$option )
                            <div class="col-06 body" id="row">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Enter Optional Title
                                        </div>
                                    </div>
                                    <input type="text" name="option_name[]" class="form-control" required=""
                                           value="{{$option}}">
                                    <button type="button" name="remove" id="" class="btn btn-danger btn_remove">
                                        <i class=" fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="body">
                                <textarea class="form-control summernote"
                                          name="option_value[]">{{$options->option_value[$index]}}</textarea>
                            </div>

                        @endforeach
                    @endif
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
                                                                             @if($product->status == 1) checked @endif>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="Display Status" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><input type="checkbox" name="feature" value="1"
                                                                             @if($product->feature) checked @endif>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="Featured Status" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><input type="checkbox" name="special" value="1"
                                                                             @if($product->special) checked @endif>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="Is Special" disabled>
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
                                    <input type="text" name="shipping_method" class="form-control"
                                           value="{{$product->shipping_method}}">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Shipping Charge
                                        </div>
                                    </div>
                                    <input type="number" name="shipping_charge" class="form-control"
                                           value="{{$product->shipping_charge}}">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            tax
                                        </div>
                                    </div>
                                    <input type="number" name="tax" class="form-control" value="{{$product->tax}}">

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
                                    <input type="file" name="image"
                                           data-default-file="{{ asset('storage/products/'.$product->slug.'/'.$product->image) }}"
                                           class="dropify">
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
        <div class="row">
            <div class="card">
                <div class="card-footer bg-white">
                    <a href="{{ route('products.list') }}" class="btn btn-danger btn-sm">Cancel</a>
                    <button type="submit" class="btn btn-success btn-sm" style="float: right" value="submit">Save
                    </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@push('scripts')

    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script type="text/javascript">
        function add_more_customer_choice_option(i, name) {
            $('#customer_choice_options').append('<div class="form-group row container"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" style="width: 100px; height: 35px;"  name="choice[]" value="' + name + '"  placeholder="Choice Title" disabled></div><div class="col-lg-5 ml-xl-5"><input type="text" class=" form-control" name="choice_options_' + i + '[]" placeholder="Enter choice values" data-role="tagsinput"  onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="fa fa-trash"></i></button></div></div>'
            );
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        function delete_row(em) {
            $(em).closest('.form-group').remove();
            update_sku();
        }

        function update_sku() {

        }

        $('#choice_attributes').on('change', function () {
            //$('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function (j, attribute) {
                flag = false;
                $('input[name="choice_no[]"]').each(function (i, choice_no) {
                    if ($(attribute).val() == $(choice_no).val()) {
                        flag = true;
                    }
                });
                if (!flag) {
                    add_more_customer_choice_option($(attribute).val(), $(attribute).text());
                }
            });

            var number = '@php echo $product->attribute @endphp';
            var str = number.split(',');
            $.each(str, function (index, value) {
                flag = false;
                $.each($("#choice_attributes option:selected"), function (j, attribute) {
                    if (value == $(attribute).val()) {
                        flag = true;
                    }
                });
                if (!flag) {
                    //console.log();
                    $('input[name="choice_no[]"][value="' + value + '"]').parent().parent().remove();
                }
            });

            update_sku();
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

