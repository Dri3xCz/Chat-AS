<?php

$path = $_SERVER['DOCUMENT_ROOT'];

require_once($path . "/domain/entities.php");
include($path . "/connection.php");

class FriendSendRequestUseCase {
    public $friend_repo;
    public $active_user;
    public $user_asked;
    public function __construct($friend_repo, $active_user, $user_asked) {
        $this->friend_repo = $friend_repo; 
        $this->active_user = $active_user;
        $this->user_asked = $user_asked;

        $valid = $this->validate();
        $this->finish($valid); 
    } 

    public function validate() : bool {
        return $this->validateFriendships() && $this->validateRequests();
    }

    public function validateRequests() : bool {
        $requests = $this->friend_repo->fetchRequests($this->active_user);
        for ($i = 0; $i < sizeof($requests); $i++) {
            if($requests[$i]["idUserRequesting"] == $this->user_asked->user_id 
            || $requests[$i]["idUserAsked"] == $this->user_asked->user_id) {
                return false;
            }
        }
        return true;
    }

    public function validateFriendships() : bool {
        $friendships = $this->friend_repo->fetchFriendships($this->active_user);
        for ($i = 0; $i < sizeof($friendships); $i++) {
            if($friendships[$i]["idUser1"] == $this->user_asked->user_id 
            || $friendships[$i]["idUser2"] == $this->user_asked->user_id) {
                return false;
            }
        }
        return true;
    }

    public function finish($valid) {
        if($valid) {
            $this->friend_repo->insertRequest($this->active_user, $this->user_asked);
            header("location: ../?status=adding_friends");
        } else {
           header("location: ../?status=adding_friends&error=invalid_request");
        }
    }
}

class FetchFriendRequests {
    private $friend_repo;
    private $active_user;
    private $id_repo;
    public function __construct($friend_repo, $id_repo, $active_user) {
        $this->friend_repo = $friend_repo;
        $this->active_user = $active_user;
        $this->id_repo = $id_repo;
    }

    public function GetRequests() : array {
        $result_array = array();
        $data = $this->friend_repo->fetchUserRequests($this->active_user);
        for ($i = 0; $i < sizeof($data); $i++) {
           $user = $this->GetUser($data[$i]); 
           $result_array[$i] = $user;
        }

        return $result_array;
    }

    private function GetUser($data) : BasicUserWithId {
        $id_usecase = new GetUserIdUseCase($this->id_repo);
        $user = $id_usecase->getUserById($data["idUserRequesting"]);
        return $user; 
    }
}

class HandleFriendRequest {
    private $friend_repo;
    private $active_user;
    private $user_asked;
    private $response;

    public function __construct($friend_repo, $active_user, $user_asked, $response) {
        $this->friend_repo = $friend_repo; 
        $this->active_user = $active_user;
        $this->user_asked = $user_asked;
        $this->response = $response;

        $this->finish();
    }

    public function finish() {
        if($this->response == 'accept')
            $this->addFriendship();
        else
            $this->deleteRequest();
    }

    public function deleteRequest() {
        $this->friend_repo->deleteRequest($this->active_user, $this->user_asked);
    }

    public function addFriendship() {
        $this->friend_repo->insertFriendship($this->active_user, $this->user_asked);
        $this->friend_repo->deleteRequest($this->active_user, $this->user_asked);
    }
}

?>