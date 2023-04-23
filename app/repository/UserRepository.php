<?php

    class UserRegisterRepository {
        public $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }
        
        public $sql_select_name = "SELECT user.username FROM user";
        public $sql_select_id = "SELECT user.idUser FROM user WHERE user.username = ?";
        public $sql_insert = "INSERT INTO User VALUES (NULL, ? , ?);";
        
        public function queryDb($user) { 
            $prepared_sql = $this->conn->prepare($this->sql_insert);
            $prepared_sql->execute([$user->name, $user->password]);
        }

        public function fetchData() : array {
            $prepared_sql = $this->conn->prepare($this->sql_select_name);
            $prepared_sql->execute();
            $result = $prepared_sql->fetchAll();
            return $result;
        }

        public function fetchId($user) : array {
            $prepared_sql = $this->conn->prepare($this->sql_select_id);
            $prepared_sql->execute([$user->name]);
            $result = $prepared_sql->fetch();
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