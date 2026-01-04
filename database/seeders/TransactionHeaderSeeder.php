<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Meja;

class TransactionHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['pending', 'completed', 'cancelled'];
        for($i = 1; $i <= 20; $i++) {
            $status = $statuses[array_rand($statuses)];
            $pusatId = rand(1, 3);

            $nomorMeja = Meja::where('pusat_id', $pusatId)
                ->inRandomOrder()
                ->value('nomor_meja');

            $hargaPerJam = Meja::where('nomor_meja', $nomorMeja)
                ->value('harga_per_jam');

            if($i % 3 == 0) {
                DB::table('transaction_headers')->insert([
                    'staff_id' => rand(5, 13),
                    'nama_customer' => 'Customer ' . $i,
                    'pusat_id' => $pusatId,
                    'status' => $status,
                ]);
            }
            else {
                $waktu_tutup = null;
                if($status == 'completed') {
                    $waktu_tutup = now()->subMinutes(rand(30, 180));
                }
                $total_waktu_detik = rand(3600, 10800);
                $total_harga = $hargaPerJam * round($total_waktu_detik / 3600);
                DB::table('transaction_headers')->insert([
                    'staff_id' => rand(5, 13),
                    'nama_customer' => 'Customer ' . $i,
                    'pusat_id' => $pusatId,
                    'status' => $status,
                    'nomor_meja' => $nomorMeja,
                    'total_waktu_detik' => $total_waktu_detik,
                    'harga_per_jam' => $hargaPerJam,
                    'waktu_tutup' => $waktu_tutup,
                    'total_harga' => $total_harga,
                ]);
            }
        }
    }
}
