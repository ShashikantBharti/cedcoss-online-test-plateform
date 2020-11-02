$(document).ready(function() {
    let questionAnser = {};
    $('.login').hide();
    $('#login-btn').on('click', function() {
        $('.login').fadeIn();
    });
    $('#close-btn').on('click', function() {
        $('.login').fadeOut();
    });
    $(document).on('click', '.option', recordAnsers);
    $('#start-btn').on('click', function() {
        $('.pagination').show();
        $('.question').show();
    });
});

function recordAnsers() {
    let anser = $(this).val();
    let qid = $(this).data('qid');
    $.ajax({
        url: "ansers.php",
        method: "POST",
        data: { qid: qid, anser: anser },
        success: function(res) {
            console.log(res);
        },
    });
}

function login() {
    let username = $('#username').val();
    let userpassword = $('#userpassword').val();
    $.ajax({
        url: "login.php",
        method: "POST",
        data: { username: username, userpassword: userpassword },
        success: function(res) {
            if (res == 1) {
                window.location.href = window.location.href;
            } else {
                $('.error-message').html('User ID or Password is Incorrect.');
            }
        },
    });
}