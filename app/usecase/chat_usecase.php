<?php

$path = $_SERVER['DOCUMENT_ROOT'];

require_once($path . "/domain/entities.php");
include($path . "/connection.php");

session_start();

class GetMessagesUseCase {
    public $repo;
    public $user1;
    public $user2;
    public $idFriendship;
    public function __construct($repo, $user1, $user2) {
        $this->repo = $repo;
        $this->user1 = $user1;
        $this->user2 = $user2;

        $this->idFriendship = $this->getIdFriendship();
    }

    public function getIdFriendship() : int {
        $id = $this->repo->fetchIdFriendship($this->user1->user_id, $this->user2->user_id);
        return $id['idFriendship'];
    }

    public function finish() : array {
        return $this->repo->fetchMessages($this->idFriendship);
    }
}

class SendMessagesUseCase {
    public $repo;
    public $idFriendship;
    public $user1;
    public $user2;
    public $payload;
    public $time;
    public function __construct($repo, $user1, $user2, $payload) {
        $this->repo = $repo;
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->payload = $payload;

        $this->idFriendship = $this->getIdFriendship();
    }

    public function getIdFriendship() : int {
        $id = $this->repo->fetchIdFriendship($this->user1->user_id, $this->user2->user_id);
        return $id['idFriendship'];
    }

    public function finish() {
        $this->time = date("Y-m-d H:i:s");
        $this->repo->insertMessages($this->idFriendship, $this->user1->user_id, $this->payload, $this->time);
    }
}