<?php
    require_once('../domain/entities.php');
    require_once('../usecase/UserUseCase.php');
    include('../connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new BasicUser($username, $password);

    $register_repo = new UserRegisterRepository($conn);
    $register_case = new UserRegisterUseCase($register_repo, $user);
?>