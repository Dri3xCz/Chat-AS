<?php
    
require_once("../domain/entities.php");
require_once("../repository/friend_repository.php");
require_once('../usecase/UserUseCase.php');
require_once('../usecase/friend_usecase.php');
include("../connection.php");

session_start();

$active_user  = $_SESSION["user"];

$user_asked = $_POST["username"];

$id_repository = new UserIdRepository($conn);
$id_usecase = new GetUserIdUseCase($id_repository);

$user_asked_class = new BasicUser($user_asked, "x");
$user_asked_class = $id_usecase->getId($user_asked_class);
$active_user_class = $id_usecase->getId($active_user);

$request_repository = new FriendRequestRepository($conn);
$request_usecase = new FriendRequestUseCase($request_repository, $active_user_class, $user_asked_class);

?>