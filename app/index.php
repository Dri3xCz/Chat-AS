<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location: web/login");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - AS</title>
    <!-- BOOTSTRAP 4.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <main class="container-fluid">
        <div class="row h-100">
            <div class="col-lg-2 col-4 chat-buffer-list">                
                <a href="?user=placeholder" class="chat-buffer d-flex">
                    <img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">
                    <h3 class="username">placeholder</h3>
                </a>
                <div class="chat-buffer d-flex">
                    <img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">
                    <h3 class="username">placeholder</h3>
                </div>
                <div class="chat-buffer d-flex">
                    <img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">
                    <h3 class="username">placeholder</h3>
                </div>

            </div>
            <div class="col-8 chat-main">

                <div class="chat-space w-100">
                    <div class="chat-message w-75 mt-2">
                        <div class="message-info d-flex align-items-center">
                            <img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">
                            <h3>Placeholder <span>Datum</span></h3>
                        </div>
                        <div class="message-content ml-5">
                            <p class="ml-5">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Ut tempus purus at lorem. Integer malesuada. Vivamus porttitor turpis ac leo. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Etiam dictum tincidunt diam. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit q</p>
                        </div>
                    </div>
                    <div class="chat-message w-75 mt-2">
                        <div class="message-info d-flex align-items-center">
                            <img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">
                            <h3>Placeholder <span>Datum</span></h3>
                        </div>
                        <div class="message-content ml-5">
                            <p class="ml-5">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Ut tempus purus at lorem. Integer malesuada. Vivamus porttitor turpis ac leo. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Etiam dictum tincidunt diam. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit q</p>
                        </div>
                    </div>
                    <div class="chat-message w-75 ml-2">
                        <div class="message-info d-flex align-items-center">
                            <img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">
                            <h3>Placeholder <span>Datum</span></h3>
                        </div>
                        <div class="message-content ml-5">
                            <p class="ml-5">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Ut tempus purus at lorem. Integer malesuada. Vivamus porttitor turpis ac leo. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Etiam dictum tincidunt diam. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit q</p>
                        </div>
                    </div>

                </div>     
                
                <form class="message-box w-100 d-flex ml-5" action="/submit/?user=<?php echo urlencode($_GET['user']); ?>" method="post">
                    <input class="w-75 ml-5" type="text" id="text" name="text">                
                    <input type="submit" class="message-box-submit" value="">
                </form>      
            </div>
            <div class="col-sm-2 d-none d-lg-block profile-info"></div>
        </div>
    </main>    
</body>
</html>

