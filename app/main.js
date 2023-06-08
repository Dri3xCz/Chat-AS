$(document).ready(function() {
    getMessages();

    $("#text").keypress(function(event) {
        if (event.which === 13) {
            sendMessage();
        }
    });

    setInterval(getMessages, 3000);
});

function getMessages() {
    $.ajax({
        url: "controller/chat.php",
        type: "POST",
        data: { action: "get"},
        success: function(response) {
            $('#chatSpace').html(response);
        }
    });
    var element = document.querySelector('#chatSpace');
    element.scrollTop = element.scrollHeight;
}

function sendMessage() {
    var message = $("#text").val();
    if (message !== "") {
        $.ajax({
            url: "controller/chat.php",
            type: "POST",
            data: { action: "send", message: message},
            success: function() {
                $("#text").val("");
                getMessages();
            }
        });
    }
}