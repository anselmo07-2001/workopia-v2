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
else if ($path === "create") {
    $pageController = $container->get("pageController");

    if (SessionService::getSessionKey("user")) {

        if ($_SERVER["REQUEST_METHOD"] === "GET") {  
            $pageController->showCreateJobForm();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {  
             $pageController->handleJobCreation();
        }
    }
    else {
         $pageController->showLoginPage();
    }
} 
else if (preg_match('#^edit/(\d+)$#', $path, $matches)) {
    $pageController = $container->get("pageController");
    $jobId = $matches[1];

    if ( $_SERVER["REQUEST_METHOD"] === "GET") {  
         $pageController->showEditJobForm($jobId);
    }

    if ( $_SERVER["REQUEST_METHOD"] === "POST") {  
         $pageController->handleJobModification($jobId);
    }
}
else if (preg_match('#^delete/(\d+)$#', $path, $matches)) {
    $jobId = $matches[1];
    $pageController = $container->get("pageController");
    $pageController->handleJobDeletion($jobId);
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
    $pageController = $container->get("pageController");

    if ($_SERVER["REQUEST_METHOD"] === "GET") {  
        $pageController->showRegisterPage();
    }


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $authController->handleRegister();
    }
  
}
else if ($path === "auth/login") {
    $authController = $container->get("authController"); 
    $pageController = $container->get("pageController");


    if ($_SERVER["REQUEST_METHOD"] === "GET") {  
        $pageController->showLoginPage();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $authController->handleLogin();
    }

}
else if ($path === "auth/logout") {  
    $authController = $container->get("authController");
    $authController->logout();
}
