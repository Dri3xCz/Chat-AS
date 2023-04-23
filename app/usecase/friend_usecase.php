<?php
require_once("../domain/entities.php");
require_once("../repository/friend_repository.php");
include("../connection.php");

class FriendRequestUseCase {
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
            echo "Request Successfull";
        } else {
            echo "Request invalid";
        }
    }
}

$active_user = new BasicUser("kubec", "aho");
$user_asked = new BasicUser("ahoj", "aho");
$active_user->user_id = 16;
$user_asked->user_id = 17;

$repo = new FriendRequestRepository($conn);
$use_case = new FriendRequestUseCase($repo, $active_user, $user_asked);


?>