<?php
    require_once __DIR__ . '/../domain/entities.php';
    require_once __DIR__ . '/../usecase/user_usecase.php';
    require_once __DIR__ . '/../connection.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new BasicUser($username, $password);
    
    $login_repo = new UserLoginRepository($conn);
    $login_case = new UserLoginUseCase($login_repo, $user);
?>