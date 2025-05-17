<?php

namespace App\Support;

class Authorization {

    public static function modifyIfOwnedByUser($jobCreatorId) {
        $user = SessionService::getSessionKey("user");
        
        if ($user !== null && isset($user['userId'])) {
            $userId = (int) $user['userId'];
            return $userId === $jobCreatorId;
        }

        return false;
    }
}