@extends('realstate.layout')

@section('mainsection')
<div class="contact-form-fix Call-Back-wrap form-active">
        <div class="show-btn-wrapper">
            <button class="show-collback"><i class="fa fa-volume-control-phone" aria-hidden="true"></i></button>
        </div>
        <div class="fix-form-header">
            Call Back
        </div>
        <form action="" id="coll-back-form" methods="post">
            <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
            <label for="name">Name:</label>
            <input id="call-back-name" type="text" placeholder="Name" name="name">
            <label for="phone">Phone Number:</label>
            <input id="call-back-phone" type="text" placeholder="Phone" name="phone">
            <div class="recaptcha-div">
                <span id="recaptcha-error-callback">Please complete the verification!</span>
                <div class="recaptcha-style" id="call-back-captcha"></div>
            </div>
           

            <button id="send-coll-back" class="button button-icon alt small"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>Send</button>
        </form>
    </div>





    <section class="subheader">
  <div class="container">
    <h1>Blogs</h1>
    <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="#" class="current">Blog</a></div>
    <div class="clear"></div>
  </div>
</section>

<section class="module">
  <div class="container">
    
    <div class="row grid-blog">

        @foreach($posts as $post)
        <div class="col-lg-4 col-md-4">
            <div class="blog-post blog-post-creative shadow-hover">
            <a href="{{url('/blog/post').'/'.$post->alias}}" class="blog-post-img">
                <div class="img-fade"></div>
                <div class="img-overlay"><i class="fa fa-quote-left"></i></div>
                <div class="blog-post-date"><span>{{ \Carbon\Carbon::parse($post['created_at'])->format('j') }}</span>{{ \Carbon\Carbon::parse($post['created_at'])->format('M') }}</div>
                <div class="blog-img-bg">
                    <img src="{{ url('/').$post->image }}" alt="" />
                </div>
            </a>
            <div class="content blog-post-content">
                <h3><a href="{{url('/blog/post').'/'.$post->alias}}">{{ $post->contentload->title }}</a></h3>
                <p>{!! str_limit(strip_tags($post->contentload->content), 120, ' ...')  !!}</p>
                <a href="{{url('/blog/post').'/'.$post->alias}}" class="button button-icon small grey"><i class="fa fa-angle-right"></i> Read More</a>
            </div>
            </div>
        </div>
        @endforeach
      
    </div><!-- end row -->
    {{$posts->links()}}
<!--     
   @include ('realstate.partials.pagination') -->

  </div><!-- end container -->
</section>

@endsection