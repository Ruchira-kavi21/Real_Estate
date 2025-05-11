<?php

namespace Database\Seeders;

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
            ['name' => 'ruchira', 'email' => 'user@havenhomes.com', 'password' => Hash::make('password'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Admin', 'email' => 'admin@havenhomes.com', 'password' => Hash::make('password'), 'is_admin' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
