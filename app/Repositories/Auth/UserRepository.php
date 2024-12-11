<?php

namespace App\Repositories\Auth;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }
}