<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Buddhika',
            'email' => 'buddhikasranasinghe96@gmail.com',
            'password' => Hash::make('buddhika@123')
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Ishara',
            'email' => 'hgimadushani96@gmail.com',
            'password' => Hash::make('Ishara@123')
        ]);
    }
}
