<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $username = env('ADMIN_USER', 'oscard');
        $password = env('ADMIN_PASSWORD', 'Oscar121*');

        User::updateOrCreate(
            ['username' => $username],
            ['password' => Hash::make($password)]
        );
    }
}
