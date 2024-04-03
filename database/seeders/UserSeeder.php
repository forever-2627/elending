<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
                [
                    'email'=>'admin@admin.com',
                    'name'=>'Administrator',
                    'password'=>Hash::make('admin'),
                    'role_id'=>3
                ],
                [
                    'email'=>'staff@staff.com',
                    'name'=>'Staff',
                    'password'=>Hash::make('staff'),
                    'role_id'=>2
                ],
                [
                    'email'=>'user@user.com',
                    'name'=>'User',
                    'password'=>Hash::make('user'),
                    'role_id'=>1
                ]
            ]
        );
    }
}
