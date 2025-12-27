<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 6; $i++) {
            $transactionId = $i * 3;

            $pusatId = DB::table('transaction_headers')
                ->where('id', $transactionId)
                ->value('pusat_id');

            $fnbIds = DB::table('fnb_pusats')
                ->where('pusat_id', $pusatId)
                ->pluck('fnb_id')
                ->toArray();

            $namaFnb = DB::table('fnb')
                ->whereIn('id', $fnbIds)
                ->inRandomOrder()
                ->value('nama_fnb');

            $hargaFnb = DB::table('fnb')
                ->whereIn('id', $fnbIds)
                ->inRandomOrder()
                ->value('harga');

            $quantity = rand(1, 5);

            DB::table('transaction_details')->insert([
                'transaction_header_id' => $transactionId,
                'nama_fnb' => $namaFnb,
                'harga' => $hargaFnb,
                'quantity' => rand(1, 5),
            ]);

            DB::table('transaction_headers')
                ->where('id', $transactionId)
                ->update([
                    'total_harga' => DB::table('transaction_headers')
                        ->where('id', $transactionId)
                        ->value('total_harga') + ($hargaFnb * $quantity)
                ]);
        }
    }
}
