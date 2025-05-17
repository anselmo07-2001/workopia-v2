<?php

namespace App\Controllers;

use App\Repository\JobRepository;
use App\Support\SessionService;
use App\Support\Validation;

class PageController extends AbstractController {

    public function __construct(JobRepository $jobRepository){
         parent::__construct($jobRepository);
    } 

    public function showRegisterPage() {
        $this->render("register.view", []);
    }

    public function showLoginPage() {
        $this->render("login.view", []);
    }

    public function showEditJobForm($jobId) {
        $job = $this->jobRepository->fetchJob($jobId);
        
        $this->render("editJobForm.view", [
              "job" => $job,
        ]);
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

        $sanitizeFields = array_map("sanitize", $filteredFields);
        $sanitizeFields["user_id"] = SessionService::getSessionKey("user")["userId"];

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
   
        $success = $this->jobRepository->createJob($sanitizeFields);  

        if ($success) {
            SessionService::setAlertMessage("success_message", "Job post created succesfully");
        }
        else {
            SessionService::setAlertMessage("error_message", "Job post failed to created");
        }

        header("Location: index.php");
    }


    public function handleJobDeletion($jobId) {
        $this->jobRepository->deleteJob($jobId);
        SessionService::setAlertMessage("success_message", "Job deleted successfully");
        header("Location: index.php");
    }


    public function handleJobModification($jobId) {
        $job = $this->jobRepository->fetchJob($jobId);
        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];
        $allowedFields = array_flip($allowedFields);
        $filteredFields  = array_intersect_key($_POST, $allowedFields); //only selected fields will be submit

        $sanitizeFields = array_map("sanitize", $filteredFields);
    
        $requiredFields = ['title', 'description', 'salary', 'email', 'city', 'state'];
        
        $errors = [];

        foreach($requiredFields as $fields) {
            if (empty($sanitizeFields[$fields]) || !Validation::string($filteredFields[$fields])) {
                $errors[$fields] = ucfirst($fields) . " is required";
            }
        }

        if (!empty($errors)) {
            $this->render("editJobForm.view", [
                "errors" => $errors,
                "job" => $job
            ]);
        }
    }
   
} 