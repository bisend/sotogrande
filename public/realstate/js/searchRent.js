// search-rent
// search_rent-type
// search_rent-location
// search_rent-beds
//price-rent


$('#find-rent-btn').on('click', function (e) {
    e.preventDefault();
    var typeRent = $('#search_rent-type').val();
    var locationRent = $('#search_rent-location').val();
    var bedsRent = '';
    var countryRent = $('#search_rent-country').val();

    $('.beds-item-rent input').each(function(){
        if($(this).is(':checked')){
            bedsRent = $(this).val();
        }
    })

    if (parseInt(countryRent) == 1) {
        var lowerRentPerWeek = $('#price-slider-rent-per-week-pound .low-pr').html();
        var upperRentPerWeek = $('#price-slider-rent-per-week-pound .high-pr').html();
        var lowerRentPerMonth = $('#price-slider-rent-per-month-pound .low-pr').html();
        var upperRentPerMonth = $('#price-slider-rent-per-month-pound .high-pr').html();
    } else {
        var lowerRentPerWeek = $('#price-slider-rent-per-week .low-pr').html();
        var upperRentPerWeek = $('#price-slider-rent-per-week .high-pr').html();
        var lowerRentPerMonth = $('#price-slider-rent-per-month .low-pr').html();
        var upperRentPerMonth = $('#price-slider-rent-per-month .high-pr').html();
    }

    

    var urlFilters = '/rent?search=true&';
    var referValrent = $('#refer-val-rent').val();

    var urlFiltersRefRent = '/property/';

    if(referValrent !== ''){
        urlFilters += 'property=' + referValrent;
        window.location.href = urlFilters;
    } else {
        var filters = [];

        if(typeRent !== '' ){
            var t = {
                name: 'type',
                val: typeRent
            }
           filters.push(t);
       }

       if(countryRent !== ''){
        var c = {
            name: 'country',
            val: countryRent
        }
       filters.push(c);
    }

       if(locationRent !== ''){
           var l = {
               name: 'location',
               val: locationRent
           }
          filters.push(l);
       }
       if(bedsRent !== ''){
           var b = {
               name: 'beds',
               val: bedsRent
           }
          filters.push(b);
       }
   
       filters.forEach(function(item){
           urlFilters += item.name+'='+item.val+'&';
       });
       
       if(lowerRentPerWeek){
            var lpricePw = {
                name: 'lower-per-week',
                val: lowerRentPerWeek.replace('₤', '').replace('€', '').replace(/,/g , '')
            }
            if (parseInt(lpricePw.val) != 0) {
                urlFilters += lpricePw.name + '=' + lpricePw.val + '&';
            }
        }

        if(upperRentPerWeek !== ''){
            var upricePw = {
                name: 'upper-per-week',
                val: upperRentPerWeek.replace('₤', '').replace('€', '').replace(/,/g , '')
            }
            if (parseInt(upricePw.val) != 0) {
                urlFilters += upricePw.name + '=' + upricePw.val + '&';
            }
        }

        if(lowerRentPerMonth !== ''){
            var lpricePm = {
                name: 'lower-per-month',
                val: lowerRentPerMonth.replace('₤', '').replace('€', '').replace(/,/g , '')
            }
            if (parseInt(lpricePm.val) != 0) {
                urlFilters += lpricePm.name + '=' + lpricePm.val + '&';
            }
         }
         
        if(upperRentPerMonth !== ''){
            var upricePm = {
                name: 'upper-per-month',
                val: upperRentPerMonth.replace('₤', '').replace('€', '').replace(/,/g , '')
            }
            if (parseInt(upricePm.val) != 0) {
                urlFilters += upricePm.name + '=' + upricePm.val;
            }
        }

        urlFilters += '&currency-id=' + (rentSelectedCountryId == 1 ? 2 : 1);
       
       window.location.href = urlFilters;
    }
});