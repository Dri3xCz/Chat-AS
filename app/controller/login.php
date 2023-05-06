<?php
    require_once('../domain/entities.php');
    require_once('../usecase/UserUseCase.php');
    include('../connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new BasicUser($username, $password);
    
    $login_repo = new UserLoginRepository($conn);
    $login_case = new UserLoginUseCase($login_repo, $user);
?>