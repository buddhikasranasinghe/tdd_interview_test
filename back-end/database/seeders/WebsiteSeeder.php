<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('websites')->insert([
            'id' => 1,
            'domain' => 'testonedomain.com'
        ]);
        DB::table('websites')->insert([
            'id' => 2,
            'domain' => 'testtwodomain.com'
        ]);
        DB::table('websites')->insert([
            'id' => 3,
            'domain' => 'testthreedomain.com'
        ]);
    }
}
