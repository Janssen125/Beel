<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FnBPusatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fnb_pusats')->insert([
            ['fnb_id' => 1, 'pusat_id' => 1, 'harga' => 20000],
            ['fnb_id' => 2, 'pusat_id' => 1, 'harga' => 15000],
            ['fnb_id' => 3, 'pusat_id' => 2, 'harga' => 30000],
            ['fnb_id' => 4, 'pusat_id' => 2, 'harga' => 12000],
            ['fnb_id' => 5, 'pusat_id' => 3, 'harga' => 9000],
            ['fnb_id' => 6, 'pusat_id' => 3, 'harga' => 90000],
        ]);
    }
}
