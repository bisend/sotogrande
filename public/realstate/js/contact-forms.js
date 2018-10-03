

/* -- TABS FORM  -- */

$('.close-tab-forms').on('click', function () {
    $('.tabs-form').removeClass('tab-forms-show')
})

$('.open-tab-forms').on('click', function () {
    console.log(1)
    if($('.tabs-form').hasClass('tab-forms-show')){
        console.log(2)
    }else{
        console.log(3)
        $('.tabs-form').addClass('tab-forms-show')
    }
})



if (window.innerWidth < 991) {
    $('.tabs-form').removeClass('tab-forms-show')

    $('.close-tab-forms').on('click', function () {
        $('.tabs-form').removeClass('tabs-show-mobile')
    })

    $('.open-tab-forms').on('click', function () {
        console.log(1)
        if($('.tabs-form').hasClass('tabs-show-mobile')){
            console.log(2)
        }else{
            console.log(3)
            $('.tabs-form').addClass('tabs-show-mobile')
        }
    })
}





/* -- TABS FORM  END-- */

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
        'sitekey': '6Le6d1oUAAAAAALuQXyL6Z1oqWd2qg2Er2tp1iPj',
        'callback': verifyCallback
    });
    widgetId2 = grecaptcha.render(document.getElementById('reg-back-captcha'), {
        'sitekey': '6Le6d1oUAAAAAALuQXyL6Z1oqWd2qg2Er2tp1iPj',
        'callback': verifyCallbackReg
    });

};

$(document).ready(function () {
    $('.show-register').on('click', function () {
        $('.Register-Interest').toggleClass('form-active-registr');
        $('.Register-Interest').toggleClass('form-active-mob-reg');
    })

    $('.show-collback').on('click', function () {
        $('.Call-Back-wrap').toggleClass('form-active');
        $('.Call-Back-wrap').toggleClass('form-active-mob');
    })
});

if (window.innerWidth < 991) {
    $('.Register-Interest').removeClass('form-active');
    $('.Call-Back-wrap').removeClass('form-active');


    $('.show-register').on('click', function () {
        $('.Call-Back-wrap').removeClass('form-active');
        $('.Call-Back-wrap').removeClass('form-active-mob');

    })

    $('.show-collback').on('click', function () {
        $('.Register-Interest').removeClass('form-active-registr');
        $('.Register-Interest').removeClass('form-active-mob-reg');
    })


    // $('.Register-Interest').addClass('form-active-mob');
    // $('.Call-Back-wrap').addClass('form-active-mob');

}

// $( window ).resize(function() {
//    if(window.innerWidth < 991){
//     $('.Register-Interest').removeClass('form-active');
//     $('.Call-Back-wrap').removeClass('form-active');
//    }
//   });

/* ---    send-register-form     ---- */

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

$("#register-phone").keypress(function (e) {
    if (e.which != 43 && e.which != 41 && e.which != 40 && e.which != 46 && e.which != 45 && e.which != 46 &&
        !(e.which >= 48 && e.which <= 57)) {
        return false;
    }
});

$("#call-back-phone").keypress(function (e) {
    if (e.which != 43 && e.which != 41 && e.which != 40 && e.which != 46 && e.which != 45 && e.which != 46 &&
        !(e.which >= 48 && e.which <= 57)) {
        return false;
    }
});

$('#send-register-form').on('click', function (e) {
    e.preventDefault();

    var regPage = window.location.href;
    var name = $('#register-name').val();
    var email = $('#register-email').val();
    var phone = $('#register-phone').val();
    var token = $('[name="_token"]').val();
    var saveEmail = $('#register-email').val();
    var registrError = false;


    $('#register-email').on('focus', function () {
        $('#register-email').attr('placeholder', '');
        $('#register-email').val(saveEmail);
    })

    if (name == '') {
        $('#register-name').val('');
        $('#register-name').attr('placeholder', 'Enter the correct name');
        $('#register-name').addClass('incorect-input');
        registrError = true;
    }

    if (name.length > 30) {
        $('#register-name').val('');
        $('#register-name').attr('placeholder', 'Maximum 30 characters');
        $('#register-name').addClass('incorect-input');
        registrError = true;
    }

    if (phone == '') {
        $('#register-phone').val('');
        $('#register-phone').attr('placeholder', 'Enter phone number');
        $('#register-phone').addClass('incorect-input');
        registrError = true;
    }

    if (!validateEmail(email)) {
        $('#register-email').val('');
        $('#register-email').attr('placeholder', 'Enter the correct email');
        $('#register-email').addClass('incorectEmail');
        $('#register-email').addClass('incorect-input');
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
                regPage: regPage
            },
            success: function (data) {
                if (data.status == 'success') {
                    $('#register-name').val('');
                    $('#register-name').attr('placeholder', 'Name');
                    $('#register-name').removeClass('incorect-input');

                    $('#register-email').val('');
                    $('#register-email').attr('placeholder', 'Email');
                    $('#register-email').removeClass('incorect-input');

                    $('#register-phone').val('');
                    $('#register-phone').attr('placeholder', 'Phone Number');
                    $('#register-phone').removeClass('incorect-input');

                    saveEmail = '';

                    console.log('registr send')
                    grecaptcha.reset();
                    $('#successModal').modal('show')

                }

            },
            error: function (error) {
                console.log(error);
            }
        });


    }

})


/* ---    send-register-form END     ---- */



/* CALL BACK FORM */

/* ---    send-register-form     ---- */


$('#send-coll-back').on('click', function (e) {
    e.preventDefault();

    var name = $('#call-back-name').val();
    var phone = $('#call-back-phone').val();
    var backPage = window.location.href;
    var token = $('[name="_token"]').val();
    var callbackError = false;

    if (name == '') {
        $('#call-back-name').val('');
        $('#call-back-name').attr('placeholder', 'Enter the correct name');
        $('#call-back-name').addClass('incorect-input');
        callbackError = true;
    }

    if (name.length > 30) {
        $('#call-back-name').val('');
        $('#call-back-name').attr('placeholder', 'Maximum 30 characters');
        $('#call-back-name').addClass('incorect-input');
        callbackError = true;
    }

    if (phone == '') {
        $('#call-back-phone').val('');
        $('#call-back-phone').attr('placeholder', 'Enter phone number');
        $('#call-back-phone').addClass('incorect-input');
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
            // contentType: false,      
            // cache: false,       
            // processData: false,
            data: {
                _token: token,
                name: name,
                phone: phone,
                backPage: backPage
            },
            success: function (data) {
                if (data.status == 'success') {
                    $('#call-back-name').val('');
                    $('#call-back-name').attr('placeholder', 'Name');
                    $('#call-back-name').removeClass('incorect-input');

                    $('#call-back-phone').val('');
                    $('#call-back-phone').attr('placeholder', 'Phone');
                    $('#call-back-phone').removeClass('incorect-input');

                    console.log('call back send')
                    grecaptcha.reset();
                    $('#successModal').modal('show')

                }

            },
            error: function (error) {
                console.log(error);
            }
        });

    }

})

    /* -- CALL BACK FORM END --*/