<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PusatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pusats')->insert([[
            'nama_pusat' => 'Orca',
            'alamat' => 'Jl. Pahlawan No. 45, Surabaya',
            'pemilik_id' => 2,
            'kota_id' => 1,
        ],[
            'nama_pusat' => 'Millie',
            'alamat' => 'Jl. Bunga No. 78, Bandung',
            'pemilik_id' => 3,
            'kota_id' => 2,
        ],[
            'nama_pusat' => 'Red Ball',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'pemilik_id' => 4,
            'kota_id' => 3,
        ]]);
    }
}
