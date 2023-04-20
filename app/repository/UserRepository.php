<?php
    include('../connection.php');

    class UserCreateRepository {
        public $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }

        public $sql = "INSERT INTO User VALUES (? , ?);";
        
        public function query_db($name, $password) { 
            $prepared_sql = $this->conn->prepare($this->sql);
            $prepared_sql->execute([$name, $password]);
        }
    }

    class UserLoginRepository {

        public $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }

        public $sql = "SELECT * FROM User";
        
        public function fetchData() : array { 
            $prepared_sql = $this->conn->prepare($this->sql);
            $prepared_sql->execute();
            $result = $prepared_sql->fetchAll();
            return $result;
        }
    }
?>