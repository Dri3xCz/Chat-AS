<?php

require_once('../domain/entities.php');
require_once('../repository/UserRepository.php');

class UserCreatedUseCase extends User {
   
    public $user_create_repo; 

    public function __construct($user_create_repo, $name) {
        $this->user_create_repo = $user_create_repo;
        $this->name = $name;
        //$user_create_repo->query_db($this->name);
        $this->finish();
    }

    public function finish() {
       header("location: ../index.php"); 
    }
}

$test = new UserCreateRepository();
$test_usecase = new UserCreatedUseCase($test, "Kok");


?>