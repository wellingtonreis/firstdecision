<?php 

namespace App\UseCases\RegisterUser;

class RegisterUserResponse {
    
    public function __construct(
        public bool $outcome,
        public ?string $message
    ) {}

    public static function success(string $message): RegisterUserResponse
    {
        return new self(true, $message);
    }

    public static function error(string $message): RegisterUserResponse
    {
        return new self(false, $message);
    }
}