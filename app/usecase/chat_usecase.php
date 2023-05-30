<?php

$path = $_SERVER['DOCUMENT_ROOT'];

require_once($path . "/domain/entities.php");
include($path . "/connection.php");

session_start();

class GetMessagesUseCase {
    public $repo;
    public $idFriendship;
    public function __construct($repo, $idFriendship) {
        $this->repo = $repo;
        $this->idFriendship = $idFriendship;
        $this->finish();
    }

    public function finish() {
        $this->repo->fetchMessages($this->idFriendship);
    }
}

class SendMessagesUseCase {
    public $repo;
    public function __construct($repo) {
        $this->repo = $repo;
    }
}