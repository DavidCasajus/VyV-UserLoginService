<?php

namespace UserLoginService\Tests\Doubles;

use UserLoginService\Application\SessionManager;
use UserLoginService\Domain\User;

class SpySessionManager implements SessionManager
{

    public function getSessions(): int
    {
        // TODO: Implement getSessions() method.
    }

    public function login(string $userName, string $password): bool
    {
        // TODO: Implement login() method.
    }

    public function logout(User $user): bool
    {
        // TODO: Implement logout() method.
    }

    public function loginSecure(string $userName, string $password): bool
    {
        // TODO: Implement loginSecure() method.
    }
}