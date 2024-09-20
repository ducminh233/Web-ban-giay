 <!-- Page Preloder -->
 <div id="preloder">
     <div class="loader"></div>
 </div>

 <!-- Offcanvas Menu Begin -->
 <div class="offcanvas-menu-overlay"></div>
 <div class="offcanvas-menu-wrapper">
     <div class="offcanvas__option">
         <div class="offcanvas__links">
             @auth
                 <a href="{{ route('user.logout') }}">Đăng xuất</a>
             @else
                 <a href="{{ route('login.form') }}">Đăng nhập</a>
             @endauth

             {{-- <a href="#">FAQs</a> --}}
         </div>
     </div>
     <div class="offcanvas__nav__option">
         <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
         <a href="#"><img src="img/icon/heart.png" alt=""></a>
         <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
         <div class="price">$0.00</div>
     </div>
     <div id="mobile-menu-wrap"></div>
     <div class="offcanvas__text">
         <p>Free shipping, 30-day return or refund guarantee.</p>
     </div>
 </div>
 <!-- Offcanvas Menu End -->

 <!-- Header Section Begin -->
 <header class="header">
     <div class="header__top">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-md-7">
                    @php
                        $settings=DB::table('settings')->get();
                    @endphp
                     <div class="header__top__left">
                        @foreach ($settings as $setting)
                        <p>{!!$setting->description!!}</p>
                        @endforeach
                       
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-5">
                     <div class="header__top__right">
                         <div class="header__top__links">
                             @auth
                                 <a href="{{ route('user.logout') }}">Đăng xuất</a>
                                 <a href="#">Xin chào {{ Auth::user()->name }}</a>
                                 <a href="{{route('user')}}">Tài khoản</a>
                             @else
                                 <a href="{{ route('login.form') }}">Đăng nhập</a>
                                 <a href="{{ route('register.form') }}">Đăng ký</a>
                             @endauth
                             {{-- <a href="#">FAQs</a> --}}
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="container">
         <div class="row">
             <div class="col-lg-2 col-md-2">
                 <div class="header__logo">
                     <a href="{{route('home')}}">
                        @php
                            $logo=DB::table('settings')->get();
                        @endphp
                        @foreach ($logo as $key=>$logos)
                        <img src="{{$logos->logo}}" alt=""></a>
                        @endforeach
                       
                 </div>
             </div>
             <div class="col-lg-7 col-md-7">
                 <nav class="header__menu mobile-menu">
                     <ul>
                         <li class="active"><a href="{{route('home')}}">Trang chủ</a></li>
                         <li><a href="{{route('product-grids')}}">Sản phẩm</a></li>
                             {{-- <ul class="dropdown">
                                 <li><a href="./about.html">About Us</a></li>
                                 <li><a href="./shop-details.html">Shop Details</a></li>
                                 <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                 <li><a href="./checkout.html">Check Out</a></li>
                                 <li><a href="./blog-details.html">Blog Details</a></li>
                             </ul> --}}
                         </li>
                         <li><a href="{{route('blog')}}">Bài viết</a></li>
                         <li><a href="{{route('contact')}}">Liên hệ</a></li>
                         <li><a href="{{route('about-us')}}">About Us</a>
                     </ul>
                 </nav>
             </div>
             <div class="col-lg-3 col-md-3">
                 <div class="header__nav__option">
                     <a href="#" class="search-switch"><img src="{{asset('frontend/img/icon/search.png')}}" alt=""></a>
                     @auth
                     <a href="{{route('wishlist')}}"><img src="{{asset('frontend/img/icon/heart.png')}}" alt=""></a>
                     <a href="{{route('cart')}}"><img src="{{asset('frontend/img/icon/cart.png')}}" alt=""> <span>{{count(Helper::getAllProductFromCart())}}</span></a>
                     <div class="price">{{number_format(Helper::totalCartPrice()),2}}VNĐ</div>
                     @else
                     @endauth
                 </div>
             </div>
         </div>
         <div class="canvas__open"><i class="fa fa-bars"></i></div>
     </div>
 </header>
 <!-- Header Section End -->
