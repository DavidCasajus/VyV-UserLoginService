<?php

namespace UserLoginService\Infrastructure;

use UserLoginService\Application\SessionManager;
use UserLoginService\Domain\User;

class FacebookSessionManager implements SessionManager
{

    public function login(string $userName, string $password): bool
    {
        //Imaginad que esto en realidad realiza una llamada al API de Facebook
        return rand(0, 1) == 1;
    }

    public function getSessions(): int
    {
        //Imaginad que esto en realidad realiza una llamada al API de Facebook

        return rand(0, 100);
    }

    public function logout(User $user): bool
    {
        return true;
    }

    public function loginSecure(string $userName, string $password): bool
    {
        // TODO: Implement loginSecure() method.
    }
}