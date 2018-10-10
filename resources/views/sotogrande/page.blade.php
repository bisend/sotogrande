@extends('sotogrande.layout')

@section('mainsection')
<!-- Sub banner 2 start -->
<div class="sub-banner-2">
  <div class="container">
      <div class="breadcrumb-area">
          <h1>{{ $page->contentload->title }}</h1>
          <ul class="breadcrumbs">
              <li><a href="{{ url_home($language) }}">Home</a></li>
              <li class="active">{{ $page->contentload->title }}</li>
          </ul>
      </div>
  </div>
</div>
<!-- Sub banner 2 end -->

<!-- Blog section start -->
<div class="blog-section content-area-2">
    <div class="container">
        <div class="row">
          <div class="col-lg-12" style="min-height: calc(100vh - 447px);">
            <h2 class="text-center">{{ $page->contentload->title }}</h2>
            {!! $page->contentload->content  !!}
          </div>
        </div>
    </div>
</div>
{{-- <div class="page-content">
    <div class="container">
        <h1 class="text-center">{{ $page->contentload->title }}</h1>
    </div>
</div> --}}
@endsection