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

function toggleFriendList() {
    const friendList = document.getElementById("friend-list")
    const toggleButton = document.getElementById("toggle-button")
    const chat = document.getElementById("chat-main")
    if (friendList.style.display == "none"){
        friendList.style.display = "block"
        toggleButton.style.display = "none"
        chat.classList.remove("col-12")
    }
    else {
        friendList.style.display = "none"
        toggleButton.style.display = "block"
        chat.classList.add("col-12")
    }
}