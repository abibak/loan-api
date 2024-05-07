<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Loan::create([
                'user_id' => User::all()->random()->id,
                'amount' => rand(10000, 50000),
                'status' => false,
            ]);
        }
    }
}
