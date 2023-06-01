<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once($path . '/domain/entities.php');
    require_once($path .'/usecase/UserUseCase.php');
    require_once($path .'/connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password-confirm'];

    $user = new RegistrationUser($username, $password, $password_confirm);

    $register_repo = new UserRegisterRepository($conn);
    $register_case = new UserRegisterUseCase($register_repo, $user);
?>