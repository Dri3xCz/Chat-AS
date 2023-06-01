<?php

require('domain/entities.php');
require('controller/index_controller.php');
include('connection.php');

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    
    <main class="container-fluid">
        <div class="row h-100">
            <div class="col-lg-2 col-4 chat-buffer-list">                
                <div class="w-100 h-90">
                    <a href="/" class="chat-buffer d-flex">
                        <img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">
                        <h3 class="username">Můj profil</h3>
                    </a>
                    <?php
                        friendListArea($conn);
                    ?> 
                </div>
                <a href="?status=adding_friends" class="chat-buffer d-flex">
                    <h3 class="username">Přidat kamaráda</h3>
                </a>
            </div>
            <div class="col-8 chat-main">
                <?php
                    chatArea($conn);
                ?>
            </div>
            <div class="col-sm-2 d-none d-lg-block profile-info"></div>
        </div>
    </main>    
</body>
</html>

