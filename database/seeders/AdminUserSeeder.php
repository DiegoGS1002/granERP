<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@nexora.local'],
            [
                'name' => 'Administrador Nexora',
                'password' => 'admin12345',
                'is_admin' => true,
            ]
        );
    }
}

