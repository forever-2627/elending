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
                    'surname'=>'Happy',
                    'given_name'=>'Administrator',
                    'phone_number' => '333-3333-3333',
                    'address' => 'Admin Address',
                    'password'=>Hash::make('admin'),
                    'role_id'=>3
                ],
                [
                    'email'=>'staff@staff.com',
                    'surname'=>'Happy',
                    'given_name'=>'Staff',
                    'phone_number' => '222-2222-2222',
                    'address' => 'Staff Address',
                    'password'=>Hash::make('staff'),
                    'role_id'=>2
                ],
                [
                    'email'=>'user1@user.com',
                    'surname'=>'Happy',
                    'given_name'=>'User1',
                    'phone_number' => '111-1111-1111',
                    'address' => 'User1 Address',
                    'password'=>Hash::make('user1'),
                    'role_id'=>1
                ]
            ]
        );
    }
}
