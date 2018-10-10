@extends('sotogrande.layout')

@section('mainsection')
    <!-- Sub banner 2 start -->
<div class="sub-banner-2">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ $post->contentload->title }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ url_home($language) }}">Home</a></li>
                <li class="active">{{ $post->contentload->title }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner 2 end -->

<!-- Blog section start -->
<div class="blog-section content-area-7">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <!-- Blog grid box start -->
                <div class="blog-grid-box">
                    <img class="blog-theme img-fluid" src="{{ URL::asset($post->image) }}" alt="blog-3">
                    <div class="detail">
                        <div class="date-box">
                          <h5>{{ \Carbon\Carbon::parse($post['created_at'])->format('d') }}</h5>
                          <h5>{{ \Carbon\Carbon::parse($post['created_at'])->format('M') }}</h5>
                        </div>
                        <h2>
                          <a href="{{ url_blog_page($post->alias, $language) }}">{{$post->contentload->title}}</a>
                        </h2>
                        {{-- <div class="post-meta">
                            <span><a href="#"><i class="fa fa-user"></i>John Antony</a></span>
                            <span><a><i class="fa fa-clock-o"></i>July 20</a></span>
                            <span><a href="#"><i class="fa fa-commenting-o"></i>24 Comment</a></span>
                        </div> --}}
                        <p>
                          {!! $post->contentload->content !!}
                        </p>
                        {{-- <br> --}}
                        {{-- <blockquote class="blockquote">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                            <footer>
                                Someone famous in
                                <cite>
                                    Source Title
                                </cite>
                            </footer>
                        </blockquote>
                        <p>Fusce non ante sed lorem rutrum feugiat. Vestibulum pellentesque, purus ut dignissim consectetur, nulla erat ultrices purus, ut consequat sem elit non sem. Morbi lacus massa, euismod ut turpis molestie, tristique sodales est. Integer sit amet mi id sapien tempor molestie in nec massa. Fusce non ante sed lorem rutrum feugiat.</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.But also the leap into electronic typesetting,
                            remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.But also the leap into electronic typesetting,</p>
                        <br>
                        <div class="row clearfix tags-socal-box">
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <div class="tags">
                                    <h2>Tags</h2>
                                    <ul>
                                        <li><a href="#">Image</a></li>
                                        <li><a href="#">Features</a></li>
                                        <li><a href="#">Gallery</a></li>
                                        <li><a href="#">News</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <div class="social-list">
                                    <h2>Share</h2>
                                    <ul>
                                        <li>
                                            <a href="#" class="facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="google">
                                                <i class="fa fa-google"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="linkedin">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="rss">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- Blog grid box end -->

                <!-- Comments section start -->
                {{-- <div class="comments-section cmn-mrg-btm">
                    <h2 class="comments-title">Comments Section</h2>
                    <ul class="comments">
                        <li>
                            <div class="comment">
                                <div class="comment-author">
                                    <a href="#">
                                        <img src="http://placehold.it/60x60" class="rounded-circle" alt="avatar-13">
                                    </a>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <div class="comment-meta-author">
                                            Jane Doe
                                        </div>
                                        <div class="comment-meta-reply">
                                            <a href="#">Reply</a>
                                        </div>
                                        <div class="comment-meta-date">
                                            <span>8:42 PM 10/3/2018</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment-body">
                                        <div class="comment-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum quis porta.</p>
                                    </div>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <div class="comment">
                                        <div class="comment-author">
                                            <a href="#">
                                                <img src="http://placehold.it/60x60" class="rounded-circle" alt="avatar-13">
                                            </a>
                                        </div>

                                        <div class="comment-content">
                                            <div class="comment-meta">
                                                <div class="comment-meta-author">
                                                    Jane Doe
                                                </div>

                                                <div class="comment-meta-reply">
                                                    <a href="#">Reply</a>
                                                </div>

                                                <div class="comment-meta-date">
                                                    <span>8:42 PM 10/3/2018</span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="comment-body">
                                                <div class="comment-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="comment">
                                <div class="comment-author">
                                    <a href="#">
                                        <img src="http://placehold.it/60x60" class="rounded-circle" alt="avatar-13">
                                    </a>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <div class="comment-meta-author">
                                            Jane Doe
                                        </div>
                                        <div class="comment-meta-reply">
                                            <a href="#">Reply</a>
                                        </div>
                                        <div class="comment-meta-date">
                                            <span>8:42 PM 10/3/2018</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment-body">
                                        <div class="comment-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum quis porta.</p>
                                    </div>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <div class="comment">
                                        <div class="comment-author">
                                            <a href="#">
                                                <img src="http://placehold.it/60x60" class="rounded-circle" alt="avatar-13">
                                            </a>
                                        </div>

                                        <div class="comment-content">
                                            <div class="comment-meta">
                                                <div class="comment-meta-author">
                                                    Jane Doe
                                                </div>

                                                <div class="comment-meta-reply">
                                                    <a href="#">Reply</a>
                                                </div>

                                                <div class="comment-meta-date">
                                                    <span>8:42 PM 10/3/2018</span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="comment-body">
                                                <div class="comment-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div> --}}
                <!-- Comments section end -->

                <!-- Contact-1 start -->
                {{-- <div class="contact-1">
                    <h2>Leave a Comment</h2>
                    <div class="container">
                        <div class="row">
                            <form action="#" method="GET" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group name">
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group email">
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group subject">
                                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group number">
                                            <input type="text" name="phone" class="form-control" placeholder="Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group message">
                                            <textarea class="form-control" name="message" placeholder="Write message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="send-btn">
                                            <button type="submit" class="btn btn-color btn-md btn-message">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
                <!-- Contact-1 end -->
            </div>
        </div>
    </div>
</div>
<!-- Blog section end -->
@endsection