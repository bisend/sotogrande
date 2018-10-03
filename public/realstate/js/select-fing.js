$(document).ready(function () {
    checkSaleCountries();
    checkRentCountries();
});

function checkSaleCountries () {
    $('.location-any').attr('selected', false);
    
    $( "#search_sale-location option" ).each(function() {
        if($(this).hasClass('location-any')){
            $(this).attr('selected', true);
        }else{
            $(this).attr('selected', false);
        }
    });
    
    $('#search_sale_location_chosen .chosen-single span').html('Any')

    $('style[id=style-select-sale]').remove();

    $('head').append('<style>#search_sale_location_chosen .chosen-results li{display:none;}</style>');
    
    var classSelect = saleSelectedCountryId;
    if(classSelect == '') {
        $('head').append('<style id="style-select-sale">#search_sale_location_chosen .chosen-results li{display:block;}</style>')
    }else{
        $('head').append('<style id="style-select-sale">#search_sale_location_chosen .chosen-results .country-'+classSelect+'{display:block;}</style>')
    }
}

function checkRentCountries () {
    $('.location-any').attr('selected', false);

    $( "#search_rent-location option" ).each(function() {
        if($(this).hasClass('location-any')){
            $(this).attr('selected', true);
        }else{
            $(this).attr('selected', false);
        }
    });

    $('#search_rent_location_chosen .chosen-single span').html('Any')

    $('style[id=style-select-rent]').remove();

    $('head').append('<style>#search_rent_location_chosen .chosen-results li{display:none;}</style>')

    var classSelect = rentSelectedCountryId;
    if(classSelect == ''){
        $('head').append('<style id="style-select-rent">#search_rent_location_chosen .chosen-results li{display:block;}</style>')
    }else{
        $('head').append('<style id="style-select-rent">#search_rent_location_chosen .chosen-results .country-'+classSelect+'{display:block;}</style>')
    }
}

$('#search_sale-country').on('change', function () {

    $('.location-any').attr('selected', false);

    $( "#search_sale-location option" ).each(function() {
        if($(this).hasClass('location-any')){
            $(this).attr('selected', true);
        }else{
            $(this).attr('selected', false);
        }
    });

    $('#search_sale_location_chosen .chosen-single span').html('Any')

    $('style[id=style-select-sale]').remove();

    $('head').append('<style>#search_sale_location_chosen .chosen-results li{display:none;}</style>')
    
    var classSelect = $(this).val();
    if(classSelect == ''){
        $('head').append('<style id="style-select-sale">#search_sale_location_chosen .chosen-results li{display:block;}</style>')
    }else{
        $('head').append('<style id="style-select-sale">#search_sale_location_chosen .chosen-results .country-'+classSelect+'{display:block;}</style>')
    }

})



$('#search_rent-country').on('change', function () {

    $('.location-any').attr('selected', false);

    $( "#search_rent-location option" ).each(function() {
        if($(this).hasClass('location-any')){
            $(this).attr('selected', true);
        }else{
            $(this).attr('selected', false);
        }
    });

    $('#search_rent_location_chosen .chosen-single span').html('Any')

    $('style[id=style-select-rent]').remove();

    $('head').append('<style>#search_rent_location_chosen .chosen-results li{display:none;}</style>')

    var classSelect = $(this).val();
    if(classSelect == ''){
        $('head').append('<style id="style-select-rent">#search_rent_location_chosen .chosen-results li{display:block;}</style>')
    }else{
        $('head').append('<style id="style-select-rent">#search_rent_location_chosen .chosen-results .country-'+classSelect+'{display:block;}</style>')
    }

});


$('.beds-radio input').on('change', function () {
    
    $( ".beds-radio input" ).each(function() {
        if($(this).is(':checked')){
            $(this).parent('p').find('span').addClass('active-check-text');
        }else{
            $(this).parent('p').find('span').removeClass('active-check-text');
        }
    });
})


  