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

        $this->render("showSearchJob.view", [
            "searchResult" => $searchResult,
        ]);
    }
} 