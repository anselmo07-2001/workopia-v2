<?php

try {
    //already change this code using the database configuration from cloud
    $pdo = new PDO('mysql:host=localhost:3307;dbname=workopia;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch (PDOException $e) {
    // var_dump($e->getMessage());
    echo 'A problem occured with the database connection...';
    die();
}

return $pdo;