<?php

use App\Support\SessionService;

require "../inc/all.inc.php";

$container = new \App\Support\Container();


//setup db connection
$container->bind("pdo", function() {
    return require __DIR__ . "/../inc/db-connect.inc.php";
});

//setup the job repository
$container->bind("jobRepository", function() use($container) {
    $pdo = $container->get("pdo");
    return new App\Repository\JobRepository($pdo);
});


//setup the user repository
$container->bind("userRepository", function() use($container) {
    $pdo = $container->get("pdo");
    return new App\Repository\UserRepository($pdo);
});


//setup the pageController
$container->bind("pageController", function() use($container) {
     $jobRepository = $container->get("jobRepository");
     return new \App\Controllers\PageController($jobRepository);
});


//setup the authController
$container->bind("authController", function() use($container) {
    $userRepository = $container->get("userRepository");
    return new \App\Controllers\AuthController($userRepository);
});



// Manual Routing: index.php is the entry point for all request
$path = isset($_GET['path']) ? $_GET['path'] : '';
SessionService::startSessionIfNotStarted();


if ($path === "") {
    $pageController = $container->get("pageController");
    $pageController->showHomePage();
}
else if (preg_match('#^jobs/(\d+)$#', $path, $matches)) {
    $jobId = $matches[1];
    $pageController = $container->get("pageController");
    $pageController->showJob($jobId);
}
else if ($path === "search") {
    $keywords = $_GET["keywords"];
    $location = $_GET["location"];

    $pageController = $container->get("pageController"); 
    $pageController->searchJobs($keywords, $location);
}
else if ($path === "auth/register") {
    $authController = $container->get("authController");

    if ($_SERVER["REQUEST_METHOD"] === "GET") {  
        $authController->showRegisterPage();
    }


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $authController->handleRegister();
    }
  
}
else if ($path === "auth/login") {
    // $pageController = $container->get("pageController");
    // $pageController->showLoginPage();
}  
