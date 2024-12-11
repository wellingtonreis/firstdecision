<?php 

namespace App\Repositories\Auth;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
}