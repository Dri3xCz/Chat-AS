<?php
    require_once("../domain/entities.php");
    require_once("../repository/friend_repository.php");
    include("../connection.php");

    $active_user = new BasicUser("Lukas", "heslo");
    $active_user->user_id = 8;

    $requested_user = new BasicUser("Hak", "heslo");
    $requested_user->user_id = 9;

    $repo = new FriendRequestRepository($conn); 
    $repo->insertRequest($active_user, $requested_user);
?>