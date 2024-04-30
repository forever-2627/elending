<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loan_states')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'active'
                ],
                [
                    'id' => 2,
                    'name' => 'repaid'
                ],
                [
                    'id' => 3,
                    'name' => 'bad'
                ]
            ]
        );
    }
}
