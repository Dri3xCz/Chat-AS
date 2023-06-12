<?php
require_once __DIR__ . '/../domain/entities.php';
require_once __DIR__ . '/../connection.php';

session_start();

class GetMessagesUseCase {
    public $repo;
    public $idUser;
    public $idFriendship;
    public function __construct($repo, $idUser, $idFriendship) {
        $this->repo = $repo;
        $this->idUser = $idUser;
        $this->idFriendship = $idFriendship;
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

    public function finish() {
        $this->time = date("Y-m-d H:i:s");
        $this->repo->insertMessages($this->idFriendship, $this->user1->user_id, $this->payload, $this->time);
    }
}

class GetIdFriendship {
    public $user1;
    public $user2;
    public $repo;

    public function __construct($repo, $user1, $user2) {
        $this->repo = $repo;
        $this->user1 = $user1;
        $this->user2 = $user2;

        $this->getIdFriendship();
    }

    public function getIdFriendship() {
        $id = $this->repo->fetchIdFriendship($this->user1->user_id, $this->user2->user_id);
        $_SESSION['friendshipId'] = $id['idFriendship'];
    }
}