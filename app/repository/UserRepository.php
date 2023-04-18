<?php
    class UserCreateRepository {
        public $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }

        public $sql = "INSERT INTO User VALUES (?);";
        
        public function query_db($name) { 
            $prepared_sql = $this->conn->prepare($this->sql);
            $prepared_sql->execute([$name]);
        }
    }

    // Typek se lognul 
    class UserLoginRepository {

        // Funcki, SELECT * from users.name users.pass
    }
?>