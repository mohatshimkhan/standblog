@extends('frontend.layouts.app')


@section('content')
    
  <!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="main-banner header-text">
    <div class="container-fluid">
      <div class="owl-banner owl-carousel">
        <div class="item">
          <img src="assets/images/banner-item-01.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Fashion</span>
              </div>
              <a href="post-details.html"><h4>Morbi dapibus condimentum</h4></a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 12, 2020</a></li>
                <li><a href="#">12 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-02.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Nature</span>
              </div>
              <a href="post-details.html"><h4>Donec porttitor augue at velit</h4></a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 14, 2020</a></li>
                <li><a href="#">24 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-03.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Lifestyle</span>
              </div>
              <a href="post-details.html"><h4>Best HTML Templates on TemplateMo</h4></a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 16, 2020</a></li>
                <li><a href="#">36 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-04.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Fashion</span>
              </div>
              <a href="post-details.html"><h4>Responsive and Mobile Ready Layouts</h4></a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 18, 2020</a></li>
                <li><a href="#">48 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-05.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Nature</span>
              </div>
              <a href="post-details.html"><h4>Cras congue sed augue id ullamcorper</h4></a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 24, 2020</a></li>
                <li><a href="#">64 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-06.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Lifestyle</span>
              </div>
              <a href="post-details.html"><h4>Suspendisse nec aliquet ligula</h4></a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 26, 2020</a></li>
                <li><a href="#">72 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Ends Here -->

  @include('frontend.call_to_action')

  <section class="blog-posts">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="all-blog-posts">
            <div class="row">

              @if($posts->isNotEmpty())

              	@foreach($posts as $post)

                  <div class="col-lg-12">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="{{ asset('frontend/assets/images/blog_posts/'.$post->featured_image) }}" alt="">
                      </div>
                      <div class="down-content">
                        <span>{{ $post->category->name }}</span>
                        <a href="{{ route('home.show', $post->id) }}"><h4>{{ $post->title }}</h4></a>
                        <ul class="post-info">
                          <li><a href="#">{{ $post->user->name }}</a></li>
                          <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                          <li><a href="#">{{ $post->comments_count }} Comments</a></li>
                        </ul>
                        <p>{{ substr($post->description, 0, 100) }}</p>
                        
                        <div class="post-options">
                          <div class="row">
                            <div class="col-6">
                              <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                @foreach($post->tags as $tag)
                                <li><a href="#">{{ $tag->name }}</a>@if( !$loop->last), @endif</li>
                                @endforeach
                              </ul>
                            </div>
                        <!--<div class="col-6">
                              <ul class="post-share">
                                <li><i class="fa fa-share-alt"></i></li>
                                <li><a href="#">Facebook</a>,</li>
                                <li><a href="#"> Twitter</a></li>
                              </ul>
                            </div>-->
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                
                @endforeach

              @else

              <div class="row">
                <div class="col-lg-12">
                  No post available.
                </div>
              </div>

              @endif

              <div class="col-lg-12">
                <div class="main-button">
                  <a href="{{ route('home.blog') }}">View All Posts</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">

          @include('frontend.sidebar')

        </div>
      </div>
    </div>
  </section>



@endsection