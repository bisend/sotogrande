<!-- Top header start -->
<header class="top-header top-header-bg-black d-none d-xl-block d-lg-block d-md-block" id="top-header-2">
  <div class="container">
      <div class="row">
          <div class="col-lg-10 col-md-6 col-sm-6">
              <div class="list-inline">
                  {{-- <a href="tel:1-XXX-XXX-XXX8"><i class="fa fa-phone"></i>1-XXX-XXX-XXX8</a> --}}
                  @if($static_data['site_settings']['contact_tel1'])<a href="tel:{{ $static_data['site_settings']['contact_tel1'] }}"><i class="fa fa-phone"></i> {{ $static_data['site_settings']['contact_tel1'] }}</a>@endif
                  @if($static_data['site_settings']['contact_tel2'])<a href="tel:{{ $static_data['site_settings']['contact_tel2'] }}"><i class="fa fa-phone"></i> {{ $static_data['site_settings']['contact_tel2'] }}</a>@endif
                  @if($static_data['site_settings']['contact_tel3'])<a href="tel:{{ $static_data['site_settings']['contact_tel2'] }}"><i class="fa fa-phone"></i> {{ $static_data['site_settings']['contact_tel3'] }}</a>@endif
                  @if($static_data['site_settings']['contact_tel4'])<a href="tel:{{ $static_data['site_settings']['contact_tel2'] }}"><i class="fa fa-phone"></i> {{ $static_data['site_settings']['contact_tel4'] }}</a>@endif
                  @if($static_data['site_settings']['contact_tel5'])<a href="tel:{{ $static_data['site_settings']['contact_tel2'] }}"><i class="fa fa-phone"></i> {{ $static_data['site_settings']['contact_tel5'] }}</a>@endif
                  @if($static_data['site_settings']['contact_email'])<a href="mailto:{{ $static_data['site_settings']['contact_email'] }}"><i class="fa fa-envelope"></i>{{ $static_data['site_settings']['contact_email'] }}</a>@endif
                  {{-- <a href="mailto:{{ $static_data['site_settings']['contact_email'] }}"><i class="fa fa-envelope"></i>{{ $static_data['site_settings']['contact_email'] }}</a> --}}
              </div>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6">
              <ul class="top-social-media pull-right">
                    @if($static_data['site_settings']['social_facebook'])
                        <li>
                            <a href="{{ $static_data['site_settings']['social_facebook'] }}" target="_blank"><i class="fa fa-facebook"></i>
                            </a>
                        </li>
                    @endif
                    @if($static_data['site_settings']['social_twitter'])
                        <li>
                            <a href="{{ $static_data['site_settings']['social_twitter'] }}" target="_blank"><i class="fa fa-twitter"></i>
                            </a>
                        </li>
                    @endif
                    @if($static_data['site_settings']['social_youtube'])
                        <li>
                            <a href="{{ $static_data['site_settings']['social_youtube'] }}" target="_blank"><i class="fa fa-youtube"></i>
                            </a>
                        </li>
                    @endif
                    @if($static_data['site_settings']['social_instagram'])
                        <li>
                            <a href="{{ $static_data['site_settings']['social_instagram'] }}" target="_blank"><i class="fa fa-instagram"></i>
                            </a>
                        </li>
                    @endif
                    @if($static_data['site_settings']['social_google_plus'])
                        <li>
                            <a href="{{ $static_data['site_settings']['social_google_plus'] }}" target="_blank"><i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    @endif
                    @if($static_data['site_settings']['social_pinterest'])
                        <li>
                            <a href="{{ $static_data['site_settings']['social_pinterest'] }}" target="_blank"><i class="fa fa-pinterest"></i>
                            </a>
                        </li>
                    @endif
                    @if($static_data['site_settings']['social_linkedin'])
                        <li>
                            <a href="{{ $static_data['site_settings']['social_linkedin'] }}" target="_blank"><i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    @endif
                    @if($static_data['site_settings']['social_tripadvisor'])
                        <li>
                            <a href="{{ $static_data['site_settings']['social_tripadvisor'] }}" target="_blank"><i class="fa fa-tripadvisor"></i>
                            </a>
                        </li>
                    @endif
                    @php($countLang = 0)
                    <li>
                        @foreach ($languages as $lang)
                            @if ($language == 'en')
                                <a href="{{ url()->current() }}{{ $lang->code == 'en' ? '' : '/' . $lang->code}}">
                                    <img src="{{$lang->flag}}" alt="{{$lang->code}}">{{ $lang->code }}
                                </a>
                            @elseif($language == 'es')
                                <a href="{{ str_replace('/es', '', url()->current()) }}{{ $lang->code == 'en' ? '' : '/' . $lang->code}}">
                                    <img src="{{$lang->flag}}" alt="{{$lang->code}}">{{ $lang->code }}
                                </a>
                            @endif
                            @if($countLang == 0)
                                <a href="javascript:void(0);">/</a>
                            @endif
                        @php($countLang++)
                        @endforeach
                    </li>

                  {{-- <li>
                      <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li>
                      <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li>
                      <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                  </li>
                  <li>
                      <a href="#" class="linkedin"><i class="fa fa-linkedin"></i> </a>
                  </li>
                  <li>
                      <a href="#" class="rss"><i class="fa fa-instagram"></i></a>
                  </li> --}}
                  {{-- <li>
                      <a href="#">/</a>
                  </li> --}}
                  {{-- <li>
                      <a href="login.html" class="sign-in"><i class="fa fa-sign-in"></i> Login </a>
                  </li>
                  <li>
                      <a href="login.html" class="sign-in"><i class="fa fa-user"></i> Register</a>
                  </li> --}}
              </ul>
          </div>
      </div>
  </div>
</header>
<!-- Top header end -->
