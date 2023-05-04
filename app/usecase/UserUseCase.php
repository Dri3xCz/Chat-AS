<?php

require_once('../domain/entities.php');
require_once('../repository/UserRepository.php');

session_start();

class UserRegisterUseCase {
   
    public $register_repo; 
    public $user;

    public function __construct($register_repo, $user) {
        $this->register_repo = $register_repo;
        $this->user = $user;
        $this->validateInput();
    }

    public function validateInput() {
        if($this->user->name == "" || $this->user->password == "") {
            header("location: ../web/register/?error=invalid_input");
        } else
        
        if($this->user->password != $this->user->password_confirm) {
            header("location: ../web/register/?error=different_passwords");
        } else {
            $validate = $this->register_repo->validateData($this->user->name);
            $this->finish($validate);
        }
    }

    public function finish($validate) {
        if($validate) {
            $this->register_repo->queryDb($this->user);
            $this->setUserSession();
            header("location: ../");  
        } else {
            header("location: ../web/register/?error=username_taken");
        }
    }

    public function setUserSession() {
        $id = $this->register_repo->fetchId($this->user);
        $this->user->user_id = $id["idUser"];
        $_SESSION["user"] = $this->user;
    }
}

class UserLoginUseCase {
    public $user;
    public $login_repo;

    public function __construct($login_repo, $user) {
        $this->login_repo = $login_repo;
        $this->user = $user;
    }

    public function check_credentials() {
        
        if($this->login_repo->userMatch($this->user)) { 
            $_SESSION["user"] = $this->user;
            header("location: ../");
        } else {
            header("location: ../web/login/?error=invalid_credentials"); 
        } 
    }     
}

?>