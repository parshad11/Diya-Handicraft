@extends('frontend.includes.app')
@section('title','Account')
@section('content')

   

    <div class="container accounts">
        <div class="row">
            <div class="col-lg-3">
                <ul class="nav nav-pills">
                    <li class="col-lg-12">
                        <i></i>
                        <div class="user">
                            <i class="fas fa-user fa-2x mr-10"></i>
                            <div class="user-details">
                                <span class="username">{{Auth::user()->name}}</span>
                                <span class="email">{{Auth::user()->email}}</span>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-12 nav-item accounts-nav">
                        <a href="#zy" class="nav-link active" data-toggle="tab">Account Settings</a>
                    </li>
                    <li class="col-lg-12 nav-item accounts-nav"><a href="#xw" class="nav-link" data-toggle="tab">Shipping
                            Address</a></li>
                    <li class="col-lg-12 nav-item accounts-nav"><a href="#uv" class="nav-link" data-toggle="tab">Wish
                            List</a></li>
                    <li class="col-lg-12 nav-item accounts-nav"><a href="#st" class="nav-link" data-toggle="tab">My
                            Orders</a></li>
                </ul>
            </div>

            <div class="col-lg-9 tab-content clearfix">

                <div class="col-lg-12 tab-pane active accounts-content" id="zy">
                    <div class="row">
                        <div class="col-lg-6 accounts-content-settings">
                            <div class="settings-header">
                                <span class="settings-header-title">Account Information</span>
                                <a href="#" class="settings-header-edit">Edit</a>
                            </div>
                            <div class="settings-body">
                                <span class="settings-body-item">Name: <span
                                            class="settings-body-item-data">{{Auth::user()->name}}</span></span>
                                <span class="settings-body-item">Password:      <span class="settings-body-item-data"> ********</span></span>
                                <a href="#" class="settings-body-item">Change Password</a>
                            </div>

                        </div>
                        <div class="col-lg-6 accounts-content-settings">
                            <div class="settings-header">
                                <span class="settings-header-title">Personal Information</span>
                                <a href="#" class="settings-header-edit">Edit</a>
                            </div>
                            <div class="settings-body">
                                <span class="settings-body-item">Name: <span
                                            class="settings-body-item-data">{{Auth::user()->name}}</span></span>
                                <span class="settings-body-item">Gender:<span
                                            class="settings-body-item-data">{{ucfirst(Auth::user()->gender)}}</span></span>
                                <span class="settings-body-item">Date of birth:<span class="settings-body-item-data"> 00-00-0000</span></span>


                            </div>
                        </div>
                        <div class="col-lg-6 accounts-content-settings">
                            <div class="settings-header">
                                <span class="settings-header-title">Notification Settings</span>
                                <a href="#" class="settings-header-edit">Edit</a>
                            </div>
                            <div class="settings-body">
                                <span class="settings-body-item">Manage messages, emails and notifications the way you want</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 tab-pane" id="xw">
                    <h3>Address settings</h3>
                    <form>
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Last Name *</label>
                            <input type="text" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Country *</label>
                            <select class="form-input">
                                <option>Nepal</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>USA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>City *</label>
                            <select class="form-input">
                                <option>Kathmandu</option>
                                <option>Pokhara</option>
                                <option>Hetauda</option>
                                <option>Lalitpur</option>
                                <option>Bhaktapur</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Street Name/No *</label>
                            <input type="text" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Nearest Landmark *</label>
                            <input type="text" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Location Type *</label>
                            <select class="form-input">
                                <option>Home</option>
                                <option>Business</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mobile *</label>
                            <div class="input-group">
                                <span class="input-group-addon">+977</span>
                                <input type="text" class="form-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Landline *</label>
                            <div class="input-group">
                                <span class="input-group-addon">+977</span>
                                <input type="text" class="form-input">
                            </div>
                        </div>

                        <button type="submit">Submit</button>
                        <button type="submit">Cancel</button>
                    </form>


                </div>
                <div class="col-lg-12 tab-pane" id="uv">3.1</div>
                <div class="col-lg-12 tab-pane" id="st">4.1</div>
            </div>


        </div>

    </div>
@endsection
