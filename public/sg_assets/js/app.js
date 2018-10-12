var RECAPTCHA_SITE_KEY = $('[data-recaptcha-site-key]').val();
var PROPERTY_REFERENCE = $('[data-property-reference]').val() ? $('[data-property-reference]').val() : null;

$(function () {

    "use strict";

    // On window's load
    $(window).on('load', function () {
        setTimeout(function () {
            $(".page_loader").fadeOut("fast");
            $('link[id="style_sheet"]').attr('href', '/sg_assets/css/skins/default.css');
        }, 1000);
        if ($('body .filter-portfolio').length > 0) {
            $(function () {
                $('.filter-portfolio').filterizr(
                    {
                        delay: 0
                    }
                );
            });
            $('.filteriz-navigation li').on('click', function () {
                $('.filteriz-navigation .filtr').removeClass('active');
                $(this).addClass('active');
            });
        }
    });


    // Header shrink while page scroll
    adjustHeader();
    doSticky();
    $(window).on('scroll', function () {
        adjustHeader();
        doSticky();
    });

    function adjustHeader()
    {
        var windowWidth = $(window).width();
        if(windowWidth > 992) {
            if ($(document).scrollTop() >= 100) {
                if($('.header-shrink').length < 1) {
                    $('.sticky-header').addClass('header-shrink');
                }
                if($('.do-sticky').length < 1) {
                    // $('.logo img').attr('src', '/sg_assets/img/logos/black-logo.png');
                    $('.logo img').attr('src', '/assets/images/home/logo.png');
                }
            }
            else {
                $('.sticky-header').removeClass('header-shrink');
                if($('.do-sticky').length < 1) {
                    // $('.logo img').attr('src', '/sg_assets/img/logos/logo.png');
                    $('.logo img').attr('src', '/assets/images/home/logo.png');
                }
            }
        } else {
            // $('.logo img').attr('src', '/sg_assets/img/logos/black-logo.png');
            $('.logo img').attr('src', '/assets/images/home/logo.png');
        }
    }

    function doSticky()
    {
        if ($(document).scrollTop() > 40) {
            $('.do-sticky').addClass('sticky-header');
            //$('.do-sticky').addClass('header-shrink');
        }
        else {
            $('.do-sticky').removeClass('sticky-header');
            //$('.do-sticky').removeClass('header-shrink');
        }
    }

    // WOW animation library initialization
    var wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100,
            mobile: false
        }
    );
    wow.init();

    $(".open-offcanvas, .close-offcanvas").on("click", function () {
        return $("body").toggleClass("off-canvas-sidebar-open"), !1
    });

    $(document).on("click", function (t) {
        var a = $(".off-canvas-sidebar");
        a.is(t.target) || 0 !== a.has(t.target).length || $("body").removeClass("off-canvas-sidebar-open")
    });

    // Banner slider
    //Function to animate slider captions
    function doAnimations(elems) {
        //Cache the animationend event in a variable
        var animEndEv = 'webkitAnimationEnd animationend';
        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }

    //Variables on page load
    var $myCarousel = $('#carouselExampleIndicators');
    var $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
    //Initialize carousel
    $myCarousel.carousel();

    //Animate captions in first slide on page load
    doAnimations($firstAnimatingElems);
    //Pause carousel
    $myCarousel.carousel('pause');
    //Other slides to be animated on carousel slide event
    $myCarousel.on('slide.bs.carousel', function (e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });

    $('#carouselExampleIndicators').on('slid.bs.carousel', function (e) {
        // do something…
        if($('[data-particles]').length > 0) {
            window["pJSDom"][0].pJS.fn.vendors.destroypJS();
            window["pJSDom"] = [];
        }

        loadParticlesBackground(e.to);
    })

    $('#carouselExampleIndicators').carousel({
        interval: 3000,
        pause: "true"
    });

    // Megamenu activation
    $(".megamenu").on("click", function (e) {
        e.stopPropagation();
    });

    // DROPDOWN ON HOVER

    $(".dropdown").on('hover', function () {
            $('.dropdown-menu', this).stop().fadeIn("fast");
        },
        function () {
            $('.dropdown-menu', this).stop().fadeOut("fast");
        });


    // Counter Activation
    function isCounterElementVisible($elementToBeChecked)
    {
        var TopView = $(window).scrollTop();
        var BotView = TopView + $(window).height();
        var TopElement = $elementToBeChecked.offset().top;
        var BotElement = TopElement + $elementToBeChecked.height();
        return ((BotElement <= BotView) && (TopElement >= TopView));
    }
    $(window).on('scroll', function () {
        $( ".counter" ).each(function() {
            var isOnView = isCounterElementVisible($(this));
            if(isOnView && !$(this).hasClass('Starting')){
                $(this).addClass('Starting');
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            }
        });
    });

    // Dropzone initialization
    Dropzone.autoDiscover = false;
    $(function () {
        $("div#myDropZone").dropzone({
            url: "/file-upload"
        });
    });

    // Full  Page Search Activation
    $(function () {
        $('a[href="#full-page-search"]').on('click', function(event) {
            event.preventDefault();
            $('#full-page-search').addClass('open');
            $('#full-page-search > form > input[type="search"]').focus();
        });

        $('#full-page-search, #full-page-search button.close').on('click keyup', function(event) {
            if (event.target === this || event.target.className === 'close' || event.keyCode === 27) {
                $(this).removeClass('open');
            }
        });

        $('form').submit(function(event) {
            event.preventDefault();
            return false;
        })
    });




    // Page scroller initialization.
    $.scrollUp({
        scrollName: 'page_scroller',
        scrollDistance: 300,
        scrollFrom: 'top',
        scrollSpeed: 500,
        easingType: 'linear',
        animation: 'fade',
        animationSpeed: 200,
        scrollTrigger: false,
        scrollTarget: false,
        scrollText: '<i class="fa fa-chevron-up"></i>',
        scrollTitle: false,
        scrollImg: false,
        activeOverlay: false,
        zIndex: 2147483647
    });


    // Magnify activation
    $('.property-magnify-gallery').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery:{enabled:true}
        });
    });

    // Range sliders activation
    $(".range-slider-ui").each(function () {
        var minRangeValue = parseInt($(this).attr('data-min'));
        var maxRangeValue = parseInt($(this).attr('data-max'));
        var minName = $(this).attr('data-min-name');
        var maxName = $(this).attr('data-max-name');
        var unit = $(this).attr('data-unit');

        // CHECK IF HAS PRICE IN REQUEST START
        var urlQuery = window.location.href.split('&');
        var hasMinPrice =  _.filter(urlQuery, function(s) { 
            return s.indexOf( 'min-price' ) !== -1; 
        });
        var hasMaxPrice =  _.filter(urlQuery, function(s) { 
            return s.indexOf( 'max-price' ) !== -1; 
        });
        var currentMinPrice = 0;
        var currentMaxPrice = 0;
        if (hasMinPrice.length) {
            var b = hasMinPrice[0].split('=');
            currentMinPrice = b.length >= 2 ? parseInt(b[1]) : 0;
        }
        if (hasMaxPrice.length) {
            var b = hasMaxPrice[0].split('=');
            currentMaxPrice = b.length >= 2 ? parseInt(b[1]) : 0;
        }
        // CHECK IF HAS PRICE IN REQUEST END

        $(this).append("" +
            "<span class='min-value'></span> " +
            "<span class='max-value'></span>" +
            "<input class='current-min' type='hidden' name='"+minName+"'>" +
            "<input class='current-max' type='hidden' name='"+maxName+"'>"
        );
        $(this).slider({
            range: true,
            min: minRangeValue,
            max: maxRangeValue,
            values: [hasMinPrice.length ? currentMinPrice : minRangeValue, hasMaxPrice.length ? currentMaxPrice : maxRangeValue],
            slide: function (event, ui) {
                event = event;
                var currentMin = parseInt(ui.values[0]);
                var currentMax = parseInt(ui.values[1]);
                $(this).children(".min-value").text( currentMin + " " + unit);
                $(this).children(".max-value").text(currentMax + " " + unit);
                $(this).children(".current-min").val(currentMin);
                $(this).children(".current-max").val(currentMax);
            }
        });

        var currentMin = parseInt($(this).slider("values", 0));
        var currentMax = parseInt($(this).slider("values", 1));
        $(this).children(".min-value").text( currentMin + " " + unit);
        $(this).children(".max-value").text(currentMax + " " + unit);
        $(this).children(".current-min").val(currentMin);
        $(this).children(".current-max").val(currentMax);
    });

    // Select picket activation
    $('select').selectBox(
        {
            mobile: true,
        }
    );


    // Dropdown activation
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });


    // Modal activation
    $('.property-video').on('click', function () {
        $('#propertyModal').modal('show');
    });


    // Google map activation
    function LoadMap(propertes) {
        var defaultLat = 40.7110411;
        var defaultLng = -74.0110326;
        var mapOptions = {
            center: new google.maps.LatLng(defaultLat, defaultLng),
            zoom: 15,
            scrollwheel: false,
            styles: [
                {
                    featureType: "administrative",
                    elementType: "labels",
                    stylers: [
                        {visibility: "off"}
                    ]
                },
                {
                    featureType: "water",
                    elementType: "labels",
                    stylers: [
                        {visibility: "off"}
                    ]
                },
                {
                    featureType: 'poi.business',
                    stylers: [{visibility: 'off'}]
                },
                {
                    featureType: 'transit',
                    elementType: 'labels.icon',
                    stylers: [{visibility: 'off'}]
                },
            ]
        };
        var map = new google.maps.Map(document.getElementById("contactMap"), mapOptions);
        var infoWindow = new google.maps.InfoWindow();
        var myLatlng = new google.maps.LatLng(40.7110411, -74.0110326);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });
        (function (marker) {
            google.maps.event.addListener(marker, "click", function (e) {
                infoWindow.setContent("" +
                    "<div class='map-properties contact-map-content'>" +
                    "<div class='map-content'>" +
                    "<p class='address'>123 Kathal St. Tampa City </p>" +
                    "<ul class='map-properties-list'> " +
                    "<li><i class='fa fa-phone'></i>  +XXXX XXXX XXX</li> " +
                    "<li><i class='fa fa-envelope'></i>  info@themevessel.com</li> " +
                    "<li><a href='index.html'><i class='fa fa-globe'></i>  http://http://themevessel.com</li></a> " +
                    "</ul>" +
                    "</div>" +
                    "</div>");
                infoWindow.open(map, marker);
            });
        })(marker);
    }

    if($('#contactMap').length){
        // LoadMap();
    }


    // Countdown activation
    $( function() {
        // Add background image
        //$.backstretch('../img/nature.jpg');
        var endDate = "December  27, 2019 15:03:25";
        $('.countdown.simple').countdown({ date: endDate });
        $('.countdown.styled').countdown({
            date: endDate,
            render: function(data) {
                $(this.el).html("<div>" + this.leadingZeros(data.days, 3) + " <span>Days</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>Hours</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>Minutes</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>Seconds</span></div>");
            }
        });
        $('.countdown.callback').countdown({
            date: +(new Date) + 10000,
            render: function(data) {
                $(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
            },
            onEnd: function() {
                $(this.el).addClass('ended');
            }
        }).on("click", function() {
            $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
        });

    });


    // Multi-item carousel activation
    var itemsMainDiv = ('.multi-carousel');
    var itemsDiv = ('.multi-carousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').on('click', function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });
    ResCarouselSize();

    $(window).on('resize', function () {
        ResCarouselSize();
        resizeModalsContent();
        adjustHeader()
    });
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "multiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }

    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e === 0) {
            translateXval = parseInt(xds, 10) - parseInt(itemWidth * s, 10);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e === 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds, 10) + parseInt(itemWidth * s, 10);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }


    resizeModalsContent();
    function resizeModalsContent() {
        var winWidth = $(window).width();
        var videoWidth = 400;
        if(winWidth < 992) {
            videoWidth = 500;
        }
        var ratio = .6665;
        var videoHeight = videoWidth * ratio;
        $('.modalIframe').css('height', videoHeight);
    }


    // Typed string activation
    if($('#typed-strings').length > 0){
        var typed = new Typed('#typed', {
            stringsElement: '#typed-strings',
            typeSpeed: 100,
            backSpeed: 0,
            backDelay: 1000,
            startDelay: 1000,
            loop: true
        });
    }

    if($('#typed-strings2').length > 0){
        var typed = new Typed('#typed2', {
            stringsElement: '#typed-strings2',
            typeSpeed: 100,
            backSpeed: 0,
            backDelay: 1000,
            startDelay: 1000,
            loop: true
        });
    }

    if($('#typed-strings3').length > 0){
        var typed = new Typed('#typed3', {
            stringsElement: '#typed-strings3',
            typeSpeed: 100,
            backSpeed: 0,
            backDelay: 1000,
            startDelay: 1000,
            loop: true
        });
    }


    //Youtube carousel activation
    if($('.player').length > 0){
        $(document).on('ready', function () {
            $(".player").mb_YTPlayer();
        });
    }


    /* ---- particles.js config ---- */
    // if($('#particles-banner').length > 0) {
    if($('[data-particles]').length > 0) {
        // $('[data-particles]').each(function (index, elem) {
            loadParticlesBackground(0);
        // }); 
    }

    function loadParticlesBackground(index) {
        particlesJS("particles-banner-" + index, {
            "particles": {
                "number": {
                    "value": 100,
                    "density": {
                        "enable": true,
                        "value_area":1000
                    }
                },
                "color": {
                    "value": ["#aa73ff", "#f8c210", "#83d238", "#33b1f8"]
                },

                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#fff"
                    },
                    "polygon": {
                        "nb_sides": 2
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.6,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 2,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 120,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": false
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 140,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    }


    // Switching Color schema
    function populateColorPlates() {
        var plateStings = '<div class="option-panel option-panel-collased">\n' +
            '    <h2>Change Color</h2>\n' +
            '    <div class="color-plate default-plate" data-color="default"></div>\n' +
            '    <div class="color-plate blue-plate" data-color="blue"></div>\n' +
            '    <div class="color-plate yellow-plate" data-color="yellow"></div>\n' +
            '    <div class="color-plate red-plate" data-color="red"></div>\n' +
            '    <div class="color-plate green-light-plate" data-color="green-light"></div>\n' +
            '    <div class="color-plate orange-plate" data-color="orange"></div>\n' +
            '    <div class="color-plate yellow-light-plate" data-color="yellow-light"></div>\n' +
            '    <div class="color-plate green-light-2-plate" data-color="green-light-2"></div>\n' +
            '    <div class="color-plate olive-plate" data-color="olive"></div>\n' +
            '    <div class="color-plate purple-plate" data-color="purple"></div>\n' +
            '    <div class="color-plate blue-light-plate" data-color="blue-light"></div>\n' +
            '    <div class="color-plate brown-plate" data-color="brown"></div>\n' +
            '    <div class="setting-button">\n' +
            '        <i class="fa fa-gear"></i>\n' +
            '    </div>\n' +
            '</div>';
        $('body').append(plateStings);
    }
    $(document).on('click', '.color-plate', function () {
        var name = $(this).attr('data-color');
        $('link[id="style_sheet"]').attr('href', '/sg_assets/css/skins/' + name + '.css');
    });

    $(document).on('click', '.setting-button', function () {
        $('.option-panel').toggleClass('option-panel-collased');
    });
});






// mCustomScrollbar initialization
(function ($) {
    $(window).on('resize', function () {
        $('#map').css('height', $(this).height() - 110);
        if ($(this).width() > 768) {
            $(".map-content-sidebar").mCustomScrollbar(
                {theme: "minimal-dark"}
            );
            $('.map-content-sidebar').css('height', $(this).height() - 110);
        } else {
            $('.map-content-sidebar').mCustomScrollbar("destroy"); //destroy scrollbar
            $('.map-content-sidebar').css('height', '100%');
        }
    }).trigger("resize");
})(jQuery);

$('body').on('click', '[data-bed]', function (e) {
    $('[data-bed]').each(function (index, elem){
        $(elem).find('span').removeClass('active-text');
    });
    $(this).find('span').addClass('active-text');
});

$(document).ready(function () {
    $('.featured-properties .property-thumbnail img').matchHeight({
        byRow: false,
        property: 'height',
    });
    
    $('.blog.content-area-2  .blog-theme').matchHeight({
        byRow: false,
        property: 'height',
    });
    
    $('.eq-slider').matchHeight({
        byRow: false,
        property: 'height',
    });
    
    $('.related-properties img').matchHeight({
        byRow: false,
        property: 'height',
    });

    $('.blog-item img').matchHeight({
        byRow: false,
        property: 'height',
    });

    $('.price').matchHeight({
        byRow: false,
        property: 'height',
    });
    
    $('.property-img img').matchHeight({
        byRow: false,
        property: 'height',
    });

    // CHECK IF HAS BEDS IN REQUEST START
    var urlQuery = window.location.href.split('&');
    var hasBed =  _.filter(urlQuery, function(s) { 
        return s.indexOf( 'bed' ) !== -1; 
    });
    var value = 'all';
    if (hasBed.length) {
        var b = hasBed[0].split('=');
        value = b.length >= 2 ? b[1] : 'all';
    }
    if (value != 'all') {
        $('[data-bed]').each(function (index, elem) {
            $(elem).find('span').removeClass('active-text');
            if (index + 1 == value) {
                $(elem).siblings('input').prop( "checked", true );
                $(elem).find('span').addClass('active-text');
            }
        });
    }
    // CHECK IF HAS BEDS IN REQUEST END
});

$('body').on('click', '[data-search-submit]', function (event) {
    event.preventDefault();
    var langValue = $('html').attr('lang');
    var language = (langValue == 'en') ? '' : '/' + langValue;
    var $status = $('[data-search-property-status]');
    var $type = $('[data-search-property-type]');
    var $location = $('[data-search-property-location]');
    var $bed = $('[data-bed]').find('span.active-text');
    var $minPrice = $('[data-search-property-price]').find('.min-value');
    var $maxPrice = $('[data-search-property-price]').find('.max-value');
    var $reference = $('[data-search-property-reference]');

    var status = $status.val();
    var type = $type.val();
    var location = $location.val();
    var bed = ($bed.text().replace(/\D/g, "") == '') ? 'all' : $bed.text().replace(/\D/g, "");
    var minPrice = $minPrice.text().replace(/\D/g, "");
    var maxPrice = $maxPrice.text().replace(/\D/g, "");
    var reference = $reference.val();
    
    var url = '/search' + language;
    var query = '?search=true&';

    if (reference.length > 0) {
        query += 'reference=' + reference;
    } else {
        query += 'status=' + status + '&';
        query += 'type=' + type + '&';
        query += 'location=' + location + '&';
        query += 'bed=' + bed + '&';
        query += 'min-price=' + minPrice + '&';
        query += 'max-price=' + maxPrice;
    }

    url += query;

    window.location.href = url;
});

// CALLBACK AND INTEREST FUNC
var regCaptchaError = true;
var callbackCaptchaError = true;

var verifyCallbackReg = function (response) {
    $('#recaptcha-error-reg').hide();
    if (response == '') {
        regCaptchaError = true;
    } else {
        regCaptchaError = false;
    }
};

var verifyCallback = function (response) {
    $('#recaptcha-error-callback').hide();
    if (response == '') {
        callbackCaptchaError = true;
    } else {
        callbackCaptchaError = false;
    }
};

var widgetId1;
var widgetId2;
var onloadCallback = function () {

    widgetId1 = grecaptcha.render('call-back-captcha', {
        'sitekey': RECAPTCHA_SITE_KEY,
        'callback': verifyCallback
    });
    widgetId2 = grecaptcha.render(document.getElementById('interest-captcha'), {
        'sitekey': RECAPTCHA_SITE_KEY,
        'callback': verifyCallbackReg
    });

};

var objToStick = $(".featured-properties.content-area-2"); //Получаем нужный объект

if (objToStick.length) {
	var topOfObjToStick = objToStick.offset().top; //Получаем начальное расположение нашего блока
    var windowScroll = $(window).scrollTop(); //Получаем величину, показывающую на сколько прокручено окно
		if (windowScroll > topOfObjToStick) { // Если прокрутили больше, чем расстояние до блока, то приклеиваем его
            $('[data-callback-form]').show();
		} else {
            $('[data-callback-form]').hide();
		};
    
	$(window).scroll(function () {
		var windowScroll = $(window).scrollTop(); //Получаем величину, показывающую на сколько прокручено окно
		if (windowScroll > topOfObjToStick) { // Если прокрутили больше, чем расстояние до блока, то приклеиваем его
            $('[data-callback-form]').show();
		} else {
            $('[data-callback-form]').hide();
		};
	});
}


$('body').on('focus', '[data-callback-name]', function (e) {
    var $name = $('[data-callback-name]');
    $name.attr('placeholder', 'Name');
    $(this).removeClass('incorrect-input');
});

$('body').on('focus', '[data-callback-phone]', function (e) {
    var $phone = $('[data-callback-phone]');
    $phone.attr('placeholder', 'Phone');
    $(this).removeClass('incorrect-input');
});

$('body').on('click', '[data-callback-submit]', function (e) {
    e.preventDefault();

    var $name = $('[data-callback-name]');
    var $phone = $('[data-callback-phone]');
    var $gRecaptchaPayload = $('#g-recaptcha-response');

    var name = $name.val();
    var phone = $phone.val();
    var backPage = window.location.href;
    var token = $('[name="_token"]').val();
    var callbackError = false;
    var gRecaptchaPayload = $gRecaptchaPayload.val();

    if (name == '') {
        $name.val('');
        $name.attr('placeholder', 'Enter the correct name');
        $name.addClass('incorrect-input');
        callbackError = true;
    }

    if (name.length > 30) {
        $name.val('');
        $name.attr('placeholder', 'Maximum 30 characters');
        $name.addClass('incorrect-input');
        callbackError = true;
    }

    if (phone == '') {
        $phone.val('');
        $phone.attr('placeholder', 'Enter phone number');
        $phone.addClass('incorrect-input');
        callbackError = true;
    }

    if (callbackCaptchaError == true) {
        callbackError = true;
        $('#recaptcha-error-callback').show();
    }



    if (callbackError == false) {

        $.ajax({
            url: '/request/callback',
            type: 'post',
            data: {
                _token: token,
                name: name,
                phone: phone,
                backPage: backPage,
                recaptchaPayload: gRecaptchaPayload
            },
            success: function (response) {
                if (response.success || response.status) {
                        $name.val('');
                        $name.attr('placeholder', 'Name');
                        $name.removeClass('incorrect-input');

                        $phone.val('');
                        $phone.attr('placeholder', 'Phone');
                        $phone.removeClass('incorrect-input');

                        grecaptcha.reset(widgetId1);

                        $('#successModal').modal('show')
                } else {
                    callbackCaptchaError = true;
                    callbackError = true;
                    grecaptcha.reset(widgetId1);
                }

            },
            error: function (error) {
                console.log(error);
            }
        });

    }

});

/* ---    send-register-form     ---- */

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

$("#interest-phone").keypress(function (e) {
    if (e.which != 43 && e.which != 41 && e.which != 40 && e.which != 46 && e.which != 45 && e.which != 46 &&
        !(e.which >= 48 && e.which <= 57)) {
        return false;
    }
});

$("#callback-phone").keypress(function (e) {
    if (e.which != 43 && e.which != 41 && e.which != 40 && e.which != 46 && e.which != 45 && e.which != 46 &&
        !(e.which >= 48 && e.which <= 57)) {
        return false;
    }
});

$('body').on('click', '[data-interest-submit]', function (e) {
    e.preventDefault();

    var regPage = window.location.href;

    var $name = $('[data-interest-name]');
    var $email = $('[data-interest-email]');
    var $phone = $('[data-interest-phone]');
    var $gRecaptchaPayload = $('#g-recaptcha-response-1');

    var name = $name.val();
    var email = $email.val();
    var phone = $phone.val();
    var saveEmail = $email.val();
    var token = $('[name="_token"]').val();
    var registrError = false;
    var gRecaptchaPayload = $gRecaptchaPayload.val();


    $email.on('focus', function () {
        $email.attr('placeholder', 'Email');
        $email.val(saveEmail);
    })

    if (name == '') {
        $name.val('');
        $name.attr('placeholder', 'Enter the correct name');
        $name.addClass('incorrect-input');
        registrError = true;
    }

    if (name.length > 30) {
        $name.val('');
        $name.attr('placeholder', 'Maximum 30 characters');
        $name.addClass('incorrect-input');
        registrError = true;
    }

    if (phone == '') {
        $phone.val('');
        $phone.attr('placeholder', 'Enter phone number');
        $phone.addClass('incorrect-input');
        registrError = true;
    }

    if (!validateEmail(email)) {
        $email.val('');
        $email.attr('placeholder', 'Enter the correct email');
        $email.addClass('incorectEmail');
        $email.addClass('incorrect-input');
        registrError = true;
    }

    if (regCaptchaError == true) {
        registrError = true;
        $('#recaptcha-error-reg').show();
    }

    if (registrError == false) {

        $.ajax({
            url: '/request/registerinterest',
            type: 'POST',
            data: {
                _token: token,
                name: name,
                email: email,
                phone: phone,
                regPage: regPage,
                recaptchaPayload: gRecaptchaPayload
            },
            success: function (response) {
                if (response.success || response.status) {
                        $name.val('');
                        $name.attr('placeholder', 'Name');
                        $name.removeClass('incorrect-input');

                        $email.val('');
                        $email.attr('placeholder', 'Email');
                        $email.removeClass('incorrect-input');

                        $phone.val('');
                        $phone.attr('placeholder', 'Phone');
                        $phone.removeClass('incorrect-input');

                        grecaptcha.reset(widgetId2);

                        $('#successModal').modal('show')
                } else {
                    callbackCaptchaError = true;
                    callbackError = true;
                    grecaptcha.reset(widgetId2);
                }

            },
            error: function (error) {
                console.log(error);
            }
        });


    }

})


/* ---    send-register-form END     ---- */

$('body').on('click', '[data-option-panel-nav-item]', function(e) {
    if ($(this).find('.nav-link').hasClass('active') || $(this).closest('[data-option-panel-double-form]').hasClass('option-panel-double-form-collapsed')) {
        $(this).closest('[data-option-panel-double-form]').toggleClass('option-panel-double-form-collapsed');
    }
});

$('body').on('click', '[data-option-panel-double-form-close]', function(e) {
    $(this).closest('[data-option-panel-double-form]').addClass('option-panel-double-form-collapsed');
});