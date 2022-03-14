<?php

namespace UserLoginService\Tests\Doubles;

use UserLoginService\Application\SessionManager;
use UserLoginService\Domain\User;

class DummySessionManager implements SessionManager
{

    public function getSessions(): int
    {
        return 0;
    }

    public function login(string $userName, string $password): bool
    {
        return true;
    }

    public function logout(User $user): bool
    {
        return true;
    }

    public function secureLogin(string $userName, string $password): bool
    {
        return true;
    }
}