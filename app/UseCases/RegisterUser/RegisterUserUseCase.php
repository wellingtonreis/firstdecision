<?php 

namespace App\UseCases\RegisterUser;

use App\Repositories\Auth\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;

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
            Log::error($e->getMessage());
            return RegisterUserResponse::error('Ops, algo deu errado. Tente novamente mais tarde.');
        }
    }
}