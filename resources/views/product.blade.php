@extends('main')
@section('content')





<!-- Nav Bar Start -->

<!-- Nav Bar End -->

<!-- Bottom Bar Start -->

<!-- Bottom Bar End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('product')}}">Products</a></li>
            <li class="breadcrumb-item active">Product List</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product List Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="product-search">
                                        <input type="email" placeholder="Search">
                                        <button><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-short">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Product short by</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('productShortby', [
                                                    'category' => $category ? $category->id : null,
                                                    'sort_by' => 'updated_at',
                                                    'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc'
                                                ]) }}" class="dropdown-item">Newest</a>
                                                <a href="{{ route('productShortby', [
                                                    'category' => $category ? $category->id : null,
                                                    'sort_by' => 'Price',
                                                    'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc'
                                                ]) }}" class="dropdown-item">Price</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-price-range">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('productShortby', [
                                                    'category' => $category ? $category->id : null,
                                                    'sort_by' => 'Price',
                                                    'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                                    'max_price' => 20,

                                                ]) }}" class="dropdown-item">$0 to $20</a>
                                                <a href="{{ route('productShortby', [
                                                    'category' => $category ? $category->id : null,
                                                    'sort_by' => 'Price',
                                                    'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                                    'min_price' => 20,
                                                    'max_price' => 50,
                                                    
                                                ]) }}" class="dropdown-item">$20 to $50</a>
                                                <a href="{{ route('productShortby', [
                                                    'category' => $category ? $category->id : null,
                                                    'sort_by' => 'Price',
                                                    'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                                    'min_price' => 50,
                                                    'max_price' => 100,
                                                    
                                                ]) }}" class="dropdown-item">$50 to $100</a>
                                                <a href="{{ route('productShortby', [
                                                    'category' => $category ? $category->id : null,
                                                    'sort_by' => 'Price',
                                                    'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                                    'min_price' => 100,
                                                    'max_price' => 200,
                                                    
                                                ]) }}" class="dropdown-item">$100 to $200</a>
                                                <a href="{{ route('productShortby', [
                                                    'category' => $category ? $category->id : null,
                                                    'sort_by' => 'Price',
                                                    'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                                    'min_price' => 200,
                                                    'max_price' => 300,
                                                    
                                                ]) }}" class="dropdown-item">$200 to $300</a>
                                                <a href="{{ route('productShortby', [
                                                    'category' => $category ? $category->id : null,
                                                    'sort_by' => 'Price',
                                                    'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                                    'min_price' => 300,
                                                
                                                    
                                                ]) }}" class="dropdown-item">more than 300$</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($products as $key => $product)
                    <div class="col-md-4">
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
                                <a href="/product/{{$product->id}}'">
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
                    @endforeach

                </div>

                <!-- Pagination Start -->
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination Start -->
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
                                <a href="#">{{$product->Name}}</a>
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
                                    <form method="POST" action="">
                                        @csrf
                                        <a href="#" onclick="add_cart('{{$product->id}}', '/add-cart')"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                    </form>
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
<!-- Product List End -->

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


@endsection