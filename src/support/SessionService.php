<?php

namespace App\Support;

class SessionService {
     
    public static function startSessionIfNotStarted() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function setSessionValue(string $key, mixed $value) {
        self::startSessionIfNotStarted();
        $_SESSION[$key] = $value;
    }


    public static function getSessionKey(string $key, mixed $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }
}