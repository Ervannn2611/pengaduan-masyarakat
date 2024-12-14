<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('admin'),
        //     'role' => 'HEAD_STAFF',
        // ]);

        User::create([
            'email' => 'ervan@gmail.com',
            'password' => Hash::make('ervan'),
            'role' => 'GUEST',
        ]);


    }
}
