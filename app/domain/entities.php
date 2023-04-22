<?php

abstract class User {
    public $user_id;
    public $name; 
    public $password;
}

class BasicUser extends User {
    public function __construct($name, $password) {
        $this->name = $name;
        $this->password = $password;
    }
}

class RegistrationUser extends User {
    public $password_confirm;
    public function __construct($name, $password, $password_confirm) {
        $this->name = $name;
        $this->password = $password;
        $this->password_confirm = $password_confirm;
    }
}

?>