<?php

namespace App\Controllers;

use App\Repository\JobRepository;

class PageController extends AbstractController {

    //create a constructor that will accept the Job Repository
    public function __construct(JobRepository $jobRepository){
         parent::__construct($jobRepository);
    } 


    public function showHomePage() {
        //create a repo function from the abtract function of pageController that will get the first 6 of the job list
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
} 