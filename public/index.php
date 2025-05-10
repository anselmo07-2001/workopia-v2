<?php

require "../inc/all.inc.php";

$container = new \App\Support\Container();

//setup db connection
$container->bind("pdo", function() {
    return require __DIR__ . "/../inc/db-connect.inc.php";
});

