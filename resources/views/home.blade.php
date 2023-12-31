@extends('main')
@section('content')




<!-- Nav Bar Start -->

<!-- Nav Bar End -->

<!-- Bottom Bar Start -->

<!-- Bottom Bar End -->

<!-- Main Slider Start -->
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
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
            <div class="col-md-6">
                <div class="header-slider normal-slider">
                    <div class="header-slider-item d-flex align-items-center">
                        <img src="img/1_1_2.webp" alt="Slider Image" class="mx-auto" />
                        <div class="header-slider-caption">
                            <p>{{$categories[0]->name}}</p>
                            <a class="btn" href="/category/{{$categories[0]->id}}"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                        </div>
                    </div>
                    <div class="header-slider-item d-flex align-items-center">
                        <img src="img/1_1_3.webp" alt="Slider Image" class="mx-auto" />
                        <div class="header-slider-caption">
                            <p>{{$categories[1]->name}}</p>
                            <a class="btn" href="/category/{{$categories[1]->id}}"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                        </div>
                    </div>
                    <div class="header-slider-item d-flex align-items-center">
                        <img src="img/aa.jpg" alt="Slider Image" class="mx-auto" />
                        <div class="header-slider-caption">
                            <p>{{$categories[2]->name}}</p>
                            <a class="btn" href="/category/{{$categories[2]->id}}"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="header-img">
                    <div class="img-item">
                        <img src="img/1_1_4.jpg" />
                        <a class="img-text" href="/category/{{$categories[3]->id}}">
                            <p>{{$categories[3]->name}}</p>
                        </a>
                    </div>
                    <div class="img-item">
                        <img src="img/1_1_5.jpg" />
                        <a class="img-text" href="/category/{{$categories[4]->id}}">
                            <p>{{$categories[4]->name}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->

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

<!-- Feature Start-->
<div class="feature">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fab fa-cc-mastercard"></i>
                    <h2>Secure Payment</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur elit
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-truck"></i>
                    <h2>Worldwide Delivery</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur elit
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-sync-alt"></i>
                    <h2>90 Days Return</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur elit
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-comments"></i>
                    <h2>24/7 Support</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur elit
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End-->

<!-- Category Start-->
<div class="category">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="category-item ch-400">
                    <img src="img/1_1_2.webp" />
                    <a class="category-name" href="/category/{{$categories[0]->id}}">
                        <p>{{$categories[0]->name}}</p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-250">
                    <img src="img/1_1_3.webp" />
                    <a class="category-name" href="/category/{{$categories[1]->id}}">
                        <p>{{$categories[1]->name}}</p>
                    </a>
                </div>
                <div class="category-item ch-150">
                    <img src="img/aa.jpg" />
                    <a class="category-name" href="/category/{{$categories[2]->id}}">
                        <p>{{$categories[2]->name}}</p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-150">
                    <img src="img/1_1_4.jpg" />
                    <a class="category-name" href="/category/{{$categories[3]->id}}">
                        <p>{{$categories[3]->name}}</p>
                    </a>
                </div>
                <div class="category-item ch-250">
                    <img src="img/1_1_5.jpg" />
                    <a class="category-name" href="/category/{{$categories[4]->id}}">
                        <p>{{$categories[4]->name}}</p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-400">
                    <img src="img/1_7.jpeg" />
                    <a class="category-name" href="{{route('product')}}">
                        <p>All</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category End-->

<!-- Call to Action Start -->
<div class="call-to-action">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>call us for any queries</h1>
            </div>
            <div class="col-md-6">
                <a href="tel:0123456789">+012-345-6789</a>
            </div>
        </div>
    </div>
</div>
<!-- Call to Action End -->

<!-- Featured Product Start -->
<div class="featured-product product">
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
                        <a href="{{route('viewcheckoutbynow',['id'=>$product->id])}}" class="btn"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Featured Product End -->

<!-- Newsletter Start -->
<div class="newsletter">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>Subscribe Our Newsletter</h1>
            </div>
            <div class="col-md-6">
                <div class="form">
                    <input type="email" value="Your email here">
                    <button>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter End -->

<!-- Recent Product Start -->
<div class="recent-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>Discounted Product</h1>
        </div>
        <div class="row align-items-center product-slider product-slider-4">
            @foreach($products as $key => $product)
            @if($product->CategoryID == 7)

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
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
<!-- Recent Product End -->

<!-- Review Start -->
<div class="review">
    <div class="container-fluid">
        <div class="row align-items-center review-slider normal-slider">
            <div class="col-md-6">
                <div class="review-slider-item">
                    <div class="review-img">
                        <img src="img/review-1.jpg" alt="Image">
                    </div>
                    <div class="review-text">
                        <h2>Customer Name</h2>
                        <h3>Profession</h3>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo finibus luctus et vitae lorem
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="review-slider-item">
                    <div class="review-img">
                        <img src="img/review-2.jpg" alt="Image">
                    </div>
                    <div class="review-text">
                        <h2>Customer Name</h2>
                        <h3>Profession</h3>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo finibus luctus et vitae lorem
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="review-slider-item">
                    <div class="review-img">
                        <img src="img/review-3.jpg" alt="Image">
                    </div>
                    <div class="review-text">
                        <h2>Customer Name</h2>
                        <h3>Profession</h3>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo finibus luctus et vitae lorem
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Review End -->

<!-- Footer Start -->

<!-- Footer End -->



@endsection