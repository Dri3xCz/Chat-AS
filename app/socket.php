<?php

$path = $_SERVER['DOCUMENT_ROOT'];

require_once('./config.php');

$socket = new WebSocket();

class WebSocket {
    private $sock;
    private $null = NULL;

    public function __construct()
    {
        $this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_bind($this->sock, WS_HOST, WS_PORT);
        socket_listen($this->sock);

        echo "Listeting for new connection on port" . WS_PORT;
    }
}