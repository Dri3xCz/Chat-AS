
<?php
require_once __DIR__ . '/domain/entities.php';
require_once __DIR__ . '/controller/index_controller.php';
require_once __DIR__ . '/connection.php';

session_start();
if(!isset($_SESSION["user"])){
    header("location: web/login");
}
?>

<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - AS</title>
    <!-- BOOTSTRAP 4.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="main.js"></script>
</head>
<body>

<main class="container-fluid">
    <div class="row h-100">
        <a href="javascript:void(0);" style="display: none" id="toggle-button" class="icon d-lg-none" onclick="toggleFriendList()">
            <i class="fa fa-bars" style="font-size: 2rem"></i>
        </a>
        <div class="col-8 col-lg-2 chat-buffer-list" id="friend-list">
            <div class="mt-2">
                <a href="javascript:void(0);" class="icon d-lg-none" onclick="toggleFriendList()">
                    <i class="fa fa-bars" style="font-size: 2rem"></i>
                </a>
                <div class="w-100 h-70 h-lg-85">
                    <a href="./" class="chat-buffer d-flex">
                        <img src="assets/img/defaultIcon.jpeg" class="profile-pic" alt="">
                        <h3 class="username">Můj profil</h3>
                    </a>
                    <?php
                    friendListArea($conn);
                    ?>
                </div>
                <a href="?status=adding_friends" class="chat-buffer d-flex">
                    <h3 class="username">Přidat kamaráda</h3>
                </a>
                <a href="./controller/logout.php" class="chat-buffer d-flex">
                    <h3 class="username">Odhlásit se</h3>
                </a>
            </div>
        </div>
        <div class="col-4 col-lg-10 chat-main" id="chat-main">
            <?php
            chatArea($conn);
            ?>
        </div>
    </div>
</main>
</body>
</html>