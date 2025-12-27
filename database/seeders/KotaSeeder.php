<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kotas')->insert([
            ['nama_kota' => 'Surabaya', 'provinsi_id' => 1],
            ['nama_kota' => 'Bandung', 'provinsi_id' => 2],
            ['nama_kota' => 'Jakarta', 'provinsi_id' => 3],
        ]);
    }
}
