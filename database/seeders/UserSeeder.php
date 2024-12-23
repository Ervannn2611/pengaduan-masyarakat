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

        // User::create([
        //     'email' => 'orang@gmail.com',
        //     'password' => Hash::make('orang'),
        //     'role' => 'GUEST',
        // ]);

        User::create([
            'email' => 'staff@gmail.com',
            'password' => Hash::make('staff'),
            'role' => 'STAFF',
        ]);


    }
}
