@extends('main')
@section('content')




<!-- Bottom Bar Start -->
<!-- Bottom Bar End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Login & Register</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="register-form">
                    <div class="row">@include('admin.alert')</div>
                    <div class="row">

                        <form id="reloadSection" class="row" action="/send" method="post">
                            @csrf
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input class="form-control" name="firstName" type="text" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input class="form-control" name="lastName" type="text" placeholder="Last Name">
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input class="form-control" name="email" type="text" placeholder="E-mail">
                            </div>
                            <div class="col-md-6">
                                <label>Mobile No</label>
                                <input class="form-control" name="phone" type="text" placeholder="Mobile No">
                            </div>
                            <div class="col-md-6">
                                <label>Password</label>
                                <input class="form-control" name="password" type="text" placeholder="Password">
                            </div>
                            <div class="col-md-6">
                                <label>Retype Password</label>
                                <input class="form-control" name="confirmPassword" type="text" placeholder="Password">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" onclick="reloadSection()" class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-form">
                    <div class="row">
                        <form class="row" action="{{route('mainlogin')}}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <label>E-mail / Username</label>
                                <input class="form-control" name="email" type="text" placeholder="E-mail / Username">
                            </div>
                            <div class="col-md-6">
                                <label>Password</label>
                                <input class="form-control" name="password" type="text" placeholder="Password">
                            </div>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="newaccount">
                                    <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->

<!-- Footer Start -->

<!-- Footer End -->

<!-- Footer Bottom Start -->

<!-- Footer Bottom End -->



@endsection