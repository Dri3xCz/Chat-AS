<?php

require_once('../domain/entities.php');
require_once('../repository/friend_repository.php');
require_once('../usecase/UserUseCase.php');
require_once('../usecase/friend_usecase.php');
require_once('../connection.php');

session_start();

$active_user  = $_SESSION["user"];

$user_asked = $_POST['user_id'];
$choice = $_POST['response'];

$id_repository = new UserFindRepository($conn);
$id_usecase = new GetUserIdUseCase($id_repository);

$active_user_class = $id_usecase->getId($active_user);
$user_asked_class = $id_usecase->getUserById($user_asked);

$friendsip_repository = new FriendRequestRepository($conn);
$friendsip_usecase = new HandleFriendRequest($friendsip_repository, $active_user_class, $user_asked_class, $choice);

header("location: ../?status=adding_friends");