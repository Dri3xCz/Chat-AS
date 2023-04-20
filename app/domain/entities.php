<?php

abstract class User {
    public $name; 
    public $password;
}

class BasicUser extends User {
    public function __construct($name, $password) {
        $this->name = $name;
        $this->password = $password;
    }
}

?>