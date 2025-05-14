<?php

namespace App\Controllers;

use App\Repository\JobRepository;

class PageController extends AbstractController {

    public function __construct(JobRepository $jobRepository){
         parent::__construct($jobRepository);
    } 

    public function showHomePage() {
        $jobs = $this->jobRepository->fetchAllJobList();

        $this->render("home.view", [
            "jobs" => $jobs,
            "displayText" => "Recent Jobs",
        ]);
    }

    public function showJob(int $id) {
        $job = $this->jobRepository->fetchJob($id);
        
        $this->render("showJob.view", [
            "job" => $job,
        ]);
    }

    public function searchJobs(string $keywords, string $location) {
        $keywords = trim($keywords ?? '');
        $location = trim($location ?? '');

        if ($keywords === '' && $location === '') {
            header("Location: index.php");
            exit;
        }
    
        $searchResult = $this->jobRepository->fetchSearchJobs($keywords, $location);

        $displayText = empty($searchResult) ? "No Job Available" : "Search Results for: " . $keywords;

        $this->render("showSearchJob.view", [
            "searchResult" => $searchResult,
            "displayText" => $displayText,
        ]);
    }


    // public function showLoginPage() {
    //     $this->render("login.view", []);
    // }

    //  public function showRegisterPage() {
    //     $this->render("register.view", []);
    // }
} 