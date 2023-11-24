@extends('main')
@section('content')

@csrf

<!-- Nav Bar End -->

<!-- Bottom Bar Start -->

<!-- Bottom Bar End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Cart</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach($cartItems->list() as $key => $value)

                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="{{$value['image']}}" alt="Image"></a>
                                            <p>{{$value['name']}}</p>
                                        </div>
                                    </td>
                                    <td>{{number_format($value['price'])}}</td>
                                    <td>
                                        <div class="qty">
                                            <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="{{$value['quantity']}}">
                                            <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td>{{number_format($value['price'] * $value['quantity'])}}</td>
                                    @php
                                    $id = $value['productid'];
                                    @endphp
                                    <form action="/destroy/{{$id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input hidden name="id" value="{{$id}}">
                                        <td><button type="submit"><i class="fa fa-trash"></i></button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="coupon">
                                <input type="text" placeholder="Coupon Code">
                                <button>Apply Code</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>Cart Summary</h1>
                                    <p>Sub Total<span>{{ $cartItems->getTotalPrice()}}</span></p>
                                    <p>Shipping Cost<span>$1</span></p>
                                    <h2>Grand Total<span>{{ $cartItems->getTotalPrice()+1}}</span></h2>
                                </div>
                                <div class="cart-btn">
                                    <button>Update Cart</button>
                                    <button onclick="window.location.href = '/checkout'">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

<!-- Footer Start -->

<!-- Footer End -->

<!-- Footer Bottom Start -->



@endsection