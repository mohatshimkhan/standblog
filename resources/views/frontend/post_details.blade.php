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
              <h4>Post Details</h4>
              <h2>Single blog post</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    
  <!-- Banner Ends Here -->

  @include('frontend.call_to_action')

  <section class="blog-posts grid-system">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="all-blog-posts">
            <div class="row">
              <div class="col-lg-12">
                <div class="blog-post">
                  <div class="blog-thumb">
                    <img src="{{ asset('frontend/assets/images/blog_posts/'.$post->featured_image) }}" alt="">
                  </div>
                  <div class="down-content">
                    <span>{{ $post->category->name }}</span>
                    <a href="post-details.html"><h4>{{ $post->title }}</h4></a>
                    <ul class="post-info">
                      <li><a href="#">{{ $post->user->name }}</a></li>
                      <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                      <li><a href="#">{{ $post->comments_count }} Comments</a></li>
                    </ul>
                    <p>{{ $post->description }}</p>
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
                        <div class="col-6">
                      <!--<ul class="post-share">
                            <li><i class="fa fa-share-alt"></i></li>
                            <li><a href="#">Facebook</a>,</li>
                            <li><a href="#"> Twitter</a></li>
                          </ul>-->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="sidebar-item comments">
                  <div class="sidebar-heading">
                    <h2>{{ $post->comments_count }} comments</h2>
                  </div>
                  <div class="content">
                    <ul>
                      @foreach($post->comments as $comment)
                        <li>
                          <div class="author-thumb">
                            <img src="assets/images/comment-author-01.jpg" alt="">
                          </div>
                          <div class="right-content">
                            <h4>{{ $comment->user->name }}<span>{{ $comment->created_at->format('M d, Y') }}</span></h4>
                            <p>{{ $comment->comment }}</p>
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="sidebar-item submit-comment">
                  <div class="sidebar-heading">
                    <h2>Your comment</h2>
                  </div>
                  <div class="content">
                    <form name="commentForm" id="commentForm" action="{{ route('post.comment', $post) }}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-lg-12">
                          <fieldset>
                            <textarea name="comment" rows="6" id="comment" placeholder="Type your comment" required=""></textarea>
                          </fieldset>
                        </div>
                        <div class="col-lg-12">
                          <fieldset>
                            <button type="submit" id="form-submit" class="main-button">Submit</button>
                          </fieldset>
                        </div>
                      </div>

                    </form>

                  </div>
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