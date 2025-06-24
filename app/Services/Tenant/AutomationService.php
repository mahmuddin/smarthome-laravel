<?php
namespace App\Services;

use App\Models\User;

class AutomationService
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {

        $user->update($data);
        return $user;
    }
}
