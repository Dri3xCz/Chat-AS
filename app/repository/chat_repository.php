<?php

    class ChatRepository {
        public $conn;
        public function __construct($conn) {
            $this->conn = $conn;
        }

        public $sql_insert_messages = "INSERT INTO Chat VALUES (NULL, ?, ?, ?, ?)";
        public $sql_select_messages = "SELECT * FROM Chat WHERE Chat.idFriendship = ?";

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
    }

?>