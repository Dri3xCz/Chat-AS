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
        $this->register_repo->query_db($this->user->name, $this->user->password);
        $this->finish();
    }

    public function finish() {
        $_SESSION["user"] = $this->user->name;
        header("location: ../"); 
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