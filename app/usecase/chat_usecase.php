<?php

$path = $_SERVER['DOCUMENT_ROOT'];

require_once($path . "/domain/entities.php");
include($path . "/connection.php");

session_start();

class GetMessagesUseCase {
    public $repo;
    public $user1;
    public $user2;
    public function __construct($repo, $user1, $user2) {
        $this->repo = $repo;
        $this->user1 = $user1;
        $this->user2 = $user2;
    }

    public function finish() : array {
        return $this->repo->fetchMessages($this->user1->user_id, $this->user2->user_id);
    }
}

class SendMessagesUseCase {
    public $repo;
    public $idFriendship;
    public $user;
    public $payload;
    public $time;
    public function __construct($repo, $idFriendship, $user, $payload) {
        $this->repo = $repo;
        $this->idFriendship = $idFriendship;
        $this->user = $user;
        $this->payload = $payload;
    }

    public function finish() {
        $this->time = date("Y-m-m H:i:s");
        $this->repo->insertMessages($this->idFriendship, $this->user->user_id, $this->payload, $this->time);
    }
}