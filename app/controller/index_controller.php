<?php

$path = $_SERVER['DOCUMENT_ROOT'];

require_once($path . '/usecase/UserUseCase.php');
require_once($path . '/usecase/friend_usecase.php');
require_once($path . '/repository/friend_repository.php');
include($path . '/connection.php');

session_start();

function chatArea($conn) {
    $status = isset($_GET["status"]) ? $_GET["status"] : "";

    if($status == "adding_friends") {
        friendArea($conn);
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

function friendArea($conn) {
    echo '<div class="mt-2 container-fluid">
        <div>
            <h3>Přidat přítele</h3>
            <form class="message-box w-100 d-flex" method="post" action="/controller/friend_request.php">
                <input class="w-75" type="username" id="username" name="username">
                <input type="submit" class="message-box-submit" value="">
            </form> 
        </div>
        <div class="mt-2 row">
            <div class="col-lg-8 col-md-10">
                <h3>Žádosti o přátelství</h3>';
                friendRequestsArea($conn);
            echo '</div>
        </div>
    </div>';
}

function friendRequestsArea($conn) {

    $active_user = $_SESSION['user'];
    
    $id_repository = new UserFindRepository($conn);
    $id_usecase = new GetUserIdUseCase($id_repository);

    $active_user = $id_usecase->getId($active_user);

    $friend_repository = new FriendRequestRepository($conn);
    $friend_usecase = new FetchFriendRequests($friend_repository, $id_repository, $active_user);
    $request_array = $friend_usecase->GetRequests();

    for($i = 0; $i < count($request_array); $i++) {
        friendRequestHtml($request_array[$i]);
    }
}

function friendListArea($conn) {

    $active_user = $_SESSION['user'];
    
    $id_repository = new UserFindRepository($conn);
    $id_usecase = new GetUserIdUseCase($id_repository);

    $active_user = $id_usecase->getId($active_user);
    $friendships = $id_usecase->selectFriendships($active_user);

    for($i = 0; $i < count($friendships); $i++) {
        friendListHtml($friendships[$i]);
    }
}

function friendRequestHtml($user) {
    echo "<div class='chat-buffer d-flex justify-content-between'>
        <div class='chat-buffer-inside d-flex h-100'>
            <img src='assets/img/foxpfp.jpg' class='profile-pic' alt=''>
            <h3 class='username ml-2'>{$user->name}</h3>
        </div>
        <form class='friend-request-buttons mr-2' method='post' action='{$path}/controller/friend_request_response.php'>
            <input type='hidden' name'user_id' value='{$user->user_id}'>
            <input type='submit' name='response' value='accept' class='accept-input'>
            <input type='submit' name='response' value='decline' class='decline-input'>
        </form>
    </div>";
}

function friendListHtml($user) {
    echo "<div class='chat-buffer d-flex'>
            <img src='assets/img/foxpfp.jpg' class='profile-pic' alt=''>
            <h3 class='username'>{$user['username']}</h3>
        </div>";
}

?>