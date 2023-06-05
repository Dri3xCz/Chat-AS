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

function toggleFriendList() {
    const friendList = document.getElementById("friend-list")
    const toggleButton = document.getElementById("toggle-button")
    const chat = document.getElementById("chat-main")
    if (friendList.style.display == "none"){
        friendList.style.display = "block"
        toggleButton.style.display = "none"
        chat.classList.add("col-8")
        chat.classList.add("col-lg-10")
        chat.classList.remove("w-100")
    }
    else {
        friendList.style.display = "none"
        toggleButton.style.display = "block"
        chat.classList.remove("col-8")
        chat.classList.remove("col-lg-10")
        chat.classList.add("w-100")
    }
}