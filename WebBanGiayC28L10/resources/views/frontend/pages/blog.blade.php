@extends('frontend.layouts.master')
@section('title','Bài viết')
@section('main-content')
 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-blog set-bg" data-setbg="{{asset('frontend/img/breadcrumb-bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Bài viết</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            @foreach($posts as $key=>$post)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{$post->photo}}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{asset('frontend/img/icon/calendar.png')}}" alt="">{{$post->created_at->format('d,M,y')}}</span>
                        <h5>{{$post->title}}</h5>
                        <a href="{{route('blog.detail',$post->slug)}}">Đọc thêm</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Blog Section End -->

@endsection