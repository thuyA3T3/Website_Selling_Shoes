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
                    <a class="nav-link" id="dashboard-nav" data-toggle="pill" href="{{ $customer->role == 'seller' ? '#dashboard-tab' : '#upgrade-seller-tab' }}" role="tab"> <i class="fa fa-tachometer-alt"></i>Sales Channel</a>
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
                <div class="tab-pane fade" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">

                    <div class="container1 mt-5">
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

                    @foreach($shops as $index => $shop)
                    <div class="container1 mt-5">
                        <img src="{{ $shop->thumb ? $shop->thumb : 'img/1.webp' }}" alt="{{ $shop->name }} Image" width="100px" height="100px" class="rounded-circle border border-danger">
                        <h2>{{$shop->name}}
                            <a href="#" class="btn btn-danger btn-sm" onclick="removeRow('{{ $shop->id }}',' /shop/destroy ')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm btn-sm editShopBtn" data-target="{{ $index }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </h2>

                        <div id="editShop{{$index}}" class="form-group d-none bg-warning text-white p-4 rounded">
                            <form action="{{route('editShop',['id'=>$shop->id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="shop">Name Store</label>
                                        <input class="form-control" name="name" type="text" value="{{$shop->name}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shop">Avatar</label>
                                        <input type="file" name="thumb" id="upload{{$index}}" data-index="{{$index}}" value="{{$shop->thumb}}" class="upload1 form-control-file">
                                        <div class="image_show{{$index}} image_show"></div>
                                        <input type="hidden" name="thumb" class="thumb{{$index}}">
                                        <div class="col-md-12"></div>
                                    </div>
                                    <button type="submit" class="btn mx-auto">Update a store</button>
                                    <br><br>
                                </div>
                            </form>
                        </div>
                    </div>

                    <ul class="nav nav-pills nav-fill mt-5" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="inactive-tab active" id="revennue-nav{{$index}}" data-toggle="pill" href="#tab1{{$index}}" role="tab">Revenue</a>
                        </li>
                        <li class="nav-item">
                            <a class="inactive-tab" id="product-nav{{$index}}" data-toggle="pill" href="#tab2{{$index}}" role="tab">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="inactive-tab" id="orrder-nav{{$index}}" data-toggle="pill" href="#tab3{{$index}}" role="tab">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="inactive-tab" data-toggle="pill" href="#tab4" role="tab">Tab 4</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="revennue-nav{{$index}}" id="tab1{{$index}}">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card ">
                                        <div class="card-header ">
                                            <h4>Sales Overview</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Sales charts or data can be displayed here -->

                                            @foreach($totalRevenue as $totalRevenueItem)
                                            @if($totalRevenueItem['shopID'] == $shop->id)
                                            <h5>Sales channel revenue (Shop ID: {{ $totalRevenueItem['shopID'] }}): {{ $totalRevenueItem['totalRevenue'] }} $</h5>
                                            @endif
                                            @endforeach
                                            @php $countFilteredResults=count(array_filter($resultArray, function ($result) use ($shop) { return $result['shopID']==$shop->id;
                                            }));
                                            @endphp
                                            <p>The number of products: {{$countFilteredResults}}</p>
                                            @php

                                            $totalOrderCount = array_sum(array_map(fn($result) => $result['shopID'] == $shop->id ? $result['orderCount'] : 0, $resultArray));
                                            @endphp

                                            <p>Total quantity of goods sold: {{$totalOrderCount}}</p>
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
                        </div>
                        <div class="tab-pane fade" role="tabpanel" aria-labelledby="product-nav{{$index}}" id="tab2{{$index}}">
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
                        <div class="tab-pane fade" role="tabpanel" aria-labelledby="orrder-nav{{$index}}" id="tab3{{$index}}">

                            <div class="col-md-12">
                                <div id="myTabs1" class="nav nav-pills mt-5" role="tablist">
                                    <a href="#tab11{{$index}}" data-toggle="pill" id="pending{{$index}}" role="tab">Order awaiting confirmation</a>
                                    <a href="#tab12{{$index}}" data-toggle="pill" id="processing{{$index}}" role="tab">Order is being packed</a>
                                    <a href="#tab22{{$index}}" data-toggle="pill" id="shipped{{$index}}" role="tab">Order is being sent</a>
                                </div>
                            </div>

                            <div class="tab-content">
                                <!-- Tab content for "Order awaiting confirmation" -->
                                <div class="tab-pane fade show active" id="tab11{{$index}}" aria-labelledby="pending{{$index}}" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orderShop as $key => $order)
                                                @if($order['shopID'] == $shop->id)
                                                @if($order['orderStatus'] == 'pending')
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$order['productName']}}</td>
                                                    <td>{{$order['price']}}</td>
                                                    <td>{{$order['quantity']}}</td>
                                                    <td>{{$order['price'] * $order['quantity']}}</td>
                                                    <td>
                                                        @php
                                                        $orderID = $order['orderID']
                                                        @endphp
                                                        <button class="btn btn-success" onclick="handleSelect('{{$orderID}}','processing')">Confirm</button>
                                                        <button class="btn btn-danger" onclick="handleSelect('{{$orderID}}','failed')">Cancel</button>
                                                    </td>

                                                </tr>
                                                @endif
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab12{{$index}}" aria-labelledby="processing{{$index}}" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orderShop as $key => $order)
                                                @if($order['shopID'] == $shop->id)
                                                @if($order['orderStatus'] == 'processing')
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$order['productName']}}</td>
                                                    <td>{{$order['price']}}</td>
                                                    <td>{{$order['quantity']}}</td>
                                                    <td>{{$order['price'] * $order['quantity']}}</td>
                                                    <td>
                                                        @php
                                                        $orderID = $order['orderID']
                                                        @endphp
                                                        <button class="btn btn-success" onclick="handleSelect('{{$orderID}}','shipped')">Confirm</button>
                                                    </td>

                                                </tr>
                                                @endif
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <!-- Tab content for "Order is being sent" -->
                                <div class="tab-pane fade" id="tab22{{$index}}" aria-labelledby="shipped{{$index}}" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orderShop as $key => $order)
                                                @if($order['shopID'] == $shop->id)
                                                @if($order['orderStatus'] == 'shipped')
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$order['productName']}}</td>
                                                    <td>{{$order['price']}}</td>
                                                    <td>{{$order['quantity']}}</td>
                                                    <td>{{$order['price'] * $order['quantity']}}</td>
                                                    <td><button class="btn">View</button></td>
                                                </tr>
                                                @endif
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">

                    <div id="myTabs1" class="nav nav-pills mt-5" role="tablist">
                        <a href="#tab111" data-toggle="pill" id="order1" role="tab">Order placed</a>
                        <a href="#tab222" data-toggle="pill" id="order2" role="tab">Order has been completed</a>
                        <a href="#tab333" data-toggle="pill" id="order3" role="tab">Order has been cancelled</a>
                    </div>

                    <div class="tab-content mt-5">
                        <div class="tab-pane fade show active" id="tab111" aria-labelledby="order1" role="tabpanel">
                            <div class="table-responsive mt-5">
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
                                        @php
                                        $foundOrder = null;
                                        foreach ($orders as $orderSta) {
                                        if ($orderSta['id'] == $order['OrderID']) {
                                        $foundOrder = $orderSta;
                                        break;
                                        }
                                        }
                                        $orderSelect = $order['OrderID'];
                                        @endphp
                                        @if($orderSta['status'] != 'failed' && $orderSta['status'] != 'complete' )
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$foundProduct['Name']}}</td>
                                            <td>{{$order['Quantity']}}</td>
                                            <td>{{$foundProduct['Price'] * $order['Quantity']}}</td>
                                            <td><button id="viewStatus{{$key}}" class="btn view-status-btn" data-target="{{$key}}">View</button></td>


                                            <div id="orderStatus{{$key}}" class="order-status" style="display: none;">
                                                <h2 class="text-center mb-4">Trạng thái đơn hàng</h2>

                                                <div class="row">
                                                    <div class="col-md-3" id="pending">
                                                        <div class="status-item {{ $orderSta['status'] == 'pending' ? 'bg-warning border-danger text-white' : 'bg-light border-secondary' }}">
                                                            <i class="fas fa-hourglass-start"></i>
                                                            <h3>Chờ xác nhận</h3>
                                                            <p>Chờ xác nhận đơn hàng từ cửa hàng.</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" id="processing">
                                                        <div class="status-item {{ $orderSta['status'] == 'processing' ? 'bg-warning border-warning text-white' : 'bg-light border-secondary' }}">
                                                            <i class="fas fa-cogs"></i>
                                                            <h3>Đang xử lý</h3>
                                                            <p>Đơn hàng của bạn đang được xử lý.</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" id="shipped">
                                                        <div class="status-item {{ $orderSta['status'] == 'shipped' ? 'bg-info border-info text-white' : 'bg-light border-secondary' }}">
                                                            <i class="fas fa-shipping-fast"></i>
                                                            <h3>Đã gửi đi</h3>
                                                            <p>Đơn hàng của bạn đã được gửi đi và đang trên đường đến bạn.</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" id="complete">
                                                        <div class="status-item {{ $orderSta['status'] == 'complete' ? 'bg-success border-success text-white' : 'bg-light border-secondary' }}">
                                                            <i class="fas fa-check-circle"></i>
                                                            <h3>Đã nhận hàng</h3>
                                                            <p>Đơn hàng của bạn đã được nhận thành công.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($orderSta['status'] == 'pending')
                                                <button class="btn btn-danger mx-auto d-block" onclick="handleSelect('{{$orderSelect}}', 'failed')">Cancel order</button>
                                                @else
                                                <button class="btn btn-secondary mx-auto d-block" disabled>Order cannot be canceled</button>
                                                @endif
                                                <!-- Thêm các trạng thái khác tùy thuộc vào yêu cầu -->
                                            </div>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab222" aria-labelledby="order2" role="tabpanel">
                            <div class="table-responsive mt-5">
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
                                        @php
                                        $foundOrder = null;
                                        foreach ($orders as $orderSta) {
                                        if ($orderSta['id'] == $order['OrderID']) {
                                        $foundOrder = $orderSta;
                                        break;
                                        }
                                        }
                                        $orderProductID = $order['ProductID'];
                                        @endphp
                                        @if($orderSta['status'] == 'complete')
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$foundProduct['Name']}}</td>
                                            <td>{{$order['Quantity']}}</td>
                                            <td>{{$foundProduct['Price'] * $order['Quantity']}}</td>
                                            <td><button class="btn" onclick="redirectToReviews('{{$orderProductID}}')">Products review</button></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab333" aria-labelledby="order3" role="tabpanel">
                            <div class="table-responsive mt-5">
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
                                        @php
                                        $foundOrder = null;
                                        foreach ($orders as $orderSta) {
                                        if ($orderSta['id'] == $order['OrderID']) {
                                        $foundOrder = $orderSta;
                                        break;
                                        }
                                        }
                                        $orderSelect = $order['OrderID'];
                                        @endphp
                                        @if($orderSta['status']== 'failed')
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$foundProduct['Name']}}</td>
                                            <td>{{$order['Quantity']}}</td>
                                            <td>{{$foundProduct['Price'] * $order['Quantity']}}</td>
                                            <td><button class="btn btn-danger mx-auto d-block" onclick="handleSelect('{{$orderSelect}}', 'pending')">Re-Order</button></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                    <div class="row">@include('admin.alert')</div>
                    <h4>Account Details</h4>
                    <div class="row">
                        <form class="row" action="{{route('updateUser')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <input class="form-control" value="{{$customer->FirstName}}" name="firstName" type="text" placeholder="{{$customer->FirstName}}">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" value="{{$customer->LastName}}" name="lastName" type="text" placeholder="{{$customer->LastName}}">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" value="{{$customer->Phone}}" name="phone" type="text" placeholder="{{$customer->Phone}}">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="{{$customer->Email}}">
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="address" value="{{$customer->address}}" type="text" placeholder="Address">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn">Update Account</button>
                                <br><br>
                            </div>
                        </form>
                    </div>
                    <h4>Password change</h4>
                    <div class="row">
                        <form class="row" action="{{route('updatePassword')}}" method="Post">
                            @csrf
                            <div class="col-md-12">
                                <input class="form-control" name="oldPassword" type="password" placeholder="Current Password">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" name="newPassword" type="text" placeholder="New Password">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" name="confirmPassword" type="text" placeholder="Confirm Password">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn">Save Changes</button>
                            </div>
                        </form>
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