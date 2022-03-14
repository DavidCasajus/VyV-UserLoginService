<?php

namespace UserLoginService\Tests\Doubles;

use UserLoginService\Application\SessionManager;
use UserLoginService\Domain\User;
use function PHPUnit\Framework\throwException;

class FakeSessionManager implements SessionManager
{

    public function getSessions(): int
    {
        return 0;
    }

    public function login(string $userName, string $password): bool
    {
        if ($userName == "user_name" && $password == "password") {
            return true;
        } else {
            return false;
        }
    }

    public function logout(User $user): bool
    {
        return true;
    }

    public function secureLogin(string $userName, string $password): bool
    {
        if($userName == "user_name" && $password != "password")
        {
            throwException(new \Exception("1"));
        }else if ($userName == "user_name")
        {
            throwException(new \Exception("2"));
        }else{
            throwException(new \Exception("3"));
        }
        return false;
    }
}