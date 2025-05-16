<?php

namespace App\Repository;

use PDO;
use App\Model\JobModel;
use App\Support\Validation;

//this class need the pdo and job model;
class JobRepository {

    public function __construct(private PDO $pdo) {}
  

    public function fetchAllJobList(): ?array {
         $stmt = $this->pdo->prepare("SELECT * FROM listings");
         $stmt->execute();
         $jobs = $stmt->fetchAll(PDO::FETCH_CLASS, JobModel::class);
                
         if (!empty($jobs)) {
             return $jobs;
         }
         else {
            return null;
         }
     }


     public function fetchJob(int $id): ?JobModel {
         $stmt = $this->pdo->prepare("SELECT * FROM listings WHERE id = :id");
         $stmt->bindValue(":id", $id, PDO::PARAM_INT);
         $stmt->execute();
         $stmt->setFetchMode(PDO::FETCH_CLASS, JobModel::class);
         $jobs = $stmt->fetch();
                
         if (!empty($jobs)) {
             return $jobs;
         }
         else {
            return null;
         }
     }


     public function fetchSearchJobs(string $keywords, string $location): ?array {
        $keywords = "%$keywords%";
        $location = "%$location%";

        $stmt = $this->pdo->prepare("SELECT * FROM `listings` WHERE ( `title` LIKE :keywords OR `description` LIKE :keywords OR `tags` LIKE :keywords OR `company` LIKE :keywords ) AND ( `address` LIKE :location OR `city` LIKE :location OR `state` LIKE :location) ");
        $stmt->bindValue(":keywords", $keywords);
        $stmt->bindValue(":location", $location);
        $stmt->execute();
        $searchResult = $stmt->fetchAll(PDO::FETCH_CLASS, JobModel::class);
        
        if (!empty($searchResult)) {
             return $searchResult;
         }
         else {
            return [];
         }
     }

     public function createJob() {
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
            return [
                "error" => $errors,
            ];
        }


        //submit the data
        

        
     } 
}

