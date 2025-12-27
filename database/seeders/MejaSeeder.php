<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['kosong', 'diambil', 'rusak', 'tidak_tersedia'];
        for($i = 1; $i <= 20; $i++) {
            DB::table('mejas')->insert([
                'pusat_id' => $i % 3 + 1,
                'jenis_meja_id' => rand(1, 3),
                'nomor_meja' => 'A' . $i,
                'harga_per_jam' => rand(1, 10) * 10000,
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
