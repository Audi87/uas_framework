<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nama Admin',
            'username' => 'admin',
            'alamat' => 'Alamat Admin',
            'no_handphone' => '081234567890',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), 
            'admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}