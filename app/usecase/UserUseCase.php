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
        $validate = $this->validate();
        $this->finish($validate);
    }

    public function validate() : bool {
        $registered_usernames = $this->register_repo->fetchData();
        for ($i = 0; $i < sizeof($registered_usernames); $i++) {
            if ($this->user->name == $registered_usernames[$i]["name"]) {
                return false;
            }
        }
        return true;
    }

    public function finish($validate) {
        if($validate) {
            $this->register_repo->queryDb($this->user);
            $_SESSION["user"] = $this->user->name;
            header("location: ../");  
        } else {
            header("location: ../web/register/?error=username_taken");
        }
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
        $user_matched = false;
        $data = $this->login_repo->fetchData();

        for ($i = 0; $i < sizeof($data); $i++) {
            if ($data[$i]["name"] == $this->user->name) {
                if($data[$i]["password"] == $this->user->password ) {
                    $_SESSION["user"] = $this->user->name;
                    $user_matched = true;       
                }
            }
        } 
        
        if($user_matched) { 
            header("location: ../");
        } else {
            header("location: ../web/login/?error=invalid_credentials"); 
        } 
    }     
}

?>