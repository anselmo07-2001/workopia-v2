<?php

namespace App\Support;

class CsrfHelper {
    public function handle() {
        $this->ensureSession();
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {   
        
            if (!empty($_POST["_csrf"]) && !empty($_SESSION["csrftoken"]) 
                 && $_POST["_csrf"] === $_SESSION["csrftoken"]) {  
                
                 unset($_SESSION["csrftoken"]);   
                 return; 
            }

            echo "Error: CSRF token mismatch";
            die();          
        }
    }

    private function ensureSession() {
        if (session_id() === "") {
            session_start();
        }  
    }

    public function generateToken() {
        if (empty($_SESSION["csrftoken"])) {
            $token = bin2hex(random_bytes(32));
            $_SESSION["csrftoken"] = $token;
        }
        return $_SESSION["csrftoken"];
    }
}