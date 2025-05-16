<?php

namespace App\Controllers;

use App\Repository\JobRepository;
use App\Support\Validation;

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

    public function showCreateJobForm() {
         $this->render("createJobForm.view", []);
    }

    public function handleJobCreation() {
        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];
        $allowedFields = array_flip($allowedFields);
        $filteredFields  = array_intersect_key($_POST, $allowedFields); //only selected fields will be submit

        //get the userId and insert it into the $sanitizeFields
        
        $sanitizeFields = array_map("sanitize", $filteredFields);

        $requiredFields = ['title', 'description', 'salary', 'email', 'city', 'state'];
        
        $errors = [];

        foreach($requiredFields as $fields) {
            if (empty($sanitizeFields[$fields]) || !Validation::string($filteredFields[$fields])) {
                $errors[$fields] = ucfirst($fields) . " is required";
            }
        }

        if (!empty($errors)) {
            $this->render("createJobForm.view", [
                "errors" => $errors,
            ]);
            exit;
        }

        $this->jobRepository->createJob($sanitizeFields);

    }


    // public function showLoginPage() {
    //     $this->render("login.view", []);
    // }

    //  public function showRegisterPage() {
    //     $this->render("register.view", []);
    // }
} 