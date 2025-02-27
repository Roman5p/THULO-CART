<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Roman',
                'email' => 'roman@gmail.com',
                'profile' => 'users/roman.png',
                'password' => bcrypt('password'),
                'role' => 'user',
                'gender' => 'male',

                'contact' => '1234567890',
            ],
            [
                'name' => 'Rahul',
                'email' => 'rahul@gmail.com',
                'profile' => 'users/rahul.png',
                'password' => bcrypt('password'),
                'role' => 'user',
                'gender' => 'male',
                'contact' => '1234567890',
            ]

        ]);

        User::insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'profile' => 'users/admin.png',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'gender' => 'male',
            'contact' => '1234567890',
        ]);
    }
}
