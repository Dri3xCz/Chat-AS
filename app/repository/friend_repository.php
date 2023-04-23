<?php

class FriendRequestRepository {
    public $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public $sql_select_friend_request = 
    "SELECT * FROM FriendRequests WHERE FriendRequests.idUserRequesting = ? OR FriendRequests.idUserAsked = ?";
    public $sql_select_active_friends = 
    "SELECT * FROM Friendship WHERE Friendship.idUser1 = ? OR Friendship.idUser2 = ?";
    public $sql_insert_friend_request = 
    "INSERT INTO FriendRequests VALUES (NULL, ?, ?)";

    public function insertRequest($user_requesting, $user_asked) {
        $prepared_sql = $this->conn->prepare($this->sql_insert_friend_request);
        $prepared_sql->execute([$user_requesting->user_id, $user_asked->user_id]);
    }

    public function fetchRequests($active_user) : array {
        $prepared_sql = $this->conn->prepare($this->sql_select_friend_request);
        $prepared_sql->execute([$active_user->user_id, $active_user->user_id]);
        $result = $prepared_sql->fetchAll();
        return $result;
    }

    public function fetchFriendships($active_user) : array {
        $prepared_sql = $this->conn->prepare($this->sql_select_active_friends);
        $prepared_sql->execute([$active_user->user_id, $active_user->user_id]);
        $result = $prepared_sql->fetchAll();
        return $result;
    }
}

?>