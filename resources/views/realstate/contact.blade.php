@extends('realstate.layout')

@section('mainsection')
<section class="subheader subheader-listing-sidebar">
  <div class="container">
    <h1>Contact Us</h1>
    <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="#" class="current">Contact Us</a></div>
    <div class="clear"></div>
  </div>
</section>
    <!-- <section class="module contact-details">
  <div class="container">

    <div class="row">
      <div class="col-lg-3 col-md-12">
        <div class="contact-item">
          <i class="fa fa-envelope"></i>
          <h4>Email Us</h4>
          <p>support@realstate.com</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="contact-item">
          <i class="fa fa-phone"></i>
          <h4>Call Us</h4>
          <ul class="contact-page-phones">
              <li>+20(800)030-96-74</li>
              <li>+20(800)030-96-74</li>
              <li>+20(800)030-96-74</li>
              <li>+20(800)030-96-74</li>
              <li>+20(800)030-96-74</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-12">
        <div class="contact-item">
          <i class="fa fa-share-alt"></i>
          <h4>Connect With Us</h4>
          <ul class="social-icons">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</section> -->


<section class="module">
  <div class="container">

    <div class="row">

      <div class="col-lg-8 col-md-8">

        <div class="comment-form">
          <h4><span>Quick Contact</span> <img src="/realstate/images/divider-half.png" alt="" /></h4>
          <!-- <p><b>Fill out the form below.</b> Morbi accumsan ipsum velit Nam nec tellus a odio tincidunt auctor a ornare odio sedlon maurisvitae erat consequat auctor</p> -->
          <form method="post" id="contact-us">
            <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
            <div class="form-block">
              <label>Name *</label>
              <input id="contact-name" class="requiredField" type="text" placeholder="Your Name" name="name" />
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="form-block">
                  <label>Email *</label>
                  <input id="contact-email" class="email requiredField" type="text" placeholder="Your email" name="email" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-block">
                  <label>Phone *</label>
                  <input id="contact-phone" type="text" placeholder="Your phone" name="phone" />
                </div>
              </div>
            </div>
            <!-- <div class="form-block">
                <label>Subject</label>
                <input id="contact-subject" type="text" placeholder="Subject" name="subject" />
            </div> -->
            <div class="form-block">
              <label>Message *</label>
              <textarea id="contact-message" class="requiredField" placeholder="Your message..." name="message"></textarea>
            </div>

             <!-- <div class="recaptcha-div">
                <span id="recaptcha-error-callback">Please complete the verification!</span>
                <div class="recaptcha-style" id="contact-recaptcha"></div>
            </div> -->
            
            <div class="form-block">
              <input id="submit-contact-form" type="submit" value="Submit" />
            </div>
          </form>
        </div>

        <div class="divider"></div><br/>
        <!-- <h4>Still need help?</h4> -->
        <!-- <p>If you still have questions, try visiting our <a href="#"><b>FAQ</b></a> page to assit you. Morbi accumsan ipsum velit Nam nec tellus a odio tincidunt auctor a ornare odio sedlon maurisvitae erat consequat auctor</p> -->

      </div>

      <div class="col-lg-4 col-md-4 sidebar">

        <div class="widget widget-sidebar recent-properties">
          <h4><span>Recent Properties</span> <img src="/realstate/images/divider-half.png" alt="" /></h4>
          <div class="widget-content">
            @foreach($recent_properties as $property)
              <div class="recent-property">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <a href="/property/{{$property->alias}}">
                      <div class="recent-img">
                        <img src="{{ $property->imageByStatus }}" alt="" />
                      </div>
                    </a>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-8">
                    <h5>
                      <a href="/property/{{$property->alias}}">{{ $property->contentload->name }}</a>
                    </h5>
                    @if($property->sales == 1 && $property->rentals == 1)
                      <p><strong>₤{{ $property->prices['price'] }}</strong> Price</p>
                      <p><strong>₤{{ $property->prices['week'] }}</strong> Per Week</p>
                      <p><strong>₤{{ $property->prices['month'] }}</strong> Per Month</p>
                    @elseif($property->rentals == 1)
                      <p><strong>₤{{ $property->prices['week'] }}</strong> Per Week</p>
                      <p><strong>₤{{ $property->prices['month'] }}</strong> Per Month</p>
                    @elseif($property->sales == 1)
                      <p><strong>₤{{ $property->prices['price'] }}</strong> Price</p>
                    @endif					
                  </div>
                </div>
              </div>
            @endforeach
          </div><!-- end widget content -->
        </div><!-- end widget -->
    
        <div class="widget widget-sidebar recent-posts">
          <h4>
            <span>Recent Blog Posts</span> <img src="/realstate/images/divider-half.png" alt="" />
          </h4>
          <div class="widget-content">
            @foreach($last_posts as $last_post)
              <div class="recent-property">
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                    <a href="{{url('/blog/post').'/'.$last_post->alias}}">
                       <div class="recent-img">
                         <img src="{{ isset($last_post->image) ? url('/').$last_post->image : URL::asset('images/no_image.jpg')}}" alt="" />
                       </div>
                    </a>
                  </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <h5>
                      <a href="{{url('/blog/post').'/'.$last_post->alias}}">{{ $last_post->contentload->title }}</a>
                    </h5>
                            <p><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($last_post['created_at'])->format('M') }}, {{ \Carbon\Carbon::parse($last_post['created_at'])->format('j') }}th {{ \Carbon\Carbon::parse($last_post['created_at'])->format('Y') }}</p>
                        </div>
                      </div>
                    </div>
            @endforeach
                </div><!-- end widget content -->
            </div><!-- end widget -->


      </div>

    </div><!-- end row -->

  </div><!-- end container -->
</section>


@endsection