<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'user@mail.ru',
            'password' => Hash::make('pass123'),
        ]);

        User::factory()->count(10)->create();
    }
}
