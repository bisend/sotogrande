@extends('sotogrande.layout')

@section('mainsection')
<!-- Sub banner 2 start -->
<div class="sub-banner-2">
  <div class="container">
      <div class="breadcrumb-area">
          <h1>Blogs</h1>
          <ul class="breadcrumbs">
              <li><a href="{{ url_home($language) }}">Home</a></li>
              <li class="active">Blogs</li>
          </ul>
      </div>
  </div>
</div>
<!-- Sub banner 2 end -->

<!-- Blog section start -->
<div class="blog-section content-area-2">
  <div class="container">
      <div class="row">
        @foreach ($posts as $post)
          <div class="col-lg-4 col-md-6 col-sm-6 blog-item">
              <div class="blog-grid-box">
                  <img class="blog-theme img-fluid" src="{{ URL::asset($post->image) }}" alt="property-10">
                  <div class="detail">
                      <div class="date-box">
                          <h5>{{ \Carbon\Carbon::parse($post['created_at'])->format('d') }}</h5>
                          <h5>{{ \Carbon\Carbon::parse($post['created_at'])->format('M') }}</h5>
                      </div>
                      <h3>
                          <a href="{{ url_blog_page($post->alias, $language) }}">
                            {{ $post->contentload->title }}
                          </a>
                      </h3>
                      {{-- <div class="post-meta">
                          <span><a href="#"><i class="fa fa-user"></i>John Antony</a></span>
                          <span><a href="#"><i class="fa fa-commenting-o"></i>24 Comment</a></span>
                      </div> --}}
                      <p>{!! str_limit($post->contentload->content, 200, ' ...') !!}</p>
                      <a href="{{ url_blog_page($post->alias, $language) }}" class="btn-read-more">Read more</a>
                  </div>
              </div>
          </div>
        @endforeach

        
        {{-- <div class="col-lg-12">
            <div class="pagination-box">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><span aria-hidden="true">«</span></a></li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"><span aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div>
        </div> --}}
      </div>
      @if ( ! empty($posts))
        {{ $posts->links() }}
      @endif
  </div>
</div>
<!-- Blog section end -->
@endsection