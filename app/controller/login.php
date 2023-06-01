<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once($path . '/domain/entities.php');
    require_once($path . '/usecase/UserUseCase.php');
    require_once($path . '/connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new BasicUser($username, $password);
    
    $login_repo = new UserLoginRepository($conn);
    $login_case = new UserLoginUseCase($login_repo, $user);
?>