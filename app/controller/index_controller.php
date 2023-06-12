<?php
require_once __DIR__ . '/../usecase/user_usecase.php';
require_once __DIR__ . '/../usecase/friend_usecase.php';
require_once __DIR__ . '/../repository/friend_repository.php';
require_once __DIR__ . '/../connection.php';

session_start();

function chatArea($conn) {
    $status = isset($_GET["status"]) ? $_GET["status"] : "";

    if($status == "adding_friends") {
        friendArea($conn);
    } else {
        echo '<div class="chat-space w-100" id="chatSpace">';
        echo '</div>';
        echo '<div class="message-box w-100 d-flex ml-1 ml-lg-5">';
            echo '<input class="w-75 ml-1 ml-lg-5" type="text" id="text" name="text">';
            echo '<button type="submit" onclick="sendMessage()" class="message-box-submit" value="">';
        echo '</div>';
    }
}

function friendArea($conn) {
    $error = isset($_GET["error"]) ? $_GET["error"] : "";

    echo "<div class='mt-2 container-fluid'>
        <div>
            <h3>Přidat přítele</h3>
            <form class='message-box w-100 d-flex' method='post' action='controller/friend_request.php'>
                <input class='w-75' type='username' id='username' name='username'>
                <input type='submit' class='message-box-submit' value=''>
            </form> 
        </div>";
        if($error == "invalid_request")
            echo '<h5 style="color: red">Uživatel neexistuje nebo již jste přátelé</h5>';
        echo '<div class="mt-2 row">
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
            <img src='assets/img/defaultIcon.jpeg' class='profile-pic' alt=''>
            <h3 class='username ml-2'>{$user->name}</h3>
        </div>
        <form class='friend-request-buttons mr-2' method='post' action='controller/friend_request_response.php'>
            <input type='hidden' name='user_id' value='{$user->user_id}'>
            <input type='submit' name='response' value='accept' class='accept-input'>
            <input type='submit' name='response' value='decline' class='decline-input'>
        </form>
    </div>";
}

function friendListHtml($user) {
    echo "<form action='controller/set_friendshipId.php' method='post'>
    <label for='{$user['username']}' class='chat-buffer d-flex'>
      <img src='assets/img/defaultIcon.jpeg' class='profile-pic' alt=''>
      <h3 class='username'>{$user['username']}</h3>
      <input type='submit' id='{$user['username']}' name='friendName' value='{$user['username']}' style='display: none;'>
    </label>
  </form>";
}

?>