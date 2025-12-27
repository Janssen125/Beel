<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPusatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_pusats')->insert([
            ['user_id' => 5, 'pusat_id' => 1],
            ['user_id' => 6, 'pusat_id' => 2],
            ['user_id' => 7, 'pusat_id' => 3],
            ['user_id' => 8, 'pusat_id' => 1],
            ['user_id' => 9, 'pusat_id' => 2],
            ['user_id' => 10, 'pusat_id' => 3],
            ['user_id' => 11, 'pusat_id' => 1],
            ['user_id' => 12, 'pusat_id' => 2],
            ['user_id' => 13, 'pusat_id' => 3],
        ]);
    }
}
