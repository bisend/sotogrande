function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

$("#contact-phone").keypress(function (e) {
    if (e.which != 43 && e.which != 41 && e.which != 40 && e.which != 46 && e.which != 45 && e.which != 46 &&
        !(e.which >= 48 && e.which <= 57)) {
        return false;
    }
});

$('#submit-contact-form').on('click', function (e) {
    e.preventDefault();

    var name = $('#contact-name').val();
    var email = $('#contact-email').val();
    var phone = $('#contact-phone').val();
    var subject = 'New feedback';
    var message = $('#contact-message').val();
    var token = $('[name="_token"]').val();

    var saveEmail = $('#contact-email').val();

    var error = false;

    $('#contact-email').on('focus', function () {
        $('#contact-email').attr('placeholder', '');
        $('#contact-email').val(saveEmail);
    })

    if(name == ''){
        $('#contact-name').val('');
        $('#contact-name').attr('placeholder', 'Enter name');
        $('#contact-name').addClass('incorect-input');
        error = true;
    }else{
        $('#contact-name').removeClass('incorect-input');
    }

    if (name.length > 30) {
        $('#contact-name').val('');
        $('#contact-name').attr('placeholder', 'Maximum 30 characters');
        $('#contact-name').addClass('incorect-input');
        error = true;
    }

    if (!validateEmail(email)) {
        $('#contact-email').val('');
        $('#contact-email').attr('placeholder', 'Enter the correct email');
        $('#contact-email').addClass('incorectEmail');
        $('#contact-email').addClass('incorect-input');
        error = true;
    }else{
        $('#contact-email').removeClass('incorect-input');
    }

    if(phone == ''){
        $('#contact-phone').val('');
        $('#contact-phone').attr('placeholder', 'Enter phone');
        $('#contact-phone').addClass('incorect-input');
        error = true;
    }else{
        $('#contact-phone').removeClass('incorect-input');
    }

    if(message == ''){
        $('#contact-message').val('');
        $('#contact-message').attr('placeholder', 'Enter message');
        $('#contact-message').addClass('incorect-input');
        error = true;
    }else{
        $('#contact-message').removeClass('incorect-input');
    }

    if(error == false){

        $.ajax({
            url: '/mail/sendcontact',
            type: 'POST',
            data: {
                _token: token,
                name: name,
                email: email,
                phone: phone,
                subject: subject,
                message: message
            },
            success: function (data) {
                if (data.success) {
                    $('#contact-name').val('');
                    $('#contact-name').attr('placeholder', 'Name');
                    $('#contact-name').removeClass('incorect-input');

                    $('#contact-email').val('');
                    $('#contact-email').attr('placeholder', 'Email');
                    $('#contact-email').removeClass('incorect-input');

                    $('#contact-phone').val('');
                    $('#contact-phone').attr('placeholder', 'Phone Number');
                    $('#contact-phone').removeClass('incorect-input');

                    $('#contact-subject').val('');
                    $('#contact-subject').attr('placeholder', 'Subject');
                    $('#contact-subject').removeClass('incorect-input');

                    $('#contact-message').val('');
                    $('#contact-message').attr('placeholder', 'Message');
                    $('#contact-message').removeClass('incorect-input');

                    saveEmail = '';
                    $('#successModal').modal('show');
                }

            },
            error: function (error) {
                console.log(error);
            }
        });
    }




})
