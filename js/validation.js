$(document).ready(function() {
    $('#name').on('blur', validateText);
    $('#email').on('blur', validateEmail);
    $('#mobile').on('blur', validateMobile);
    $('#password').on('blur', validatePassword);
    $('#reg-form').on('submit', function(e) {
        $(this).find('input').each(function() {
            if ($(this).hasClass('has-error')) {
                e.preventDefault();
                $('.reg-message').html('Fill all fields !!!.');
            } else {
                $('.reg-message').html('');
            }
        });
    });
});

function validateText() {
    let value = $(this).val();
    if (value == '') {
        $(this).next().html("Fill this field !!!.");
    } else if (value.length < 3 || value.length > 20) {
        $(this).next().html("Length should be between 3 to 20 charecter !!!.");
    } else if (!isNaN(value)) {
        $(this).next().html("Only Charecters allowed !!!.");
    } else {
        $(this).removeClass('has-error');
        $(this).next().html("");
    }
}

function validateEmail() {
    let value = $(this).val();
    let emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    if (value == '') {
        $(this).next().html("Fill this field !!!.");
    } else if (!emailPattern.test(value)) {
        $(this).next().html("Enter a valid email !!!.");
    } else {
        $(this).removeClass('has-error');
        $(this).next().html("");
    }
}

function validateMobile() {
    let value = $(this).val();
    let mobilePattern = /^([+]\d{2})?\d{10}$/;
    if (value == '') {
        $(this).next().html("Fill this field !!!.");
    } else if (!mobilePattern.test(value)) {
        $(this).next().html("Enter a valid mobile number !!!.");
    } else {
        $(this).removeClass('has-error');
        $(this).next().html("");
    }
}

function validatePassword() {
    let value = $(this).val();
    let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/;
    if (value == '') {
        $(this).next().html("Fill this field !!!.");
    } else if (value.length < 8) {
        $(this).next().html("Minimum 8 charecters required !!!.");
    } else if (!passwordPattern.test(value)) {
        $(this).next().html("Password must contain one uppercase<br> letter and one special charecter !!!.");
    } else {
        $(this).removeClass('has-error');
        $(this).next().html("");
    }
}