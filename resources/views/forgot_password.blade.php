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
                <div class="login-form">
                    <div class="row">@include('admin.alert')</div>
                    <div class="row">
                        <form class="row" action="{{route('sendNewPass')}}" method="GET">
                            @csrf
                            <div class="col-md-12">
                                <label>Email</label>
                                <input class="form-control" name="email" type="text" placeholder="Password">
                            </div>
                            <div class="col-md-12">
                                <label>New Password</label>
                                <input class="form-control" name="password" type="text" placeholder="Password">
                            </div>
                            <div class="col-md-12">
                                <label>Confirm New Password</label>
                                <input class="form-control" name="newPassword" type="text" placeholder="New Password">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn">Confirm</button>
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