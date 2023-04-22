<?php

class FriendRequestRepository {
    public $conn;
    public $active_user;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public $sql_select_friend_request = "SELECT * FROM FriendRequests WHERE FriendRequests.idUserRequesting = ? OR FriendRequests.idUserAsked = ?";
    public $sql_select_active_friends = "";
    public $sql_insert_friend_request = "INSERT INTO FruebdRequests VALUES (NULL, ?, ?)";

    public function insertRequest($user_requesting, $user_asked) {
        $prepared_sql = $this->conn->prepare($this->sql_insert_friend_request);
        $prepared_sql->execute([$user_requesting->user_id, $user_asked->user_id]);
    }
}

?>