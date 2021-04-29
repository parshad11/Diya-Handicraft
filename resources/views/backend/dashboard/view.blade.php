@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">

                <div class="col-md-6 col-sm-12">
                    <h1>Dashboard</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <div class="card planned_task">
            <div class="body bg-transparent">
                <div class="row">
                    <h6>Dashboard Content</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
