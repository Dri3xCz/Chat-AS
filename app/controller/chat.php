<?php
$path = $_SERVER['DOCUMENT_ROOT'];

require_once($path . "/domain/entities.php");
require_once($path . '/usecase/UserUseCase.php');
require_once($path . '/repository/chat_repository.php');
require_once($path . '/usecase/chat_usecase.php');
include($path . "/connection.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['friend'])) {
    if ($_POST['action'] === 'get') {
        $active_user  = $_SESSION["user"];

        $user2 = $_POST['friend'];

        $id_repository = new UserFindRepository($conn);
        $id_usecase = new GetUserIdUseCase($id_repository);

        $user2_class = new BasicUser($user2, "x");

        $user2_class = $id_usecase->getId($user2_class);
        $active_user_class = $id_usecase->getId($active_user);

        $chat_repository = new ChatRepository($conn);
        $chat_usecase = new GetMessagesUseCase($chat_repository, $active_user_class, $user2_class);
        $messages = $chat_usecase->finish();

        foreach ($messages as $message) {
            echo '<div class="chat-message w-75 mt-2">';
                echo '<div class="message-info d-flex align-items-center">';
                    echo '<img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">';
                    echo "<h3>";
                    if($message['idUser'] == $active_user_class->user_id)
                        echo $active_user_class->name;
                    else
                        echo $user2_class->name;
                    echo " <span>{$message['time']}</span></h3>";
                echo '</div>';
                echo '<div class="message-content ml-5">';
                    echo "<p class='ml-5'>{$message['content']}</p>";
                echo '</div>';
            echo '</div>';
        }
    } elseif ($_POST['action'] === 'send' && isset($_POST['message'])) {
        $message = $_POST['message'];

        //uložení do databáze
    }
}