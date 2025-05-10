<?php

try {
    $pdo = new PDO('mysql:host=localhost:3307;dbname=cms;charset=utf8mb4', 'cms', '(c.KQSH8aBsrFbuh', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch (PDOException $e) {
    // var_dump($e->getMessage());
    echo 'A problem occured with the database connection...';
    die();
}

return $pdo;