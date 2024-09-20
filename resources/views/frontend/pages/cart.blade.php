@extends('frontend.layouts.master')
@section('title', 'Giỏ hàng')
@section('main-content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <a href="{{route('product-grids')}}">Shop</a>
                            <span>Giỏ hàng của bạn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    @if (Helper::getAllProductFromCart())
                                        @foreach (Helper::getAllProductFromCart() as $key => $cart)
                                            <tr>
                                                @php
                                                    $photo = explode(',', $cart->product['photo']);
                                                @endphp
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img src="{{ $photo[0] }}" style="height: 100px"
                                                            alt="{{ $photo[0] }}">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <h6>{{ $cart->product['title'] }}</h6>
                                                        <h5>{{ number_format($cart['price']),2 }}VNĐ</h5>
                                                    </div>
                                                </td>
                                                <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <input type="text" name="quant[{{ $key }}]"
                                                                value="{{ $cart->quantity }}">
                                                            <input type="hidden" name="qty_id[]"
                                                                value="{{ $cart->id }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__price">{{ number_format($cart['amount']), 2 }}VNĐ</td>
                                                <td class="cart__close"><a
                                                        href="{{ route('cart-delete', $cart->id) }}"><i
                                                            class="fa fa-close" style="height: 40px"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('product-grids') }}">Tiếp tục mua hàng</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <button class="primary-btn" type="submit">Cập nhật giỏ hàng</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Mã giảm giá</h6>
                        <form action="{{ route('coupon-store') }}" method="POST">
                            @csrf
                            <input type="text" name="code" placeholder="Nhập mã giảm giá">
                            <button type="submit">Áp dụng</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cộng giỏ hàng</h6>
                        <ul>
                            @php
                                $total_amount = Helper::totalCartPrice();
                                if (session()->has('coupon')) {
                                    $total_amount = $total_amount - Session::get('coupon')['value'];
                                }
                            @endphp
                            <li data-price="{{ Helper::totalCartPrice() }}">Tạm tính
                                <span>{{ number_format(Helper::totalCartPrice()),2 }}VNĐ</span></li>
                            @if (session()->has('coupon'))
                                <li class="coupon_price" data-price="{{ Session::get('coupon')['value'] }}">Khuyến mãi
                                    <span>{{ number_format(Session::get('coupon')['value']),2 }}VNĐ</span></li>
                            @endif
                            @if (session()->has('coupon'))
                                <li>Tổng thanh toán <span>{{ number_format($total_amount), 2 }}VNĐ</span></li>
                            @else
                                <li>Tổng thanh toán <span>{{ number_format($total_amount), 2 }}VNĐ</span></li>
                            @endif
                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
@push('scripts')
    <script src="{{ asset('frontend/js/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("select.select2").select2();
        });
        $('select.nice-select').niceSelect();
    </script>
    <script>
        $(document).ready(function() {
            $('.shipping select[name=shipping]').change(function() {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;
                // alert(coupon);
                $('#order_total_price span').text('$' + (subtotal + cost - coupon).toFixed(2));
            });

        });
    </script>
@endpush
