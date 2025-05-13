<?php

namespace App\Repository;

use PDO;
use App\Model\JobModel;

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
            return null;
         }
     }
}

