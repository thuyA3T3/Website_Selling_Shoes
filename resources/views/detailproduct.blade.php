@extends('main')
@section('content')



<!-- Bottom Bar End -->


<!-- Breadcrumb End -->

<!-- Product Detail Start -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                                <img src="{{$product->thumb}}" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title">
                                    <h2>{{$product->Name}}</h2>
                                </div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">
                                    <h4>Price:</h4>
                                    <p>${{$product->Price}} <span>${{$product->Price + 20.00}}</span></p>
                                </div>
                                <form action="{{route('addcart1')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <div class="quantity">
                                        <h4>Quantity:</h4>
                                        <div class="qty">
                                            <button class="btn-minus" type="button"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="1" name="quantity">
                                            <button class="btn-plus" type="button"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="p-size">
                                        <h4>Size:</h4>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn">S</button>
                                            <button type="button" class="btn">M</button>
                                            <button type="button" class="btn">L</button>
                                            <button type="button" class="btn">XL</button>
                                        </div>
                                    </div>
                                    <div class="p-color">
                                        <h4>Color:</h4>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn">White</button>
                                            <button type="button" class="btn">Black</button>
                                            <button type="button" class="btn">Blue</button>
                                        </div>
                                    </div>
                                    <div class="action">
                                        <button type="submit" class="btn" href="#"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
                                </form>
                                <a class="btn" href="{{route('viewcheckoutbynow',['id'=>$product->id])}}"><i class="fa fa-shopping-bag"></i>Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-info row">
                <div class="col-lg-1">
                    <img src="{{$shop->thumb}}" alt="{{ $shop->name }} Image" width="100px" height="100px" class="rounded-circle border border-danger">
                </div>
                <div class="col-lg-11">
                    <h2>{{$shop->name}}</h2>
                    <button type="button" class="btn btn-outline-primary">Chat Now</button>
                </div>
            </div>
            <div class="row product-detail-bottom">
                <div class="col-lg-12">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#specification">Specification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#reviews">Reviews (1)</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="description" class="container tab-pane active">
                            <h4>Product description</h4>
                            <p>
                                {{$product->Description}}
                            </p>
                        </div>
                        <div id="specification" class="container tab-pane fade">
                            <h4>Product specification</h4>
                            <ul>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Lorem ipsum dolor sit amet</li>
                            </ul>
                        </div>
                        <div id="reviews" class="container tab-pane fade">
                            <div class="reviews-submitted">
                                <div class="reviewer">Phasellus Gravida - <span>01 Jan 2020</span></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p>
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
                                </p>
                            </div>
                            <div class="reviews-submit">
                                <h4>Give your Review:</h4>
                                <div class="ratting">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <div class="row form">
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="email" placeholder="Email">
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea placeholder="Review"></textarea>
                                    </div>
                                    <div class="col-sm-12">
                                        <button>Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product">
                <div class="container-fluid">
                    <div class="section-header">
                        <h1>Featured Product</h1>
                    </div>
                    <div class="row align-items-center product-slider product-slider-4">
                        @foreach($products as $key => $product)
                        <div class="col-lg-3">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="/product/{{$product->id}}">{{$product->Name}}</a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="product-detail.html">
                                        <img src="{{$product->thumb}}" alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="/product/{{$product->id}}"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>$</span>{{$product->Price}}</h3>
                                    <a class="btn" href="{{route('viewcheckoutbynow',['id'=>$product->id])}}"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Bar Start -->
        <div class="col-lg-4 sidebar">
            <div class="sidebar-widget category">
                <h2 class="title">Category</h2>
                <nav class="navbar bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/"><i class="fa fa-home"></i>Home</a>
                        </li>
                        @foreach($categories as $key => $category)
                        <li class="nav-item">
                            <a class="nav-link" href="/category/{{$category->id}}"><i class="fa fa-dot-circle"></i></i></i>{{$category->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="sidebar-widget widget-slider">
                <div class="sidebar-slider normal-slider">
                    @foreach($products as $key => $product)
                    <div class="product-item">
                        <div class="product-title">
                            <a href="/product/{{$product->id}}">{{$product->Name}}</a>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <div class="product-image">
                            <a href="/product/{{$product->id}}">
                                <img src="{{$product->thumb}}" alt="Product Image">
                            </a>
                            <div class="product-action">
                                <a href="#" onclick="add_cart('{{$product->id}}', '/add-cart')"><i class="fa fa-cart-plus"></i></a>
                                <a href="#"><i class="fa fa-heart"></i></a>
                                <a href="/product/{{$product->id}}"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="product-price">
                            <h3><span>$</span>{{$product->Price}}</h3>
                            <a class="btn" href="{{route('viewcheckoutbynow',['id'=>$product->id])}}"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="sidebar-widget brands">
                <h2 class="title">Our Brands</h2>
                <ul>
                    <li><a href="#">Nulla </a><span>(45)</span></li>
                    <li><a href="#">Curabitur </a><span>(34)</span></li>
                    <li><a href="#">Nunc </a><span>(67)</span></li>
                    <li><a href="#">Ullamcorper</a><span>(74)</span></li>
                    <li><a href="#">Fusce </a><span>(89)</span></li>
                    <li><a href="#">Sagittis</a><span>(28)</span></li>
                </ul>
            </div>

            <div class="sidebar-widget tag">
                <h2 class="title">Tags Cloud</h2>
                <a href="#">Lorem ipsum</a>
                <a href="#">Vivamus</a>
                <a href="#">Phasellus</a>
                <a href="#">pulvinar</a>
                <a href="#">Curabitur</a>
                <a href="#">Fusce</a>
                <a href="#">Sem quis</a>
                <a href="#">Mollis metus</a>
                <a href="#">Sit amet</a>
                <a href="#">Vel posuere</a>
                <a href="#">orci luctus</a>
                <a href="#">Nam lorem</a>
            </div>
        </div>
        <!-- Side Bar End -->
    </div>
</div>
</div>
<!-- Product Detail End -->

<!-- Brand Start -->
<div class="brand">
    <div class="container-fluid">
        <div class="brand-slider">
            <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
        </div>
    </div>
</div>
<!-- Brand End -->

<!-- Footer Start -->
<!-- Footer End -->

<!-- Footer Bottom Start -->


@endsection