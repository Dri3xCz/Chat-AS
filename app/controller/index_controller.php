<?php

function chatArea() {
    $status = isset($_GET["status"]) ? $_GET["status"] : "";

    if($status == "adding_friends") {
        friendArea();
    } else {
        echo '<div class="chat-space w-100">';
            echo '<div class="chat-message w-75 mt-2">';
                echo '<div class="message-info d-flex align-items-center">';
                    echo '<img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">';
                    echo '<h3>Placeholder <span>Datum</span></h3>';
                echo '</div>';
                echo '<div class="message-content ml-5">';
                    echo '<p class="ml-5">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Ut tempus purus at lorem. Integer malesuada. Vivamus porttitor turpis ac leo. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Etiam dictum tincidunt diam. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit q</p>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<form class="message-box w-100 d-flex ml-5 method="post">';
            echo '<input class="w-75 ml-5" type="text" id="text" name="text">';
            echo '<input type="submit" class="message-box-submit" value="">';
        echo '</form>';
    }
}

function friendArea() {
    echo '<form action="./controller/friend_request.php" method="post">
        <input type="text" name="username">
        <input type="submit" value="Send request"> 
    </form>';
}

?>