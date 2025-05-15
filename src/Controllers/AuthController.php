<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use App\Support\Validation;
use App\Support\SessionService;

class AuthController {

    public function __construct(protected UserRepository $userRepository){}
   
    public function showRegisterPage() {
        $this->render("register.view", []);
    }

    public function handleRegister() {
        $name = $_POST["name"] ?? "";
        $email = $_POST["email"] ?? "";
        $city = $_POST["city"] ?? "";
        $state = $_POST["state"] ?? "";
        $password = $_POST["password"] ?? "";
        $passwordConfirmation = $_POST["password_confirmation"] ?? "";

        $errors = [];

        if (!Validation::email($email)) {
             $errors["email"] = "Please enter a valid email";
        }

        if (!Validation::string($name, 2, 50)) {
            $errors["name"] = "Please enter a valid name";
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (!Validation::match($password, $passwordConfirmation)) {
        $errors['password_confirmation'] = 'Passwords do not match';
        }

        
        if (!empty($errors)) {
            $this->render("register.view", [
                "errors" => $errors
            ]);
            exit;
        }

        //Check if the user input email is exist in the DB
        $user = $this->userRepository->findByEmail($email);

        if (!empty($user)) {
            $errors["email"] = "Email already taken";

            $this->render("register.view", [
                "errors" => $errors
            ]);
            exit;
        }


        $formData = [
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ];


        //store formData to DB
        $userId = $this->userRepository->registerAccount($formData);
        

        SessionService::setSessionValue("user", [
            "userId" => $userId,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
        ]);


        header("Location: index.php");
    }



    protected function render(string $view, array $params) {      
        extract($params);
    
        ob_start();

        //get pages
        require __DIR__ . "/../views/pages/" . $view . ".php";
        $contents = ob_get_clean();

        //inject that page to layout
        require __DIR__ . '/../views/layout/main.view.php';
    }
}