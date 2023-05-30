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
        data: { action: "get" },
        success: function(response) {
            $(".chat-space w-100").html(response);
        }
    });
}

function sendMessage() {
    var message = $("#message").val();
    if (message !== "") {
        $.ajax({
            url: "controller/chat.php",
            type: "POST",
            data: { action: "send", message: message },
            success: function() {
                $("#text").val("");
                getMessages();
            }
        });
    }
}