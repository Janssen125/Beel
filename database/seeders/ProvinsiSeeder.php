<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinsis')->insert([
            ['nama_provinsi' => 'Jawa Timur'],
            ['nama_provinsi' => 'Jawa Barat'],
            ['nama_provinsi' => 'DKI Jakarta'],
        ]);
    }
}
