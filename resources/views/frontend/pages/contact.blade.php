@extends('frontend.layouts.master')
@section('main-content')
@section('title','Liên hệ')


    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.5177580567047!2d106.69916291428699!3d10.771600262229411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f40a3b49e59%3A0xa1bd14e483a602db!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEvhu7kgdGh14bqtdCBDYW8gVGjhuq9uZw!5e0!3m2!1svi!2s!4v1660243426947!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <h2>Liên hệ với K SHOP</h2>
                            <p>Hỗ trợ từ 9:00 - 21:00</p>
                        </div>
                        <ul>
                            @php
                                $settings=DB::table('settings')->get();
                            @endphp
                            @foreach($settings as $key=>$setting)
                            <li>
                                <h4>Email: {{$setting->email}}</h4>
                                <h4>Điện thoại: {{$setting->phone}}</h4>
                                <h4>Địa chỉ: {!! $setting->address!!}</h4>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="{{route('contact.submit')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Họ và tên của bạn">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="subject" placeholder="Chủ đề">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="phone" placeholder="Điện thoại">
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="message" placeholder="Nội dung bạn muốn gửi"></textarea>
                                    <button type="submit" class="site-btn">Gửi Tới KSHOP</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection