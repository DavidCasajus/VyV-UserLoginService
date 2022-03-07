<?php

namespace UserLoginService\Application;

class UserLoginService
{
    private array $loggedUsers = [];

    public function manualLogin(): string
    {
        return "user logged";
    }

}