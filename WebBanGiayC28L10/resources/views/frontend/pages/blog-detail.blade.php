@extends('frontend.layouts.master')
@section('title','Chi tiết bài viết')
@section('main-content')
  <!-- Blog Details Hero Begin -->
  <section class="blog-hero spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9 text-center">
                <div class="blog__hero__text">
                    <h2>{{$post->title}}</h2>
                    <ul>
                        <li>By Deercreative</li>
                        <li>{{$post->created_at->format('d,M.y')}}</li>
                        <li>8 Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="{{$post->photo}}" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="blog__details__content">
                    <div class="blog__details__share">
                        <span>share</span>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="blog__details__text">
                        <p>{!!$post->summary !!}</p>
                        <p>{!!$post->description !!}</p>
                    </div>
                    {{-- <div class="blog__details__quote">
                        <i class="fa fa-quote-left"></i>
                        <p>“When designing an advertisement for a particular product many things should be
                            researched like where it should be displayed.”</p>
                        <h6>_ John Smith _</h6>
                    </div> --}}
                    <div class="blog__details__text">
                        <p>{!!$post->quote !!}</p>
                       
                    </div>
                    <div class="blog__details__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{asset('frontend/img/blog/details/blog-author.jpg')}}" alt="">
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="blog__details__comment">
                        <h4>Bình luận</h4>
                        <form action="{{route('post-comment.store',$post->slug)}}" method="POST">
                            @csrf
                            <div class="row">
                                {{-- <div class="col-lg-4 col-md-4">
                                    <input type="text" name="comment" placeholder="Nhập ở đây">
                                </div> --}}
                                {{-- <div class="col-lg-4 col-md-4">
                                    <input type="text" name="email" placeholder="Email">
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <input type="text" name="message" placeholder="Phone">
                                </div> --}}
                                <div class="col-lg-12 text-center">
                                    <textarea placeholder="Comment" name="comment"></textarea>
                                    <button type="submit" class="site-btn">Bình Luận</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->
@endsection