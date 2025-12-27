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
        for($i = 1; $i <= 10; $i++) {
            $jam = rand(1, 5);
            $menit = rand(0, 59);
            $detik = rand(0, 59);
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
                DB::table('transaction_headers')->insert([
                    'staff_id' => rand(5, 13),
                    'nama_customer' => 'Customer ' . $i,
                    'pusat_id' => $pusatId,
                    'status' => $status,
                    'nomor_meja' => $nomorMeja,
                    'total_waktu' => $jam . ' jam' . $menit . ' menit' . $detik . ' detik',
                    'harga_per_jam' => $hargaPerJam,
                    'total_harga' => $jam * $hargaPerJam
                ]);
            }
        }
    }
}
