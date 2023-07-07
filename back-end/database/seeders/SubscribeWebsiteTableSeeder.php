<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscribeWebsiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscribe_websites')->insert([
            'id' => 1,
            'user_id' => 1,
            'website_id' => 1  
        ]);
        DB::table('subscribe_websites')->insert([
            'id' => 2,
            'user_id' => 2,
            'website_id' => 1  
        ]);
        DB::table('subscribe_websites')->insert([
            'id' => 3,
            'user_id' => 1,
            'website_id' => 2  
        ]);
    }
}
