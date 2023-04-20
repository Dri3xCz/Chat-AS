<?php

require_once('../domain/entities.php');
require_once('../repository/UserRepository.php');

session_start();

class UserCreatedUseCase extends User {
   
    public $user_create_repo; 

    public function __construct($user_create_repo, $name, $password) {
        $this->user_create_repo = $user_create_repo;
        $this->name = $name;
        $this->password = $password;
        $user_create_repo->query_db($this->name, $this->password);
        $this->finish();
    }

    public function finish() {
        $_SESSION["user"] = $this->name;
        header("location: ../"); 
    }
}

class UserLoginUseCase extends User {
    // array(2) {"username" => user, "password" -> pass}
    public $controller_data;
    public $login_repo;
    public function __construct($login_repo, $controller_data) {
        $this->controller_data = $controller_data;
        $this->login_repo = $login_repo;
    }

    public function check_credentials() {
        $user_matched = false;
        $data = $this->login_repo->fetchData();
        for ($i = 0; $i < sizeof($data); $i++) {
            if ($data[$i]["name"] == $this->controller_data["username"]) {
                if($data[$i]["password"] == $this->controller_data["password"]) {
                    $_SESSION["user"] = $this->controller_data["username"];
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