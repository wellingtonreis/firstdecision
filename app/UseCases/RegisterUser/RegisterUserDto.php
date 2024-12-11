<?php

namespace App\UseCases\RegisterUser;

class RegisterUserDto {

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $password_confirmation
    ) {}
}