<?php

    $path = $_SERVER['DOCUMENT_ROOT'];

    require_once($path . '/config.php');

    $dsn = sprintf("mysql:host=%s;port=%s;dbname=%s", DB_HOST, DB_PORT, DB_NAME);
    $conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
?>