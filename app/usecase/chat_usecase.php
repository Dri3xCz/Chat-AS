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
    public function __construct($repo) {
        $this->repo = $repo;
    }
}