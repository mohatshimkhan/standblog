@extends('frontend.layouts.app')

@section('content')
    
    <!-- Page Content -->

    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>Your search for</h4>
                <h2>"{{ request('query') }}"</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                
                @foreach($posts as $post)
                
                  <div class="col-lg-6">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="{{ asset('frontend/assets/images/blog_thumbs/'.$post->featured_image) }}" alt="">
                      </div>
                      <div class="down-content">
                        <span>{{ $post->category->name }}</span>
                        <a href="post-details.html"><h4>{{ $post->title }}</h4></a>
                        <ul class="post-info">
                          <li><a href="#">{{ $post->user->name }}</a></li>
                          <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                          <li><a href="#">{{ $post->comments_count }} Comments</a></li>
                        </ul>
                        <p>{{ substr($post->description, 0, 100) }}</p>
                        <div class="post-options">
                          <div class="row">
                            <div class="col-lg-12">
                              <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                @foreach($post->tags as $tag)
                                  <li><a href="#">{{ $tag->name }}</a>@if( !$loop->last), @endif</li>
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
                @endforeach
                
                <div class="col-lg-12">
                  <ul class="page-numbers">
                    
                    {{ $posts->links('pagination::bootstrap-4') }}
                    
                    <!--<li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>-->
                  </ul>
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