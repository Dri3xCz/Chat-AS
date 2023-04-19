<?php
    require_once('../usecase/UserUseCase.php');
    include('../connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userRepo = new UserLoginRepository($conn);
    $userCase = new UserCreatedUseCase($userRepo, $username);
?>