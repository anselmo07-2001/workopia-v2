<?php

require "../inc/all.inc.php";

$container = new \App\Support\Container();
// $pageController = new \App\Controllers\PageController();

//setup db connection
$container->bind("pdo", function() {
    return require __DIR__ . "/../inc/db-connect.inc.php";
});

//setup the job repository
$container->bind("jobRepository", function() use($container) {
    $pdo = $container->get("pdo");
    return new App\Repository\JobRepository($pdo);
});

//setup the pageController
$container->bind("pageController", function() use($container) {
     $jobRepository = $container->get("jobRepository");
     return new \App\Controllers\PageController($jobRepository);
});


// Manual Routing: index.php is the entry point for all request
$requestUri = $_SERVER["REQUEST_URI"];

// Remove the base path from the requestUri
$basePath = "/Projects/Workopia/public";
$path = str_replace($basePath, '', $requestUri);
$path = trim($path, '/');

if ($path === "") {
    $pageController = $container->get("pageController");
    $pageController->showHomePage();
}

