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

     public function createJob(array $formData) {   
        $stmt = $this->pdo->prepare("INSERT INTO `listings` (user_id ,title, description, salary, requirements, benefits, tags, company, address, city, state, phone, email) VALUES (:user_id, :title, :description, :salary, :requirements, :benefits, :tags, :company, :address, :city, :state, :phone, :email)");

        $stmt->bindValue(":user_id", $formData["user_id"]);
        $stmt->bindValue(":title", $formData["title"]);
        $stmt->bindValue(":description", $formData["description"]);
        $stmt->bindValue(":salary", $formData["salary"]);
        $stmt->bindValue(":requirements", $formData["requirements"]);
        $stmt->bindValue(":benefits", $formData["benefits"]);
        $stmt->bindValue(":tags", $formData["tags"]); 
        $stmt->bindValue(":company", $formData["company"]); 
        $stmt->bindValue(":address", $formData["address"]); 
        $stmt->bindValue(":city", $formData["city"]); 
        $stmt->bindValue(":state", $formData["state"]); 
        $stmt->bindValue(":phone", $formData["phone"]); 
        $stmt->bindValue(":email", $formData["email"]); 

        return $stmt->execute();      
     } 
}

