$(document).ready(function() {
    $('#subject-list').on('change', loadTopic);
    loadTopic();
});

function loadTopic() {
    let subject = $('#subject-list').find(':selected').val();
    let topic = $('#subject-list').find(':selected').data('topic');
    if (topic == '') {
        data = { id: subject, topic: 0 }
    } else {
        data = { id: subject, topic: topic }
    }
    $.ajax({
        url: "get-topics.php",
        method: "POST",
        data: data,
        success: function(res) {
            $('#topics-list').html(res);
        },
    });
}