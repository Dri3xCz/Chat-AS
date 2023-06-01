<?php
$path = $_SERVER['DOCUMENT_ROOT']; 
require_once($path . '/domain/entities.php');
require_once($path . '/repository/friend_repository.php');
require_once($path . '/usecase/UserUseCase.php');
require_once($path . '/usecase/friend_usecase.php');
require_once($path . '/connection.php');

session_start();

$active_user  = $_SESSION["user"];

$user_asked = $_POST["username"];

$id_repository = new UserFindRepository($conn);
$id_usecase = new GetUserIdUseCase($id_repository);

$user_asked_class = new BasicUser($user_asked, "x");

$valid = $id_usecase->validateInput($user_asked_class->name);

if($valid) {
    $user_asked_class = $id_usecase->getId($user_asked_class);
    $active_user_class = $id_usecase->getId($active_user);

    $request_repository = new FriendRequestRepository($conn);
    $request_usecase = new FriendSendRequestUseCase($request_repository, $active_user_class, $user_asked_class);
}
else {
    header("location: ../?status=adding_friends&error=invalid_request");
}



?>