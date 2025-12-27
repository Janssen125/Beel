<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisMejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_mejas')->insert([
            ['nama_jenis_meja' => 'Reguler'],
            ['nama_jenis_meja' => 'VIP'],
            ['nama_jenis_meja' => 'Outdoor'],
        ]);
    }
}
