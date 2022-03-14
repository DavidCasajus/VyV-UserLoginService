<?php

namespace UserLoginService\Application;
use UserLoginService\Domain\User;
interface SessionManager
{
    public function getSessions(): int;

    public function login(string $userName, string $password): bool;

    public function  logout(User $user): bool;

    public function secureLogin(string $userName, string $password): bool;
}