<?php

require "../inc/all.inc.php";

$container = new \App\Support\Container();
$pageController = new \App\Controllers\PageController();

//setup db connection
$container->bind("pdo", function() {
    return require __DIR__ . "/../inc/db-connect.inc.php";
});


$pageController->showHomePage();





