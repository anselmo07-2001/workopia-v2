<?php

namespace App\Controllers;



class AuthController {

    public function showRegisterPage() {
        $this->render("register.view", []);
    }

    public function handleRegister() {
        echo "handle Register";
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