<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class fnbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fnb')->insert([
            [
                'nama_fnb' => 'Nasi Goreng Spesial',
                'deskripsi' => 'Nasi goreng dengan bumbu rahasia dan tambahan telur mata sapi.',
                'harga' => 25000,
            ],
            [
                'nama_fnb' => 'Mie Ayam Bakso',
                'deskripsi' => 'Mie ayam dengan bakso sapi segar dan kuah kaldu gurih.',
                'harga' => 20000,
            ],
            [
                'nama_fnb' => 'Es Teh Manis',
                'deskripsi' => 'Minuman segar es teh dengan gula merah.',
                'harga' => 8000,
            ],
            [
                'nama_fnb' => 'Jus Alpukat',
                'deskripsi' => 'Jus alpukat segar dengan tambahan susu kental manis.',
                'harga' => 15000,
            ],
            [
                'nama_fnb' => 'Sate Ayam',
                'deskripsi' => 'Sate ayam dengan bumbu kacang khas Indonesia.',
                'harga' => 22000,
            ],
            [
                'nama_fnb' => 'Pisang Goreng',
                'deskripsi' => 'Pisang goreng renyah dengan taburan gula halus.',
                'harga' => 12000,
            ],
        ]);
    }
}
