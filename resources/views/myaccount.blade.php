@extends('main')
@section('content')


<!-- Top bar End -->

<!-- Nav Bar Start -->

<!-- Nav Bar End -->

<!-- Bottom Bar Start -->

<!-- Bottom Bar End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">My Account</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- My Account Start -->
<div class="my-account">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    @if ($customer->role == 'seller')
                    <a class="nav-link" id="dashboard-nav" data-toggle="pill" href="{{ $customer->role == 'seller' ? '#dashboard-tab' : '#upgrade-seller-tab' }}" role="tab"> <i class="fa fa-tachometer-alt"></i>Dashboard</a>
                    @endif
                    <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i class="fa fa-shopping-bag"></i>Orders</a>
                    <a class="nav-link" id="payment-nav" data-toggle="pill" href="#payment-tab" role="tab"><i class="fa fa-credit-card"></i>Payment Method</a>
                    <a class="nav-link" id="address-nav" data-toggle="pill" href="#address-tab" role="tab"><i class="fa fa-map-marker-alt"></i>address</a>
                    <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i class="fa fa-user"></i>Account Details</a>
                    @if ($customer->role != 'seller')
                    <a class="nav-link" id="upgrade-seller-nav" data-toggle="pill" href="#upgrade-seller-tab" role="tab">
                        <i class="fa fa-arrow-up"></i>Upgrade to Seller
                    </a>
                    @endif
                    <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-sign-out-alt"></i>Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
                        <div class="container1 col-md-6 mt-5">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4><a class="nav-link" id="upgrade-seller-nav" data-toggle="pill" href="#upgrade-seller-tab" role="tab">
                                            <i class="fa fa-plus"></i>Add store
                                        </a></h4>
                                </div>
                                <div class="col-md-4">
                                    <button id="addProductBtn" class="btn btn-primary float-right mt-2">Add Product</button>

                                    <!-- Add Product Form -->
                                    <div id="addProductForm" class="add-product-form">
                                        <form action="{{route('addproduct1')}}" method="POST">
                                            @csrf

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="product">Product name</label>
                                                    <input type="text" name="Name" value="{{old('Name')}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Category</label>
                                                    <select class="form-control" name="CategoryID">
                                                        @foreach($menus as $menu)
                                                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="product">Price</label>
                                                    <input type="number" name="Price" value="{{old('Price')}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="Description" value="{{old('Description')}}" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="product">Image</label>
                                                <input type="file" name="thumb" id="upload" value="{{old('thumb')}}" class="form-control-file">
                                            </div>
                                            <div id="image_show">

                                            </div>
                                            <input type="hidden" name="thumb" id="thumb">
                                            <div class="form-group col-md-6">
                                                <label>Name of the store</label>
                                                <select class="form-control" name="shop_id">
                                                    @foreach($shops as $shop)
                                                    <option value="{{$shop->id}}">{{$shop->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Add product</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($shops as $shop)
                        <div class="container1 mt-5">
                            <h4>{{$shop->name}}</h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Sales Overview</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Sales charts or data can be displayed here -->
                                            @php
                                            $countFilteredResults = count(array_filter($resultArray, function ($result) use ($shop) {
                                            return $result['shopID'] == $shop->id;
                                            }));
                                            @endphp
                                            <p>Số lượng sản phẩm: {{$countFilteredResults}}</p>
                                            @php

                                            $totalOrderCount = array_sum(array_map(fn($result) => $result['shopID'] == $shop->id ? $result['orderCount'] : 0, $resultArray));
                                            @endphp

                                            <p>Tổng số lượng hàng đã bán: {{$totalOrderCount}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">

                                            <h4>Top Products</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- List of top-selling products -->
                                            @if (count($resultArray) > 0)
                                            <ul class="list-group">
                                                @foreach ($resultArray as $result)
                                                @if ($shop->id == $result['shopID'])
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Product: {{ $result['productName'] }}
                                                    <span class="badge badge-primary badge-pill">Order Count: {{ $result['orderCount'] }}</span>
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                            @else
                                            <p class="alert alert-warning">No product</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Product</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- List of recent orders -->
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px">ID</th>
                                                        <th>Product name</th>
                                                        <th>Category</th>
                                                        <th>Price</th>
                                                        <th>Description</th>
                                                        <th>Update</th>

                                                        <th style="width: 150px;">&nbsp</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($products as $key => $product)
                                                    @if($product->shop_id == $shop->id)
                                                    <tr>
                                                        <td>{{$product->id}}</td>
                                                        <td>{{$product->Name}}</td>
                                                        <td>{{$product->CategoryID }}</td>
                                                        <td>{{$product->Price }} </td>
                                                        <td>{{$product->Description }} </td>
                                                        <td>{{$product->updated_at }} </td>

                                                        <td>
                                                            <a href="#" class="btn btn-danger btn-sm" onclick="removeRow('{{ $product->id }}',' /destroy ')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                            <a class="btn btn-primary btn-sm edit-btn">
                                                                <i class=" fas fa-edit"></i>
                                                            </a>

                                                            <div class="edit-form">
                                                                <form action="/edit/{{$product->id}}" method="POST">
                                                                    @csrf
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label for="product">Product name</label>
                                                                                <input type="text" name="Name" value="{{ $product->Name }}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
                                                                            </div>

                                                                            <div class="form-group col-md-12">
                                                                                <label>Category</label>
                                                                                <select class="form-control" name="CategoryID">
                                                                                    @foreach($menus as $menu)
                                                                                    <option value="{{ $menu->id }}" {{ $product->CategoryID == $menu->id ? 'selected' : '' }}>
                                                                                        {{ $menu->name }}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group col-md-12">
                                                                                <label for="product">Price </label>
                                                                                <input type="number" name="Price" value="{{$product->Price}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Description</label>
                                                                            <textarea name="Description" value="{{$product->Description}}" class="form-control"></textarea>
                                                                        </div>
                                                                        <div class="form-group" id="image_show">
                                                                            <label for="product">Image</label>
                                                                            <input type="file" name="thumb" id="upload" class="form-control-file">
                                                                        </div>
                                                                        <div id="image_show">
                                                                            <a href="value=" {{$product->thumb}}" target="_blank">
                                                                                <img src="{{$product->thumb}}" width="200px">
                                                                            </a>
                                                                        </div>
                                                                        <input type="hidden" name="thumb" value="{{$product->thumb}}" id="thumb">

                                                                        <div class="card-footer">
                                                                            <button type="submit" class="btn btn-primary">Update product</button>
                                                                        </div>

                                                                </form>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderdetails as $key => $order)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        @php
                                        $productIdToFind = $order['ProductID'];
                                        $foundProduct = null;

                                        foreach ($products as $product) {
                                        if ($product['id'] == $productIdToFind) {
                                        $foundProduct = $product;
                                        break;
                                        }
                                        }
                                        @endphp
                                        <td>{{$foundProduct['Name']}}</td>
                                        <td>{{$foundProduct['updated_at'] }}</td>
                                        <td>{{$foundProduct['Price'] * $order['Quantity']}}</td>
                                        <td><button class="btn">View</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="payment-nav">
                        <h4>Payment Method</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non. Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien eget arcu rhoncus scelerisque.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="address-tab" role="tabpanel" aria-labelledby="address-nav">
                        <h4>Address</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Payment Address</h5>
                                <p>123 Payment Street, Los Angeles, CA</p>
                                <p>Mobile: 012-345-6789</p>
                                <button class="btn">Edit Address</button>
                            </div>
                            <div class="col-md-6">
                                <h5>Shipping Address</h5>
                                <p>123 Shipping Street, Los Angeles, CA</p>
                                <p>Mobile: 012-345-6789</p>
                                <button class="btn">Edit Address</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade  show active" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                        <h4>Account Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="{{$customer->FirstName}}">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="{{$customer->LastName}}">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="{{$customer->Phone}}">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="{{$customer->Email}}">
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="text" placeholder="Address">
                            </div>
                            <div class="col-md-12">
                                <button class="btn">Update Account</button>
                                <br><br>
                            </div>
                        </div>
                        <h4>Password change</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" type="password" placeholder="Current Password">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="New Password">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Confirm Password">
                            </div>
                            <div class="col-md-12">
                                <button class="btn">Save Changes</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="upgrade-seller-tab" role="tabpanel" aria-labelledby="upgrade-seller-nav">
                        <!-- Nội dung của tab -->
                        <h4>Name of the store</h4>
                        <form method="POST" action="{{ route('addShop') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control" name="name" type="text" placeholder="Name of the store">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" name="" type="text" placeholder="Address">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" placeholder="{{$customer->Phone}}">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" placeholder="{{$customer->Email}}">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn">create a store</button>
                                    <br><br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Account End -->

    <!-- Footer Start -->

    <!-- Footer End -->

    <!-- Footer Bottom Start -->

    <!-- Footer Bottom End -->


    @endsection