<?php

    class ChatRepository {
        public $conn;
        public function __construct($conn) {
            $this->conn = $conn;
        }

        public $sql_insert_messages = "INSERT INTO Chat VALUES (NULL, ?, ?, ?, ?)";
        public $sql_select_messages = "SELECT Chat.content, Chat.time, User.username FROM Chat
        INNER JOIN User ON Chat.idUser LIKE User.idUser WHERE Chat.idFriendship LIKE ? ORDER BY time";
        public $sql_select_idFriendship = "SELECT idFriendship FROM Friendship
        WHERE (idUser1 LIKE ? OR idUser1 LIKE ?) AND (idUser2 LIKE ? OR idUser2 LIKE ?)";

        public function fetchMessages($idFriendship) : array {
            $prepared_sql = $this->conn->prepare($this->sql_select_messages);
            $prepared_sql->execute([$idFriendship]);
            $result = $prepared_sql->fetchAll();
            return $result;
        }

        public function insertMessages($idFriendship, $idUser, $payload, $time) {
            $prepared_sql = $this->conn->prepare($this->sql_insert_messages);
            $prepared_sql->execute([$idFriendship, $idUser, $payload, $time]);
        }

        public function fetchIdFriendship($idUser1, $idUser2) : array {
            $prepared_sql = $this->conn->prepare($this->sql_select_idFriendship);
            $prepared_sql->execute([$idUser1, $idUser2, $idUser1, $idUser2]);
            $result = $prepared_sql->fetch();
            return $result;
        }
    }

?>