<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use PHPUnit\Framework\TestCase;
use UserLoginService\Application\SessionManager;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FacebookSessionManager;
use UserLoginService\Tests\Doubles\FakeSessionManager;
use UserLoginService\Tests\Doubles\MockSessionManager;
use UserLoginService\Tests\Doubles\StubSessionManager;
use Mockery;


final class UserLoginServiceTest extends TestCase
{
    const LOGIN_INCORRECTO = "Login incorrecto";
    const LOGIN_CORRECTO = "Login correcto";

    /**
     * @test
     */
    public function userIsLoggedIn()
    {
        $userLoginService = new UserLoginService(new FacebookSessionManager());
        $user = new User("user_name");

        $userLoginService->manualLogin($user);
        $this->assertEquals([$user], $userLoginService->getLoggedUssers());
    }

    /**
     * @test
     */
    public function no_user_logged_in()
    {
        $userLoginService = new UserLoginService(new FacebookSessionManager());

        $this->assertEmpty($userLoginService->getLoggedUssers());
    }


    /**
     * @test
     */
    public function count_external_sessions()
    {
        $userLoginService = new UserLoginService(new StubSessionManager());

        $this->assertEquals(0, $userLoginService->getSessionManager()->getSessions());
    }

    /**
     * @test
     */
    public function test_fake_login_correct_service()
    {
        $userName = "user_name";
        $password = "password";
        $expected = self::LOGIN_CORRECTO;
        $userLoginService = new UserLoginService(new FakeSessionManager());

        $this->assertEquals($expected, $userLoginService->login($userName,$password));
    }

    /**
     * @test
     */
    public function test_fake_login_incorrect_service()
    {
        $userName = "username";
        $password = "password";
        $expected = self::LOGIN_INCORRECTO;
        $userLoginService = new UserLoginService(new FakeSessionManager());

        $this->assertEquals($expected, $userLoginService->login($userName,$password));
    }

    /**
     * @test
     */
    public function test_error_logout()
    {
        $user = new User("user_name");
        $expected = "Usuario no logeado";
        $userLoginService = new UserLoginService(new StubSessionManager());

        $this->assertEquals($expected, $userLoginService->logout($user));
    }

    /**
     * @test
     */
    public function test_correct_logout()
    {
        $user = new User("user_name");
        $expected = "Ok";
        $userLoginService = new UserLoginService(new StubSessionManager());
        $userLoginService->manualLogin($user);
        $this->assertEquals($expected, $userLoginService->logout($user));
    }

    /**
     * @test
     */
    public function user_not_securely_logged_in_if_user_not_exist(){
        $user = new User("user_name");
        $userLoginService = new UserLoginService(new MockSessionManager());

//        $sesionManager->times(1);
//        $sesionManager->withArguments("user_name");
//        $sesionManager->andThrowException("servicio no responde");

        $result = $userLoginService->secureLogin("user_name","incorrecto");
        $this->assertEquals("Contraseña incorrecta", $result);
    }

    /**
     * @test
     */
    public function user_not_securely_logged_in_with_server_error(){
        $user = new User("user_name");
        $userLoginService = new UserLoginService(new MockSessionManager());

//        $sesionManager->times(1);
//        $sesionManager->withArguments("user_name");
//        $sesionManager->andThrowException("servicio no responde");

        $result = $userLoginService->secureLogin("incorrecto","incorrecto");
        $this->assertEquals("Error en el servidor", $result);
    }

    /**
     * @test
     */
    public function user_not_securely_logged_in_with_server_error_mockery(){
        $sessionManager = Mockery::mock(SessionManager::class);

        $sessionManager->shouldHaveBeenCalled('secureLogin')
            ->withArgs(['user_name',"password"])
            ->once()
            ->andThrow(new \Exception('Service not found'));

        $userLoginService = new UserLoginService($sessionManager);

        $result = $userLoginService->secureLogin("incorrecto","incorrecto");
        $this->assertEquals("Error en el servidor", $result);
    }
}
