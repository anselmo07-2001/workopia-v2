<?php

namespace App\Support;

use PDO;


//Managin logout/ login
class AuthService {
    public function __construct(private PDO $pdo) {}

    public function handlelogout() {
        session_regenerate_id(true);
        SessionService::removeAllSessionData();     
    }
}
