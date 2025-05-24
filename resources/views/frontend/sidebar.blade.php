<div class="sidebar">
  <div class="row">
    <div class="col-lg-12">
      <div class="sidebar-item search">
        <form id="search_form" action="{{ url('/search') }}" method="GET" action="#">
          <input type="text" name="query" class="searchText" placeholder="type to search..." autocomplete="on"><br />
          <button class="btn btn-secondary" type="submit">Go!</button>
        </form>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="sidebar-item recent-posts">
        <div class="sidebar-heading">
          <h2>Recent Posts</h2>
        </div>
        <div class="content">
          <ul>
            @foreach($recentPosts as $recentPost)

              <li><a href="{{ route('home.show', $recentPost->id) }}">
                <h5>{{ $recentPost->title }}</h5>
                <span>{{ $recentPost->created_at }}</span><!--May 31, 2020-->
              </a></li>

            @endforeach
          </ul>
        </div>
      </div>
    </div>
    
    <div class="col-lg-12">
      <div class="sidebar-item categories">
        <div class="sidebar-heading">
          <h2>Categories</h2>
        </div>
        <div class="content">
          <ul>
            @foreach($categories as $category)
              <li><a href="{{ route('home.posts_by_category', $category->slug) }}">- {{ $category->name }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="sidebar-item tags">
        <div class="sidebar-heading">
          <h2>Tag Clouds</h2>
        </div>
        <div class="content">
          <ul>
            @foreach($tags as $tag)
              <li><a href="{{ route('home.posts_by_tag', $tag->slug) }}">{{ $tag->name }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>