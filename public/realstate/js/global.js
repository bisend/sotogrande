
var objToStick = $(".home-properties"); //Получаем нужный объект

if (objToStick.length) {
	var topOfObjToStick = objToStick.offset().top; //Получаем начальное расположение нашего блока
	
	$(window).scroll(function () {
		var windowScroll = $(window).scrollTop(); //Получаем величину, показывающую на сколько прокручено окно
		if (windowScroll > topOfObjToStick) { // Если прокрутили больше, чем расстояние до блока, то приклеиваем его
			$('.home-form-call').addClass("showhomeCall");
		} else {
			$('.home-form-call').removeClass("showhomeCall");
		};
	});
}




var saleSelectedCountryId = 0;
var rentSelectedCountryId = 0;

function checkSaleSelectedCountry(id) {
	var slider = $('#price-slider');
	var sliderPound = $('#price-slider-pound');
	if (id == 1) {
		slider.hide();
		sliderPound.show();
	} else {
		slider.show();
		sliderPound.hide();
	}
}

function checkRentSelectedCountry(id) {
	var sliderPerWeek = $('#price-slider-rent-per-week');
	var sliderPerMonth = $('#price-slider-rent-per-month');
	var sliderPerWeekPound = $('#price-slider-rent-per-week-pound');
	var sliderPerMonthPound = $('#price-slider-rent-per-month-pound');
	if (id == 1) {
		sliderPerWeek.hide();
		sliderPerMonth.hide();
		sliderPerWeekPound.show();
		sliderPerMonthPound.show();
	} else {
		sliderPerWeek.show();
		sliderPerMonth.show();
		sliderPerWeekPound.hide();
		sliderPerMonthPound.hide();
	}
}

