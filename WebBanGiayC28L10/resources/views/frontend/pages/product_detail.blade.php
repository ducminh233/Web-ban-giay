@extends('frontend.layouts.master')
@section('title', 'Chi tiết sản phẩm')
@section('main-content')
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <a href="">Shop</a>
                            <span>Chi tiết sản phẩm</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            @php
                                $photo=explode(',',$product_detail->photo);
                            @endphp
                              @foreach($photo as $data)
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-{{$data}}" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{$data}}">
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                           
                            @php
                                $photo=explode(',',$product_detail->photo);
                            @endphp
                            <div class="tab-pane active" id="tabs-" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{$photo[0]}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product_detail->title }}k</h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span>{{\App\Models\ProductReview::countReview()}} Lượt Đánh Giá</span>
                            </div>
                            @php
                                $discount = ($product_detail->price - (($product_detail->price * $product_detail->discount) / 100));
                            @endphp
                            @if($product_detail->discount==0)
                            <h3> {{number_format($product_detail->price),2}}VNĐ</h3>
                            @else
                            <h3>{{ number_format($discount), 2 }}VNĐ<span>{{ number_format($product_detail->price), 2 }}VNĐ</span>
                                @endif
                            </h3>
                            <p>{!! $product_detail->summary !!}</p>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Kích cỡ:</span>
                                    @if ($product_detail->size)
                                        @php
                                            $sizes = explode(',', $product_detail->size);
                                        @endphp
                                        @foreach ($sizes as $size)
                                            <label for="xxl">{{ $size }}
                                                <input type="radio" id="{{ $size }}">
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <form action="{{route('single-add-to-cart')}}" method="POST">
                                    @csrf 
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="hidden" name="slug" value="{{$product_detail->slug}}">
                                        <input type="text" name="quant[1]" value="1" min="1">
                                    </div>
                                </div>
                              <button type="submit" class="primary-btn">Thêm vào giỏ hàng</button>
                            </form>
                            </div>
                     
                            <div class="product__details__btns__option">
                                <a href="{{ route('add-to-wishlist', $product_detail->slug) }}"><i
                                        class="fa fa-heart"></i>Thêm vào yêu thích</a>
                            </div>
                            <div class="product__details__last__option">
                               
                                <img src="{{asset('frontend/img/shop-details/details-payment.png')}}" alt="">
                                <ul>
                                    @php
                                        $categories = DB::table('categories')
                                            ->where('status', 'active')
                                            ->where('is_parent', '1')
                                            ->get();
                                    @endphp
                                    <li><span>Số lượng:</span> &emsp14;{{ $product_detail->stock }}</li>
                                    <li><span>Danh mục:</span> {{ $product_detail->cat_info['title'] }}</li>
                                    {{-- <li><span>Tag:</span> Clothes, Skin, Body</li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">
                                        Đánh Giá</a>
                                </li>
                                {{-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                information</a>
                            </li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">{!! $product_detail->description !!}</p>


                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product_info_content">

                                            <div class="fb-comments" data-href="{{ $url }}" data-width="650"
                                                data-numposts="7"></div>
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    {{-- <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Sản phẩm liên quan</h3>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                <li><a href="#"><img src="img/icon/compare.png" alt="">
                                        <span>Compare</span></a></li>
                                <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Piqué Biker Jacket</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$67.24</h5>
                            <div class="product__color__select">
                                <label for="pc-1">
                                    <input type="radio" id="pc-1">
                                </label>
                                <label class="active black" for="pc-2">
                                    <input type="radio" id="pc-2">
                                </label>
                                <label class="grey" for="pc-3">
                                    <input type="radio" id="pc-3">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> --}}
    <!-- Related Section End -->
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=958736781539672&autoLogAppEvents=1" nonce="3rr7Oget"></script>@endsection
@push('scripts')
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=958736781539672&autoLogAppEvents=1" nonce="3rr7Oget"></script>
@endpush
