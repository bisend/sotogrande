<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    @yield('title')

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,500,600,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/backend_materialize.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/toast.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/summernote.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/colorpicker.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/backend_style.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.png?v=2') }}" type="image/x-icon">
    @yield('style')

</head>
<body class="mtop20">
<div class="cover"></div>
    <div class="container header-container z-depth-1">
        <div class="row no-pad-bot mbot0">
            <nav>
                <div id="header-left" class="col l10 m12 s12 header-col">
                    <div id="logo" class="col s6 m6">
                        <p class="date-text">{{date('l, jS \of F Y')}}</p>
                        <a href="{{route('admin_dashboard')}}" class="brand-logo">Adminpanel<span></span></a>
                    </div>
                    <div id="navigation">
                        <ul class="hide-on-med-and-down clearfix">
                            <li class="{{ setActive('admin/dashboard') }}"><a href="{{route('admin_dashboard')}}">{{get_string('dashboard')}}</a></li>
                            <li class="{{ setActive('admin/property') }}"><a href="{{route('admin.property.index')}}">{{get_string('properties')}}</a></li>
                            <li class="{{ setActive('admin/taxonomy') }}">
                                <a href="#">{{get_string('taxonomy')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                    <ul class="sub-menu">
                                    <li><a href="{{route('admin.taxonomy.category.index')}}">Categories</a></li>
                                    <li><a href="{{route('admin.taxonomy.country.index')}}">Countries</a></li>
                                    <li><a href="{{route('admin.taxonomy.location.index')}}">Locations</a></li>
                                    <li><a href="{{route('admin_taxonomy_feature')}}">{{get_string('features')}}</a></li>
                                </ul>
                            </li>
                            <li class="{{ setActive('admin/page') }}"><a href="{{route('admin.page.index')}}">{{get_string('pages')}}</a></li>
                            <li class="{{ setActive('admin/blog') }}"><a href="{{route('admin.blog.index')}}">{{get_string('blog')}}</a></li>
                            <li class="{{ setActive('admin/request') }}"><a href="{{route('admin_requests')}}">{{get_string('requests')}}</a></li>
                            <li class="{{ setActive('admin/settings') }}">
                                <a href="#">{{get_string('settings')}}<i class="material-icons tiny">arrow_drop_down</i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('admin_site_settings')}}">{{get_string('site_settings')}}</a></li>
                                    {{-- <li><a href="{{route('admin_property_settings')}}">{{get_string('properties_settings')}}</a></li> --}}
                                    {{-- <li><a href="{{route('admin_design_settings')}}">{{get_string('design_settings')}}</a></li> --}}
                                    {{-- <li><a href="{{route('admin_style_settings')}}">{{get_string('style_settings')}}</a></li> --}}
                                    {{-- <li><a href="{{route('admin_translator')}}">{{get_string('translator')}}</a></li> --}}
                                    {{-- <li><a href="{{route('admin_language_settings')}}">{{get_string('lang_settings')}}</a></li>                                    <li><a href="{{route('admin_currency')}}">{{get_string('currencies')}}</a></li> --}}
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col s6 show-on-small">
                        <ul id="slide-out" class="side-nav">
                            <li class="{{ setActive('admin/dashboard') }}"><a href="{{route('admin_dashboard')}}">{{get_string('dashboard')}}</a></li>
                            <li class="{{ setActive('admin/property') }}"><a href="{{route('admin.property.index')}}">{{get_string('property')}}</a></li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header {{ setActive('admin/taxonomy') }}" href="#">{{get_string('taxonomy')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="{{route('admin.taxonomy.category.index')}}">Property Type</a></li>
                                                <li><a href="{{route('admin.taxonomy.country.index')}}">Countries</a></li>
                                                <li><a href="{{route('admin.taxonomy.location.index')}}">Locations</a></li>
                                                <li><a href="{{route('admin_taxonomy_feature')}}">{{get_string('features')}}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ setActive('admin/blog') }}"><a href="{{route('admin.blog.index')}}">{{get_string('blog')}}</a></li>
                            <li class="{{ setActive('admin/request') }}"><a href="{{route('admin_requests')}}">{{get_string('requests')}}</a></li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header {{ setActive('admin/settings') }}" href="#">{{get_string('settings')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="{{route('admin_site_settings')}}">{{get_string('site_settings')}}</a></li>
                                                <li><a href="{{route('admin_property_settings')}}">{{get_string('properties_settings')}}</a></li>
                                                <li><a href="{{route('admin_design_settings')}}">{{get_string('design_settings')}}</a></li>
                                                <li><a href="{{route('admin_style_settings')}}">{{get_string('style_settings')}}</a></li>
                                                <li><a href="{{route('admin_translator')}}">{{get_string('translator')}}</a></li>
                                                <li><a href="{{route('admin_language_settings')}}">{{get_string('lang_settings')}}</a></li>
                                                <li><a href="{{route('admin_currency')}}">{{get_string('currencies')}}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header {{ setActive('admin/my_account') }}" href="#">{{get_string('my_account')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li class="{{ setActive('admin/my_account') }}"><a href="{{route('admin_my_account')}}">{{get_string('my_account')}}</a></li>
                                                <li><a href="{{route('admin_logout')}}">{{get_string('logout')}}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                        <a href="#" data-activates="slide-out" class="button-collapse menu-button"><i class="material-icons">menu</i></a>
                    </div>
                </div>
                <div id="header-right" class="col s2 header-col hide-on-med-and-down">
                    <div class="user-box">
                        @if(Auth::user()->admin)
                        <div class="user-img">
                            <img src="{{ Auth::user()->admin->avatar}}" alt="user-img" title="{{Auth::user()->username}}" class="responsive-img">
                        </div>
                        @endif
                        <div class="user-icons">
                                <span class="user-name">{{Auth::user()->username}}</span>
                                <span class="user-role">{{Auth::user()->role->role}}</span>
                                <a href="{{config('app.url')}}" title="{{get_string('my_website')}}"><i class="material-icons tiny color-white">input</i></a>
                                <a href="{{route('admin_my_account')}}" title="{{get_string('my_account')}}"><i class="material-icons tiny color-white">settings</i></a>
                                <a href="{{route('admin_logout')}}" title="{{get_string('logout')}}"><i class="material-icons tiny color-red">power_settings_new</i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container home-container z-depth-1">
        <div class="row mbot0">
            <div class="col s12">
    @yield('page_title')
            </div>
    @yield('content')
        </div>
    </div>
    <div class="container footer-container">
        <div class="row">
            <div class="col s12">
                <p> {{ get_string('copyright') . date('Y') . ' ' . get_string('rights_reserved') . get_setting('site_name', 'site')}}</p>
            </div>
        </div>
    </div>
<!--  Scripts-->
<script src="{{URL::asset('assets/js/plugins/jquery.min.js')}}"></script>
<script type="text/javascript">
    window.paceOptions = {
        ajax: false,
        restartOnRequestAfter: false,
    };
</script>
<script src="{{URL::asset('assets/js/plugins/backend_bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/backend_plugins.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/waypoints.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/waves.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/toast.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/jquery-ui.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/counter.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/summernote.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/dropzone.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/colorpicker.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/bootbox.min.js')}}"></script>
<script src="{{URL::asset('assets/js/backend_init.js')}}"></script>

<script type="text/javascript">
    // Mobile Menu
$('.button-collapse').sideNav({
    menuWidth: 300,
    edge: 'right',
    closeOnClick: true,
    draggable: true
});
</script>
    @yield('footer')
</body>
</html>