jQuery(document).ready(function($) {

"use strict";

	$('.property-content').matchHeight();

	saleSelectedCountryId = $('#search_sale-country') ? $('#search_sale-country').val() : 0;

	rentSelectedCountryId = $('#search_rent-country') ? $('#search_rent-country').val() : 0;

	checkSaleSelectedCountry(saleSelectedCountryId);
	checkRentSelectedCountry(rentSelectedCountryId);

	$('body').on('change', '#search_sale-country', function () {
		saleSelectedCountryId = $('#search_sale-country').val();
		checkSaleSelectedCountry(saleSelectedCountryId);
		// console.log(saleSelectedCountryId, rentSelectedCountryId);
	});
	$('body').on('change', '#search_rent-country', function () {
		rentSelectedCountryId = $('#search_rent-country').val();
		checkRentSelectedCountry(rentSelectedCountryId);
		// console.log(saleSelectedCountryId, rentSelectedCountryId);
	});
	


	// console.log(saleSelectedCountryId, rentSelectedCountryId);

	/***************************************************************************/
	//MAIN MENU SUB MENU TOGGLE
	/***************************************************************************/
	$('.nav.navbar-nav > li.menu-item-has-children > a').on('click', function(event){
		event.preventDefault();
		$(this).parent().find('.sub-menu').toggle();
		$(this).parent().find('.sub-menu li .sub-menu').hide();
	});

	$('.nav.navbar-nav li .sub-menu li.menu-item-has-children > a ').on('click', function(event){
		event.preventDefault();
		$(this).parent().find('.sub-menu').toggle();
	});

	/***************************************************************************/
	//TABS
	/***************************************************************************/
	$( function() {
	    $( ".tabs" ).tabs({
			create: function(event, ui) { 
				$(this).fadeIn(); 
			}
		});
	});

	/***************************************************************************/
	//ACTIVATE CHOSEN 
	/***************************************************************************/
	$("select").chosen({disable_search_threshold: 11});

	/***************************************************************************/
	//ACCORDIONS
	/***************************************************************************/
	$(function() {
	    $( "#accordion" ).accordion({
	    	heightStyle: "content",
	    	closedSign: '<i class="fa fa-minus"></i>',
  			openedSign: '<i class="fa fa-plus"></i>'
	    });
	});
	
	/***************************************************************************/
	//SLICK SLIDER - SIMPLE SLIDER
	/***************************************************************************/
	$('.slider.slider-simple').slick({
		prevArrow: $('.slider-nav-simple-slider .slider-prev'),
		nextArrow: $('.slider-nav-simple-slider .slider-next'),
		adaptiveHeight: true,
		autoplay: true,
  		autoplaySpeed: 2000,
		fade: true
	});

	/***************************************************************************/
	//SLICK SLIDER - FEATURED PROPERTIES
	/***************************************************************************/
	$('.slider.slider-featured').slick({
		prevArrow: $('.slider-nav-properties-featured .slider-prev'),
		nextArrow: $('.slider-nav-properties-featured .slider-next'),
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [
			{
			  breakpoint: 990,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 767,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 589,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		]
	});

	/***************************************************************************/
	//SLICK SLIDER - TESTIMONIALS 
	/***************************************************************************/
	$('.slider.slider-testimonials').slick({
		prevArrow: $('.slider-nav-testimonials .slider-prev'),
		nextArrow: $('.slider-nav-testimonials .slider-next'),
		adaptiveHeight: true
	});

	/***************************************************************************/
	//SLICK SLIDER - PROPERTY GALLERY 
	/***************************************************************************/
	$('.slider.slider-property-gallery').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		adaptiveHeight: true,
		arrows: true,
		fade: true,
		infinite:false,
		asNavFor: '.property-gallery-pager',
		prevArrow: $('.slider-nav-property-gallery .slider-prev'),
		nextArrow: $('.slider-nav-property-gallery .slider-next'),
	});

	$('.property-gallery-pager').on('init', function(event, slick){
		$('.slide-counter').text('1 / ' + slick.slideCount);
	});

	$('.property-gallery-pager').slick({
		prevArrow: $('.slider-nav-property-gallery .slider-prev'),
		nextArrow: $('.slider-nav-property-gallery .slider-next'),
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '.slider.slider-property-gallery',
		dots: false,
		focusOnSelect: true,
		infinite:false
	});

	$('.property-gallery-pager').on('afterChange', function(event, slick, currentSlide, nextSlide){
		currentSlide = currentSlide + 1;
		var counter = currentSlide + ' / ' + slick.slideCount;
		$('.slide-counter').text(counter);
	});

	//INITIATE SLIDES
	$('.slide').addClass('initialized');

	/***************************************************************************/
	//FIXED HEADER
	/***************************************************************************/
	var navToggle = $('.header-default .navbar-toggle');
	var mainMenuWrap = $('.header-default .main-menu-wrap');
	
	if ($(window).scrollTop() > 140) { 
		navToggle.addClass('fixed'); 
		mainMenuWrap.addClass('fixed');
	}


	$(window).bind('scroll', function () {
		if ($(window).scrollTop() > 140) {
		    navToggle.addClass('fixed');
		    mainMenuWrap.addClass('fixed');
		} else {
		    navToggle.removeClass('fixed');
		    mainMenuWrap.removeClass('fixed');
		}
	});

	
	/***************************************************************************/
	//INITIALIZE BLOG CREATIVE
	/***************************************************************************/
	$('.grid-blog').isotope({
	  itemSelector: '.col-lg-4'
	});
	
	/***************************************************************************/
	//INITIALIZE PRICE RANGE SLIDER
	/***************************************************************************/
	// var sliders = document.getElementsByClassName('price-slider');
	// var count = 0;
	
	var saleMinPrice = parseInt($('[data-sale-min-price]').val());
	var saleMaxPrice = parseInt($('[data-sale-max-price]').val());
	var rentMinPricePerWeek = parseInt($('[data-rent-min-price-per-week]').val());
	var rentMaxPricePerWeek = parseInt($('[data-rent-max-price-per-week]').val());
	var rentMinPricePerMonth = parseInt($('[data-rent-min-price-per-month]').val());
	var rentMaxPricePerMonth = parseInt($('[data-rent-max-price-per-month]').val());
	
	var saleMinPricePound = parseInt($('[data-sale-min-price-pound]').val());
	var saleMaxPricePound = parseInt($('[data-sale-max-price-pound]').val());
	var rentMinPricePerWeekPound = parseInt($('[data-rent-min-price-per-week-pound]').val());
	var rentMaxPricePerWeekPound = parseInt($('[data-rent-max-price-per-week-pound]').val());
	var rentMinPricePerMonthPound = parseInt($('[data-rent-min-price-per-month-pound]').val());
	var rentMaxPricePerMonthPound = parseInt($('[data-rent-max-price-per-month-pound]').val());

	var saleSliderPrice = document.getElementById('price-slider');
	var saleSliderPricePound = document.getElementById('price-slider-pound');

	if (saleSliderPrice) {
		noUiSlider.create(saleSliderPrice, {
			connect: true,
			start: [saleMinPrice, saleMaxPrice],
			// step: 1000,
			margin: saleMinPrice == saleMaxPrice ? saleMinPrice : 0,
			range: {
				'min': [saleMinPrice],
				'max': [saleMaxPrice]
			},
			tooltips: false,
			format: wNumb({
				decimals: 0,
				thousand: ',',
				prefix: '€',
			})
		}).set(saleMinPrice - 1, saleMaxPrice + 1);

		$(saleSliderPrice).append("<div class='low-pr noUi-tooltip'>€" + saleMinPrice + "</div>");

		$(saleSliderPrice).append("<div class='high-pr noUi-tooltip'>€" + saleMaxPrice + "</div>");

		saleSliderPrice.noUiSlider.on('update', function ( values, handle ) {
			$(saleSliderPrice).find('.low-pr').text(values[0]);
			$(saleSliderPrice).find('.high-pr').text(values[1]);
		});
	}
	
	if (saleSliderPricePound) {
		noUiSlider.create(saleSliderPricePound, {
			connect: true,
			start: [saleMinPricePound, saleMaxPricePound],
			// step: 1000,
			margin: saleMinPricePound == saleMaxPricePound ? saleMinPricePound : 0,
			range: {
				'min': [saleMinPricePound],
				'max': [saleMaxPricePound]
			},
			tooltips: false,
			format: wNumb({
				decimals: 0,
				thousand: ',',
				prefix: '₤',
			})
		}).set(saleMinPricePound - 1, saleMaxPricePound + 1);

		$(saleSliderPricePound).append("<div class='low-pr noUi-tooltip'>₤" + saleMinPricePound + "</div>");

		$(saleSliderPricePound).append("<div class='high-pr noUi-tooltip'>₤" + saleMaxPricePound + "</div>");

		saleSliderPricePound.noUiSlider.on('update', function ( values, handle ) {
			$(saleSliderPricePound).find('.low-pr').text(values[0]);
			$(saleSliderPricePound).find('.high-pr').text(values[1]);
		});
	}

	var sliderRentPerWeek = document.getElementById('price-slider-rent-per-week');

	if (sliderRentPerWeek) {
		noUiSlider.create(sliderRentPerWeek, {
			connect: true,
			start: [rentMinPricePerWeek, rentMaxPricePerWeek],
			// step: 10,
			margin: rentMinPricePerWeek == rentMaxPricePerWeek ? rentMinPricePerWeek : 0,
			range: {
				'min': [rentMinPricePerWeek],
				'max': [rentMaxPricePerWeek]
			},
			tooltips: false,
			format: wNumb({
				decimals: 0,
				thousand: ',',
				prefix: '€',
			})
		}).set(rentMinPricePerWeek - 1, rentMaxPricePerWeek + 1);

		$(sliderRentPerWeek).append("<div class='low-pr noUi-tooltip'>€" + rentMinPricePerWeek + "</div>");

		$(sliderRentPerWeek).append("<div class='high-pr noUi-tooltip'>€" + rentMaxPricePerWeek + "</div>");

		sliderRentPerWeek.noUiSlider.on('update', function ( values, handle ) {
			$(sliderRentPerWeek).find('.low-pr').text(values[0]);
			$(sliderRentPerWeek).find('.high-pr').text(values[1]);
		});
	}

	var sliderRentPerMonth = document.getElementById('price-slider-rent-per-month');

	if (sliderRentPerMonth) {
		noUiSlider.create(sliderRentPerMonth, {
			connect: true,
			start: [rentMinPricePerMonth, rentMaxPricePerMonth],
			// step: 10,
			margin: rentMinPricePerMonth == rentMaxPricePerMonth ? rentMinPricePerMonth : 0,
			range: {
				'min': [rentMinPricePerMonth],
				'max': [rentMaxPricePerMonth]
			},
			tooltips: false,
			format: wNumb({
				decimals: 0,
				thousand: ',',
				prefix: '€',
			})
		}).set(rentMinPricePerMonth - 1, rentMaxPricePerMonth + 1);

		$(sliderRentPerMonth).append("<div class='low-pr noUi-tooltip'>€" + rentMinPricePerMonth + "</div>");

		$(sliderRentPerMonth).append("<div class='high-pr noUi-tooltip'>€" + rentMaxPricePerMonth + "</div>");

		sliderRentPerMonth.noUiSlider.on('update', function ( values, handle ) {
			$(sliderRentPerMonth).find('.low-pr').text(values[0]);
			$(sliderRentPerMonth).find('.high-pr').text(values[1]);
		});
	}

	var sliderRentPerWeekPound = document.getElementById('price-slider-rent-per-week-pound');

	if (sliderRentPerWeekPound) {
		noUiSlider.create(sliderRentPerWeekPound, {
			connect: true,
			start: [rentMinPricePerWeekPound, rentMaxPricePerWeekPound],
			// step: 10,
			margin: rentMinPricePerWeekPound == rentMaxPricePerWeekPound ? rentMinPricePerWeekPound : 0,
			range: {
				'min': [rentMinPricePerWeekPound],
				'max': [rentMaxPricePerWeekPound]
			},
			tooltips: false,
			format: wNumb({
				decimals: 0,
				thousand: ',',
				prefix: '₤',
			})
		}).set(rentMinPricePerWeekPound - 1, rentMaxPricePerWeekPound + 1);

		$(sliderRentPerWeekPound).append("<div class='low-pr noUi-tooltip'>€" + rentMinPricePerWeekPound + "</div>");

		$(sliderRentPerWeekPound).append("<div class='high-pr noUi-tooltip'>€" + rentMaxPricePerWeekPound + "</div>");

		sliderRentPerWeekPound.noUiSlider.on('update', function ( values, handle ) {
			$(sliderRentPerWeekPound).find('.low-pr').text(values[0]);
			$(sliderRentPerWeekPound).find('.high-pr').text(values[1]);
		});
	}

	var sliderRentPerMonthPound = document.getElementById('price-slider-rent-per-month-pound');

	if (sliderRentPerMonthPound) {
		noUiSlider.create(sliderRentPerMonthPound, {
			connect: true,
			start: [rentMinPricePerMonthPound, rentMaxPricePerMonthPound],
			// step: 10,
			range: {
				'min': [rentMinPricePerMonthPound],
				'max': [rentMaxPricePerMonthPound]
			},
			margin: rentMinPricePerMonthPound == rentMaxPricePerMonthPound ? rentMinPricePerMonthPound : 0,
			tooltips: false,
			format: wNumb({
				decimals: 0,
				thousand: ',',
				prefix: '₤',
			})
		}).set(rentMinPricePerMonthPound - 1, rentMaxPricePerMonthPound + 1);

		$(sliderRentPerMonthPound).append("<div class='low-pr noUi-tooltip'>€" + rentMinPricePerMonthPound + "</div>");

		$(sliderRentPerMonthPound).append("<div class='high-pr noUi-tooltip'>€" + rentMaxPricePerMonthPound + "</div>");

		sliderRentPerMonthPound.noUiSlider.on('update', function ( values, handle ) {
			$(sliderRentPerMonthPound).find('.low-pr').text(values[0]);
			$(sliderRentPerMonthPound).find('.high-pr').text(values[1]);
		});
	}

	/***************************************************************************/
	//FILTER TOGGLE (ON GOOGLE MAPS)
	/***************************************************************************/
	$('.filter-toggle').on('click', function() {
		$(this).parent().find('form').stop(true, true).slideToggle();
	});

	/***************************************************************************/
	//MULTIPAGE FORM
	/***************************************************************************/
	$('.multi-page-form .form-next').on('click', function() {

		//validate required fields
		var errors = [];
		$('.multi-page-form').find('.error').remove();
		$( ".multi-page-form .multi-page-form-content.active input.required" ).each(function( index ) {
			if(!$(this).val()) {
				$(this).parent().find('label').append('<span class="error"> This field is required</span>');
				errors.push(index);
			}
		});

		//if no errors
		if (errors.length === 0) {

			var active = $(this).parent().parent().find('.multi-page-form-content.active');

			$(this).parent().parent().find('.form-nav .form-nav-item.completed').next().addClass('completed');
			$(this).parent().parent().find('.form-nav .form-nav-item.completed span').html('<i class="fa fa-check"></i>');

			if(active.next('.multi-page-form-content').next('.multi-page-form-content').length > 0) {
			    active.removeClass('active');
				active.next().addClass('active');
			}
			else {
				active.removeClass('active');
				active.next().addClass('active');
			}
		}
	});

	$('.multi-page-form .form-prev').on('click', function() {
		var active = $(this).parent().parent().find('.multi-page-form-content.active');

		var lastCompleted = $(this).parent().parent().find('.form-nav .form-nav-item.completed').last();
		lastCompleted.removeClass('completed');
		lastCompleted.find('span').html(lastCompleted.index() + 1);

		if(active.prev('.multi-page-form-content').prev('.multi-page-form-content').length > 0) {
		    active.removeClass('active');
			active.prev().addClass('active');
		}
		else {
			active.removeClass('active');
			active.prev().addClass('active');
		 	$(this).addClass('show-none');
		 	$(this).parent().find('.disabled').show();
		}
	});

	/******************************************************************************/
	/** SUBMIT PROPERTY - ADDITIONAL IMAGES  **/
	/******************************************************************************/
	var files_count = $('.additional-img-container .additional-image').length + 1;
    $('.add-additional-img').on('click', function() {
        files_count++;
        $('.additional-img-container').append('<table><tr><td><div class="media-uploader-additional-img"><input type="file" class="additional_img" name="additional_img'+ files_count +'" value="" /><span class="delete-additional-img appended right"><i class="fa fa-trash"></i> Delete</span></div></td></tr></table>');
    });

    $('.additional-img-container').on("click", ".delete-additional-img", function() {
        $(this).parent().parent().parent().parent().parent().remove();
    });

    /******************************************************************************/
	/** SUBMIT PROPERTY - OWNER INFO **/
	/******************************************************************************/
	$('#owner-info input[type="radio"]').on('click', function() {
		var input = $(this).val();
		$('#owner-info .form-block-agent-options').hide();
		if(input === 'agent') {
			$('#owner-info .form-block-select-agent').slideDown('fast');
		}
		if(input === 'custom') {
			$('#owner-info .form-block-custom-agent').slideDown('fast');
		}
	});
	
	/***************************************************************************/
	//AJAX CONTACT FORM
	/***************************************************************************/
	
    $(document).on('submit', 'form#contact-us', function() {
            $('form#contact-us .error').remove();
            var hasError = false;
            $('.requiredField').each(function() {
                if($.trim($(this).val()) === '') {
                    $(this).parent().find('label').append('<span class="error">This field is required!</span>');
                    $(this).addClass('inputError');
                    hasError = true;
                } else if($(this).hasClass('email')) {
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(!emailReg.test($.trim($(this).val()))) {
                        $(this).parent().find('label').append('<span class="error">Sorry! You\'ve entered an invalid email.</span>');
                        $(this).addClass('inputError');
                        hasError = true;
                    }
                }
            });
            if(!hasError) {
                var formInput = $(this).serialize();
                $.post($(this).attr('action'),formInput, function(data){
                    $('form#contact-us').slideUp("fast", function() {                  
                        $(this).before('<p class="alert-box success"><i class="fa fa-check icon"></i><strong>Thanks!</strong> Your email has been delivered!</p>');
                    });
                });
            }
            
            return false;   
    });
    

});



