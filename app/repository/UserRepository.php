<?php

    class UserRegisterRepository {
        public $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }
        
        public $sql_select_name = "SELECT user.username FROM user;";
        public $sql_select_id = "SELECT user.idUser FROM user WHERE user.username = ?;";
        public $sql_insert = "INSERT INTO User VALUES (NULL, ? , ?);";
        
        public function queryDb($user) { 
            $prepared_sql = $this->conn->prepare($this->sql_insert);
            $prepared_sql->execute([$user->name, md5($user->password)]);
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
            $result = $prepared_sql->fetchAll();
            return $result;
        }

        public function validateData($username) : bool {
            $sql = "SELECT username FROM User WHERE username LIKE ?;";

            $prepared_sql = $this->conn->prepare($sql);
            $prepared_sql->execute([$username]);
            $result = $prepared_sql->fetchAll();
            return sizeof($result) == 0;
        }
    }

    class UserLoginRepository {
        public $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }

        public function fetchData() : array { 
            $sql = "SELECT * FROM User;";

            $prepared_sql = $this->conn->prepare($sql);
            $prepared_sql->execute();
            $result = $prepared_sql->fetchAll();
            return $result;
        }

        public function userMatch($user) : bool {
            $sql = "SELECT * FROM User WHERE username LIKE ? AND password LIKE ?";

            $prepared_sql = $this->conn->prepare($sql);
            $prepared_sql->execute([$user->name, md5($user->password)]);
            $result = $prepared_sql->fetchAll();
            return sizeof($result) != 0;
        }
    }

    class UserFindRepository {
        public $conn;
        public function __construct($conn) {
            $this->conn = $conn;
        }
        
        public $sql_select_id = "SELECT User.idUser FROM User WHERE User.username = ?";
        public $sql_select_user_by_id = "SELECT * FROM User WHERE User.idUser = ?";
        public $sql_select_friendships = "SELECT User.username FROM Friendship
        INNER JOIN User ON IF(Friendship.idUser1 = ?, User.idUser = Friendship.idUser2, User.idUser = Friendship.idUser1)
        WHERE Friendship.idUser1 = ? OR Friendship.idUser2 = ?";

        public function fetchId($user) : array {
            $prepared_sql = $this->conn->prepare($this->sql_select_id);
            $prepared_sql->execute([$user->name]);
            $result = $prepared_sql->fetch();
            return $result;
        }

        public function fetchUserById($id) : array {
            $prepared_sql = $this->conn->prepare($this->sql_select_user_by_id);
            $prepared_sql->execute([$id]);
            $result = $prepared_sql->fetch();
            return $result;
        }

        public function fetchFriendships($user) : array {
            $prepared_sql = $this->conn->prepare($this->sql_select_friendships);
            $prepared_sql->execute([$user->user_id, $user->user_id, $user->user_id]);
            $result = $prepared_sql->fetchall();
            return $result;
        }
    }
?>