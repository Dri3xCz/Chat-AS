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
        data: { action: "get", friend: findGetParameter("friendName")},
        success: function(response) {
            $('#chatSpace').html(response);
        }
    });
}

function sendMessage() {
    console.log("Click");
    var message = $("#text").val();
    if (message !== "") {
        $.ajax({
            url: "controller/chat.php",
            type: "POST",
            data: { action: "send", friend: findGetParameter("friendName"), message: message },
            success: function() {
                $("#text").val("");
                getMessages();
            }
        });
    }
}

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
          tmp = item.split("=");
          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}
