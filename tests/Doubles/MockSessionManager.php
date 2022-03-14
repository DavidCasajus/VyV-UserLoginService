<?php

namespace UserLoginService\Tests\Doubles;

use PHPUnit\Util\Exception;
use UserLoginService\Application\SessionManager;
use UserLoginService\Domain\User;

class MockSessionManager implements SessionManager
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
        if($userName == "user_name" && $password != "password")
        {
            throw (new Exception("1"));
        }else if ($userName == "user_name")
        {
            throw (new Exception("2"));
        }else{
            throw (new Exception("3"));
        }
        return true;
    }
}