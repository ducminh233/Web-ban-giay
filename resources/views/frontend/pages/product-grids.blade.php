@extends('frontend.layouts.master')
@section('title','Danh sách sản phẩm')
@section('main-content')
 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="{{route('home')}}">Trang chủ</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="{{route('product.search')}}" method="POST">
                            @csrf
                            <input type="text" name="search" placeholder="Nhập ở đây...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                                </div>
                                @php
                                    $categories=DB::table('categories')->where('status','active')->where('is_parent','1')->get();
                                @endphp
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                @foreach($categories as $key=>$cate)
                                                <li><a href="{{route('product-cat',$cate->slug)}}" value="{{$cate->id}}">{{$cate->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Thương hiệu</a>
                                </div>
                                @php
                                    $brands=DB::table('brands')->where('status','active')->get();
                                @endphp
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                @foreach ($brands as $brand)
                                                <li><a href="{{route('product-brand',$brand->slug)}}">{{$brand->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Kích cỡ (Size)</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__size">
                                            @for($i=35;$i<44;$i++)
                                            <label for="xs">{{$i}}
                                                <input type="radio" id="{{$i}}">
                                            </label>
                                            @endfor
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Tất cả có {{\App\Models\Product::countActiveProduct()}} Sản phẩm</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Lọc sản phẩm theo:</p>
                                <select>
                                    <option value="">Thấp đến cao</option>
                                    <option value="">Cao đến thấp</option>
                                    <option value="">Sản phẩm bán chạy</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            @php
                                $photo=explode(',',$product->photo);
                            @endphp
                            <div class="product__item__pic set-bg" data-setbg="{{$photo[0]}}">
                                <ul class="product__hover">
                                    <li><a href="{{route('add-to-wishlist',$product->slug)}}"><img src="{{asset('frontend/img/icon/heart.png')}}" alt=""></a></li>
                                    </li>
                                    <li><a href="{{route('product-detail',$product->slug)}}"><img src="{{asset('frontend/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{$product->title}}</h6>
                                <a href="{{route('add-to-cart',$product->slug)}}" class="add-cart">+Thêm vào giỏ</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
        
                                <h5>{{number_format($product->price),2}}VNĐ</h5>
                                <div class="product__color__select">
                                    <label for="pc-4">
                                        <input type="radio" id="pc-4">
                                    </label>
                                    <label class="active black" for="pc-5">
                                        <input type="radio" id="pc-5">
                                    </label>
                                    <label class="grey" for="pc-6">
                                        <input type="radio" id="pc-6">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <span>{{$products->links()}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
@endsection