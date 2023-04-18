<?php
    require_once('../usercase/UserUseCase.php');
    include('../connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userRepo = new UserCreateRepository($conn);
    $userCase = new UserCreatedUseCase($userRepo, $username);
?>