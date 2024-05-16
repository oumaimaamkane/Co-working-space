<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '123456789',
                'password' => Hash::make('password123'),
                'role_id' => 2
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'phone' => '555666777',
                'password' => Hash::make('password789'),
                'role_id' => 2
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@example.com',
                'phone' => '444333222',
                'password' => Hash::make('passwordabc'),
                'role_id' => 2
            ],
            [
                'name' => 'Boba Smith',
                'email' => 'boba@example.com',
                'phone' => '444133222',
                'password' => Hash::make('passwordabc'),
                'role_id' => 2
            ],
            [
                'name' => 'Eva Anderson',
                'email' => 'eva@example.com',
                'phone' => '111222333',
                'password' => Hash::make('passwordeva'),
                'role_id' => 2
            ],
            [
                'name' => 'Michael Williams',
                'email' => 'michael@example.com',
                'phone' => '999888777',
                'password' => Hash::make('passwordmike'),
                'role_id' => 2
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
