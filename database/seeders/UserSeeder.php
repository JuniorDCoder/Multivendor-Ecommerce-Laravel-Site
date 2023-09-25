<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin user',
                'username' => 'adminuser',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Vendor user',
                'username' => 'vendoruser',
                'email' => 'vendor@gmail.com',
                'role' => 'vendor',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'role' => 'user',
                'status' => 'active',
                'password' => bcrypt('password')
            ]
        ]);
    }
}
