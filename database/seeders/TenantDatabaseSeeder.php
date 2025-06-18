<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class TenantDatabaseSeeder extends Seeder
{
    protected array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function run(): void
    {
        User::create([
            'name' => $this->data['name'] ?? 'Admin',
            'email' => $this->data['email'] ?? 'admin@tenant.com',
            'password' => bcrypt($this->data['password'] ?? 'password'),
            'role' => $this->data['role'] ?? 'admin',
        ]);

        // Tambahan seed lain
    }
}
