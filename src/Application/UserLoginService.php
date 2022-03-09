<?php

namespace UserLoginService\Application;

use PHPUnit\Exception;
use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FacebookSessionManager;

class UserLoginService
{
    private array $loggedUsers = [];
    private SessionManager $sessionManager;

    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }


    public function manualLogin(User $user): void
    {
        $this->loggedUsers[] = $user;
    }

    public function getLoggedUssers(): array
    {
        return $this->loggedUsers;
    }

    public function countExternalSessions(): int
    {
        return $this->sessionManager->getSessions();
    }

    /**
     * @return SessionManager
     */
    public function getSessionManager(): SessionManager
    {
        return $this->sessionManager;
    }

    public function login(string $userName, string $password): string
    {
        if( $this->sessionManager->login($userName,$password))
        {
            $this->loggedUsers[] = new User($userName);
            return "Login correcto";
        }else{
            return "Login incorrecto";
        }
    }

    public function  logout(User $user): string {
        $this->sessionManager->logout($user);
        if(in_array($user,$this->loggedUsers))
        {
            unset($this->loggedUsers[array_search($user,$this->loggedUsers)]);
            return "Ok";
        }else{
            return "Usuario no logeado";
        }
    }

    public function loginSecure(String $username,String $password) :string
    {
        try {
            $this->sessionManager->loginSecure($username,$password);
        }catch (Exception $ex)
        {
            if($ex->getMessage() == "No se pudo conectar con el servidor"){
                return "No se pudo conectar con el servidor";
            }
        }
    }


}