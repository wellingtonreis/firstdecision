<?php 

namespace App\UseCases\RegisterUser;

use App\Repositories\Auth\UserRepositoryInterface;

class RegisterUserUseCase {
    
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(RegisterUserDto $request): RegisterUserResponse
    {
        try {
            $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            
            return RegisterUserResponse::success('Usuário registrado com sucesso.');
        } catch (\Exception $e) {
            return RegisterUserResponse::error($e->getMessage());
        }
    }
}