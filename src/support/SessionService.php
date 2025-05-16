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
        session_regenerate_id(true);
    }


    public static function getSessionKey(string $key, mixed $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }


    public static function removeAllSessionData() {
        self::startSessionIfNotStarted();
        session_unset();
        session_destroy();
    }
}