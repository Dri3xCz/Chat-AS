<?php

    class ChatRepository {
        public $conn;
        public function __construct($conn) {
            $this->conn = $conn;
        }

        public $sql_insert_messages = "INSERT INTO Chat VALUES (NULL, ?, ?, ?, ?)";
        public $sql_select_messages = "SELECT Chat.content, Chat.time, User.username FROM Chat
        INNER JOIN Friendship ON Chat.idFriendship LIKE Friendship.idFriendship
        INNER JOIN User ON Chat.idUser LIKE User.idUser
        WHERE Friendship.idUser1 LIKE ? AND Friendship.idUser2 LIKE ?
        ORDER BY time DESC";

        public function fetchMessages($idUser1, $idUser2) : array {
            $prepared_sql = $this->conn->prepare($this->sql_select_messages);
            $prepared_sql->execute([$idUser1, $idUser2]);
            $result = $prepared_sql->fetchAll();
            return $result;
        }

        public function insertMessages($idFriendship, $idUser, $payload, $time) {
            $prepared_sql = $this->conn->prepare($this->sql_insert_messages);
            $prepared_sql->execute([$idFriendship, $idUser, $payload, $time]);
        }
    }

?>