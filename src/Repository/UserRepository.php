<?php

namespace App\Repository;

use PDO;
use \App\Model\UserModel;

class UserRepository {
   public function __construct(private PDO $pdo) {}

   public function findByEmail(string $email): ?UserModel {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
        $user = $stmt->fetch();

        if (!empty($user)) {
             return $user;
         }
         else {
            return null;
         }
   }


   public function registerAccount(array $formData) {
        $stmt = $this->pdo->prepare("INSERT INTO `users` (name, email, city, state, password, created_at) VALUES (:name, :email, :city, :state, :password, :created_at)");

        $stmt->bindValue(":name", $formData["name"]);
        $stmt->bindValue(":email", $formData["email"]);
        $stmt->bindValue(":city", $formData["city"]);
        $stmt->bindValue(":state", $formData["state"]);
        $stmt->bindValue(":password", $formData["password"]);
        $stmt->bindValue(":created_at", $formData["created_at"]);

        return $stmt->execute();
   }
}