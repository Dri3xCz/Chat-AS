<?php
 require_once __DIR__ . '/../domain/entities.php';
 require_once __DIR__ . '/../repository/friend_repository.php';
 require_once __DIR__ . '/../usecase/UserUseCase.php';
 require_once __DIR__ . '/../usecase/friend_usecase.php';
 require_once __DIR__ . '/../connection.php';

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