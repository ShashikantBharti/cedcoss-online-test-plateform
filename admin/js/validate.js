$(document).ready(function() {
    $('#add-subject').on('blur', validateText);
    $('#add-topic').on('blur', validateText);
    $('#add-subject-form').on('submit', validateForm);
    $('#add-topic-form').on('submit', validateForm);
    $('#add-question-form').on('submit', validateForm);

});

function validateForm(e) {
    $(this).find('input').each(function() {
        if ($(this).hasClass('has-error')) {
            e.preventDefault();
            $(`${this} p:last-child`).html('Enter Valid Subject !!!.');
        } else {
            $(`${this} p:last-child`).html('');
        }
    });
}

function validateText() {
    let value = $(this).val();
    if (value == '') {
        $(this).next().html("Fill this field !!!.");
    } else if (value.length < 3 || value.length > 20) {
        $(this).next().html("Length must be between 3 to 20 !!!.");
    } else if (!isNaN(value)) {
        $(this).next().html("Numbers not allowed !!!.");
    } else {
        $(this).next().html();
        $(this).removeClass('has-error');
    }
}