<?php
 require_once __DIR__ . '/../domain/entities.php';
 require_once __DIR__ . '/../usecase/UserUseCase.php';
 require_once __DIR__ . '/../repository/chat_repository.php';
 require_once __DIR__ . '/../usecase/chat_usecase.php';
 require_once __DIR__ . '/../connection.php';

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
                    echo "<h3>{$message['username']} <span>{$message['time']}</span></h3>";
                echo '</div>';
                echo '<div class="message-content ml-5">';
                    echo "<p class='ml-5'>{$message['content']}</p>";
                echo '</div>';
            echo '</div>';
        }
    } elseif ($_POST['action'] === 'send' && isset($_POST['message']) && !empty($_POST['friend'])) {
        $active_user  = $_SESSION["user"];

        $user2 = $_POST['friend'];

        $message = $_POST['message'];

        $id_repository = new UserFindRepository($conn);
        $id_usecase = new GetUserIdUseCase($id_repository);

        $user2_class = new BasicUser($user2, "x");

        $user2_class = $id_usecase->getId($user2_class);
        $active_user_class = $id_usecase->getId($active_user);

        $chat_repository = new ChatRepository($conn);
        $chat_usecase = new SendMessagesUseCase($chat_repository, $active_user_class, $user2_class, $message);
        $chat_usecase->finish();
    }
}