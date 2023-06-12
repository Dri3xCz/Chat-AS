<?php
 require_once __DIR__ . '/../domain/entities.php';
 require_once __DIR__ . '/../usecase/user_usecase.php';
 require_once __DIR__ . '/../repository/chat_repository.php';
 require_once __DIR__ . '/../usecase/chat_usecase.php';
 require_once __DIR__ . '/../connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['friendshipId'])) {
    if ($_POST['action'] === 'get') {
        $friendshipId = $_SESSION['friendshipId'];
        $userId = $_SESSION['user']->user_id;

        $chat_repository = new ChatRepository($conn);
        $chat_usecase = new GetMessagesUseCase($chat_repository, $userId, $friendshipId);
        $messages = $chat_usecase->finish();

        foreach ($messages as $message) {
            echo '<div class="chat-message w-75 mt-2">';
                echo '<div class="message-info d-flex align-items-center">';
                    echo '<img src="assets/img/defaultIcon.jpeg" class="profile-pic" alt="">';
                    echo "<h3>{$message['username']} <span>{$message['time']}</span></h3>";
                echo '</div>';
                echo '<div class="message-content ml-5">';
                    echo "<p class='ml-5'>{$message['content']}</p>";
                echo '</div>';
            echo '</div>';
        }
    } elseif ($_POST['action'] === 'send' && isset($_POST['message']) && !empty($_SESSION['friendshipId'])) {
        $friendshipId = $_SESSION['friendshipId'];
        $userId = $_SESSION['user']->user_id;

        $chat_repository = new ChatRepository($conn);
        $chat_usecase = new SendMessagesUseCase($chat_repository, $userId, $friendshipId, $message);
        $chat_usecase->finish();
    }
}