<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // (İsteğe bağlı) Tüm kullanıcıları silmek için:
        // User::query()->delete();

        // Tekil kullanıcılar
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Test admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]);
        }

        if (!User::where('email', 'admin2@example.com')->exists()) {
            User::create([
                'name' => 'Admin Two',
                'email' => 'admin2@example.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]);
        }

        if (!User::where('email', 'admin3@example.com')->exists()) {
            User::create([
                'name' => 'Admin Three',
                'email' => 'admin3@example.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]);
        }

        if (!User::where('email', 'user@example.com')->exists()) {
            User::create([
                'name' => 'Test user',
                'email' => 'user@example.com',
                'password' => Hash::make('123456'),
                'role' => 'user',
            ]);
        }
    }
}
