<?php
namespace UserLoginService\Tests\Doubles;
use phpDocumentor\Reflection\Types\Boolean;
use UserLoginService\Application\SessionManager;
use UserLoginService\Domain\User;

class StubSessionManager implements SessionManager
{

    public function getSessions(): int
    {
        return 0;
    }

    public function login(string $userName, string $password): bool
    {
        return false;
    }

    public function logout(User $user): bool
    {
        return true;
    }

    public function loginSecure(string $userName, string $password): bool
    {
        return true;
    }
}