<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name'        => 'App',
            'last_name'         => 'Admin',
            'email'             => 'admin@gmail.com',
            'phone'             => 9686657849,
            'role_id' => 1,
            'password'          => Hash::make('test1234'),
        ]);

    }
}
