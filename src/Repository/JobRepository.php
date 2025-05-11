<?php

namespace App\Repository;

use PDO;

//this class need the pdo and job model;
class JobRepository {

    public function __construct(private PDO $pdo) {}
  

    public function fetchAllJobList(){
           var_dump("JobRepository::fetchAllJobList is triggered");
     }
}