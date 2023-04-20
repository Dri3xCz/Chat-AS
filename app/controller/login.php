<?php
    require_once('../usecase/UserUseCase.php');
    include('../connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $data_array = array("username"=>$username,"password"=>$password);

    $userRepo = new UserLoginRepository($conn);
    $userCase = new UserLoginUseCase($userRepo, $data_array);
    $userCase->check_credentials();
?>