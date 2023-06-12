<?php
    require_once __DIR__ . '/config.php';

    $dsn = sprintf("mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4", DB_HOST, DB_PORT, DB_NAME);
    $conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
?>