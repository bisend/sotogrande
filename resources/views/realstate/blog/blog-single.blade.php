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




    <!-- <section class="subheader">
  <div class="container">
    <h1>Blog Single</h1>
    <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="#">Blog</a> <i class="fa fa-angle-right"></i> <a href="#" class="current">Blog Single</a></div>
    <div class="clear"></div>
  </div>
</section> -->

<section class="module">
  <div class="container">
    
    <div class="row">
      <div class="col-lg-12 col-md-12">

        <div class="blog-post">
          <a href="#" class="blog-post-img">
            <div class="img-fade"></div>
            <div class="blog-post-date"><span>{{ \Carbon\Carbon::parse($post['created_at'])->format('j') }}</span>{{ \Carbon\Carbon::parse($post['created_at'])->format('M') }}</div>
            
            <div class="single-blog-img">
                <img src="{{ url('/').$post->image }}" alt="" />
            </div>
            
          </a>
          <div class="content blog-post-content">
            <h3><a href="{{url('/blog/post').'/'.$post->alias}}">{{ $post->contentload->title }}</a></h3>
           
            <p>{!! $post->contentload->content !!}</p>
			
          </div>
        </div><!-- end blog post -->
        
		<div class="widget blog-post-related">
			<h4><span>Related Posts</span> <img src="/realstate/images/divider-half.png" alt="" /></h4>
			
			<div class="row">
			
        @foreach($last_posts as $last_post)
        <div class="col-lg-4 col-md-4">
            <div class="blog-post blog-post-creative shadow-hover">
            <a href="{{url('/blog/post').'/'.$last_post->alias}}" class="blog-post-img">
                <div class="img-fade"></div>
                <div class="img-overlay"><i class="fa fa-quote-left"></i></div>
                <div class="blog-post-date"><span>{{ \Carbon\Carbon::parse($last_post['created_at'])->format('j') }}</span>{{ \Carbon\Carbon::parse($last_post['created_at'])->format('M') }}</div>
                <div class="blog-img-bg">
                    <img src="{{ url('/').$last_post->image }}" alt="" />
                </div>
            </a>
            <div class="content blog-post-content">
                <h3><a href="{{url('/blog/post').'/'.$last_post->alias}}">{{ $last_post->contentload->title }}</a></h3>
                <p>{!! str_limit(strip_tags($last_post->contentload->content), 120, ' ...')  !!}</p>
                <a href="{{url('/blog/post').'/'.$last_post->alias}}" class="button button-icon small grey"><i class="fa fa-angle-right"></i> Read More</a>
            </div>
            </div>
        </div>
        @endforeach
			</div><!-- end row -->
			
		</div><!-- end related posts -->
		
    </div><!-- end blog posts -->
    </div>

  </div>
</section>

@endsection