<?php
    include('../connection.php');

    class UserRegisterRepository {
        public $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }
        
        public $sql_select = "SELECT user.name FROM user";
        public $sql_insert = "INSERT INTO User VALUES (? , ?);";
        
        public function queryDb($user) { 
            $prepared_sql = $this->conn->prepare($this->sql_insert);
            $prepared_sql->execute([$user->name, $user->password]);
        }

        public function fetchData() : array {
            $prepared_sql =  $this->conn->prepare($this->sql_select);
            $prepared_sql->execute();
            $result = $prepared_sql->fetchAll();
            return $result;
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