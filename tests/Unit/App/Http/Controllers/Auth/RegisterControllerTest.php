<?php

namespace Tests\Unit\Http\Controllers\Auth;

use Tests\TestCase;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\UseCases\RegisterUser\RegisterUserResponse;
use App\UseCases\RegisterUser\RegisterUserUseCase;
use Mockery;

class RegisterControllerTest extends TestCase
{

    private $registerUserUseCase;
    private $registerController;
    private $user;
    private $userGenerated;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registerUserUseCase = $this->createMock(RegisterUserUseCase::class);
        $this->registerController = new RegisterController($this->registerUserUseCase);

        $this->user = User::factory()->createOne();
        $this->userGenerated = [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];
    }

    public function testIndex()
    {
        $response = $this->registerController->index();
        $this->assertEquals('auth.register', $response->name());
    }

    public function testCreateSuccess()
    {
        $registerUserUseCase = Mockery::mock(RegisterUserUseCase::class);
        $registerUserUseCase->shouldReceive('execute')
            ->andReturn(new RegisterUserResponse(true, 'Usuário registrado com sucesso.'));

        $controller = new RegisterController($registerUserUseCase);

        $request = new RegisterUserRequest($this->userGenerated);

        $response = $controller->create($request);

        $this->assertEquals(302, $response->status());
        $this->assertEquals(route('register.index'), $response->headers->get('Location'));
        $this->assertEquals('Usuário registrado com sucesso.', session('success'));
    }

    public function testCreateFailure()
    {
        $registerUserUseCase = Mockery::mock(RegisterUserUseCase::class);
        $registerUserUseCase->shouldReceive('execute')
        ->andReturn(new RegisterUserResponse(false, 'Ops, algo deu errado. Tente novamente mais tarde.'));

        $controller = new RegisterController($registerUserUseCase);

        $request = new RegisterUserRequest($this->userGenerated);

        $response = $controller->create($request);

        $this->assertEquals(302, $response->status());
        $this->assertEquals(url()->previous(), $response->headers->get('Location'));
        $this->assertEquals('Ops, algo deu errado. Tente novamente mais tarde.', session('error'));
    }

    public function testStore()
    {
        $registerUserUseCase = Mockery::mock(RegisterUserUseCase::class);
        $registerUserUseCase->shouldReceive('execute')
            ->andReturn(new RegisterUserResponse(true, 'Usuário registrado com sucesso.'));

        $controller = new RegisterController($registerUserUseCase);

        $request = new RegisterUserRequest($this->userGenerated);

        $response = $controller->store($request);

        $this->assertEquals(200, $response->status());
        $this->assertJson($response->getContent());
        $this->assertEquals('Usuário registrado com sucesso.', json_decode($response->getContent())->message);
    }
}