/* HEADER PHONE / MAIL LINKS */

$( document ).ready(function() {
   
	var win = $(window);
	var mobileBtn =  $('.mobile-phone');
	var mailBtn =  $('.mobile-mail');
	var mobileText = $('.mobile-phone-text');
	var mailText = $('.mail-phone-text');
	
	var added = false;
	
	
	function addMMEvents(){
		if (!added){
			mobileBtn.on('click', toggleMobile);
			mailBtn.on('click', toggleMail);
			added = true;
		}
	}
	
	function removeMMEvents(){
		if (added){
			mobileBtn.off('click', toggleMobile, false);
			mailBtn.off('click', toggleMail, false);
			added = false;
		}
	
	}
	function checkWidth(){
		if (window.innerWidth > 991){
			removeMMEvents();
			showAll();
		}else{
	
			addMMEvents();
			hideAll();
		}
	}
	
	function hideAll(){
		mobileText.hide();
		mailText.hide();
	}
	
	function showAll(){
		mobileText.show();
		mailText.show();
	}
	
	function toggleMobile(){
		mailText.hide();
		mobileText.toggle();
	}
	
	function toggleMail(){
		mobileText.hide();
		mailText.toggle();
	}
	
	checkWidth();
	win.on('resize', checkWidth);
	})

	// $( ".noUi-handle-lower .noUi-tooltip" ).change(function() {
	// 	console.log(1)
	// });

	// $('.noUi-handle-lower .noUi-tooltip').bind("DOMSubtreeModified",function(){
	// 	console.log(2)
	// });
		

	// $('.noUi-handle-lower .noUi-tooltip').bind("DOMSubtreeModified",function(){
	// 	console.log(3)
	//   })

	//   jQuery(".noUi-handle-lower .noUi-tooltip").bind( 'DOMSubtreeModified',function(){ // отслеживаем изменение содержимого блока 2
	// 	console.log(4)
	// });


	// var div = $('#slider-price-sale .noUi-handle-lower');
	// div.on('click', function () {
	// 	console.log(12311231321)
	// 	console.log(this.innerHTML)
	// })
	// div.onchange = function(e){
	// 	alert(this.innerHTML);
	// };

