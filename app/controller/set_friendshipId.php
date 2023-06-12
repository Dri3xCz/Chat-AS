<?php
require_once __DIR__ . '/../domain/entities.php';
require_once __DIR__ . '/../usecase/user_usecase.php';
require_once __DIR__ . '/../repository/chat_repository.php';
require_once __DIR__ . '/../usecase/chat_usecase.php';
require_once __DIR__ . '/../connection.php';

$friend = $_GET['friendName'];

$id_repository = new UserFindRepository($conn);
$id_usecase = new GetUserIdUseCase($id_repository);

$friend_class = new BasicUser($friend, "x");

$friend_class = $id_usecase->getId($friend_class);
$active_user_class = $_SESSION['user'];

$chat_repository = new ChatRepository($conn);
$chat_usecase = new GetIdFriendship($chat_repository, $active_user_class, $friend_class);

header("location: ../index.php");