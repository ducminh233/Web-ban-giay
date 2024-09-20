@extends('frontend.layouts.master')
@section('main-content')
@section('title','Thanh toán')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Thanh toán</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('home')}}">Trang Chủ</a>
                            <a href="{{route('product-grids')}}">Shop</a>
                            <span>Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{route('post.dathang')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                           
                            <h6 class="checkout__title">Chi tiết thanh toán</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Họ Tên<span>*</span></p>
                                        <input type="text" name="hoten">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email">
                                    </div>
                                </div>
                               
                            </div>
                            <div class="checkout__input">
                                <p>Điện thoại<span>*</span></p>
                                <input type="text" name="phone">
                            </div>
                            <div class="checkout__input">
                                <p>Tỉnh thành<span>*</span></p>
                                <input type="text" name="city" placeholder="Street Address" class="checkout__input__add">
                            </div>
                            <div class="checkout__input">
                                <p>Quận huyện<span>*</span></p>
                                <input type="text" name="district">
                            </div>
                            <div class="checkout__input">
                                <p>Phường xã<span>*</span></p>
                                <input type="text" name="ward">
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Ghi chú<span>*</span></p>
                                        <input type="text" name="address_detail">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Sảm Phẩm <span>Thành tiền</span></div>
                                <ul class="checkout__total__products">
                                    @if(Helper::getAllProductFromCart())
									@foreach(Helper::getAllProductFromCart() as $key=>$cart)
                                    <li>{{$cart->product['title']}} <span>{{number_format($cart['price']),2}}VNĐ</span></li>
                                    @endforeach
                                    @endif
                                </ul>
                                <ul class="checkout__total__all">
                                    <li class="shipping">
                                        @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                            <select name="shipping" class="nice-select">
                                                <option value="">Chọn đơn vị vận chuyển</option>
                                                @foreach(Helper::shipping() as $shipping)
                                                <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: {{number_format($shipping->price),2}}VNĐ</option>
                                                @endforeach
                                            </select>
                                        @else 
                                            <span>Miễn phí</span>
                                        @endif
                                    </li>
                                    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Tạm tính <span>{{number_format(Helper::totalCartPrice()),2}}VNĐ</span></li>
                                    <li>@if(session('coupon'))
                                        <li class="coupon_price" data-price="{{session('coupon')['value']}}">Khuyến mãi<span>{{number_format(session('coupon')['value']),2}}VNĐ</span></li>
                                        @endif
                                        @php
                                            $total_amount=Helper::totalCartPrice();
                                            if(session('coupon')){
                                                $total_amount=$total_amount-session('coupon')['value'];
                                            }
                                        @endphp
                                        @if(session('coupon'))
                                            <li class="last"  id="order_total_price">Tổng thanh toán<span>{{number_format($total_amount),2}}VNĐ</span></li>
                                        @else
                                            <li class="last"  id="order_total_price">Tổng thanh toán<span>{{number_format($total_amount),2}}VNĐ</span></li>
                                        @endif</li>
                                </ul>

                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                       Thanh toán khi nhận hàng
                                        <input type="checkbox" id="payment" name="payment" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal" name="payment" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
@push('styles')
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') ); 
				let coupon = parseFloat( $('.coupon_price').data('price')  ) || 0; 
				$('#order_total_price span').text((subtotal + cost-coupon).toFixed(2)+'VNĐ');
			});

		});

	</script>
@endpush