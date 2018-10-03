$('#find-sale').on('click', function (e) {
    e.preventDefault();
    var type = $('#search_sale-type').val();
    var location = $('#search_sale-location').val();

    var beds = '';

    $('.beds-item-sale input').each(function(){
        if($(this).is(':checked')){
            beds = $(this).val();
        }
    })

    var country = $('#search_sale-country').val()

    if (saleSelectedCountryId == 1) {
        var lower = $('#price-slider-pound .low-pr').html();
        var upper = $('#price-slider-pound .high-pr').html();
    } else {
        var lower = $('#price-slider .low-pr').html();
        var upper = $('#price-slider .high-pr').html();
    }

    var urlFilters = '/sale?search=true&';

    var referValSale = $('#refer-val-sale').val();

    var urlFiltersRef = '/property/';

    if(referValSale !== '') {
        urlFilters += 'property=' + referValSale;
        window.location.href = urlFilters;
    } else {
        var filters = [];

        if(type !== '' ){
            var t = {
                name: 'type',
                val: type
            }
           filters.push(t);
       }

       if(country !== ''){
        var c = {
            name: 'country',
            val: country
        }
       filters.push(c);
    }

       if(location !== ''){
           var l = {
               name: 'location',
               val: location
           }
          filters.push(l);
       }
       if(beds !== ''){
           var b = {
               name: 'beds',
               val: beds
           }
          filters.push(b);
       }
   
       filters.forEach(function(item){
           urlFilters += item.name+'='+item.val+'&';
       });
       
       if(lower !== ''){
           var lprice = {
            name: 'lower',
            val: lower.replace('₤', '').replace('€', '').replace(/,/g , '')
        }
        urlFilters += lprice.name + '=' + lprice.val + '&';
        }
        if(upper !== ''){
            var uprice = {
                name: 'upper',
                val: upper.replace('₤', '').replace('€', '').replace(/,/g , '')
            }
            urlFilters += uprice.name + '=' + uprice.val;
        }

        urlFilters += '&currency-id=' + (saleSelectedCountryId == 1 ? 2 : 1);
       
       window.location.href = urlFilters;
    }
});