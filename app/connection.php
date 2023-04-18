<?php
    require_once('config.php');

    try {
    $dsn = sprintf("mysql:host=%s;port=%s;dbname=%s", DB_HOST, DB_PORT, DB_NAME);
    $conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch(PDOException $e) {
        echo DB_HOST;
      echo "Connection failed: " . $e;
    }

    function prepareSql($sql) {
        $prepared_sql = $conn->prepare($sql);

    } 
?>