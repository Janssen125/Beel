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
        $kotas = [

            // 1. Aceh
            ['nama_kota' => 'Banda Aceh', 'provinsi_id' => 1],
            ['nama_kota' => 'Lhokseumawe', 'provinsi_id' => 1],
            ['nama_kota' => 'Langsa', 'provinsi_id' => 1],

            // 2. Sumatera Utara
            ['nama_kota' => 'Medan', 'provinsi_id' => 2],
            ['nama_kota' => 'Binjai', 'provinsi_id' => 2],
            ['nama_kota' => 'Pematangsiantar', 'provinsi_id' => 2],

            // 3. Sumatera Barat
            ['nama_kota' => 'Padang', 'provinsi_id' => 3],
            ['nama_kota' => 'Bukittinggi', 'provinsi_id' => 3],
            ['nama_kota' => 'Payakumbuh', 'provinsi_id' => 3],

            // 4. Riau
            ['nama_kota' => 'Pekanbaru', 'provinsi_id' => 4],
            ['nama_kota' => 'Dumai', 'provinsi_id' => 4],
            ['nama_kota' => 'Bengkalis', 'provinsi_id' => 4],

            // 5. Kepulauan Riau
            ['nama_kota' => 'Batam', 'provinsi_id' => 5],
            ['nama_kota' => 'Tanjung Pinang', 'provinsi_id' => 5],
            ['nama_kota' => 'Bintan', 'provinsi_id' => 5],

            // 6. Jambi
            ['nama_kota' => 'Kota Jambi', 'provinsi_id' => 6],
            ['nama_kota' => 'Sungai Penuh', 'provinsi_id' => 6],
            ['nama_kota' => 'Muaro Jambi', 'provinsi_id' => 6],

            // 7. Sumatera Selatan
            ['nama_kota' => 'Palembang', 'provinsi_id' => 7],
            ['nama_kota' => 'Lubuk Linggau', 'provinsi_id' => 7],
            ['nama_kota' => 'Prabumulih', 'provinsi_id' => 7],

            // 8. Bangka Belitung
            ['nama_kota' => 'Pangkalpinang', 'provinsi_id' => 8],
            ['nama_kota' => 'Bangka', 'provinsi_id' => 8],
            ['nama_kota' => 'Belitung', 'provinsi_id' => 8],

            // 9. Bengkulu
            ['nama_kota' => 'Kota Bengkulu', 'provinsi_id' => 9],
            ['nama_kota' => 'Rejang Lebong', 'provinsi_id' => 9],
            ['nama_kota' => 'Bengkulu Utara', 'provinsi_id' => 9],

            // 10. Lampung
            ['nama_kota' => 'Bandar Lampung', 'provinsi_id' => 10],
            ['nama_kota' => 'Metro', 'provinsi_id' => 10],
            ['nama_kota' => 'Lampung Selatan', 'provinsi_id' => 10],

            // 11. DKI Jakarta
            ['nama_kota' => 'Jakarta Pusat', 'provinsi_id' => 11],
            ['nama_kota' => 'Jakarta Timur', 'provinsi_id' => 11],
            ['nama_kota' => 'Jakarta Selatan', 'provinsi_id' => 11],

            // 12. Jawa Barat
            ['nama_kota' => 'Bandung', 'provinsi_id' => 12],
            ['nama_kota' => 'Bekasi', 'provinsi_id' => 12],
            ['nama_kota' => 'Bogor', 'provinsi_id' => 12],

            // 13. Banten
            ['nama_kota' => 'Tangerang', 'provinsi_id' => 13],
            ['nama_kota' => 'Tangerang Selatan', 'provinsi_id' => 13],
            ['nama_kota' => 'Serang', 'provinsi_id' => 13],

            // 14. Jawa Tengah
            ['nama_kota' => 'Semarang', 'provinsi_id' => 14],
            ['nama_kota' => 'Surakarta', 'provinsi_id' => 14],
            ['nama_kota' => 'Magelang', 'provinsi_id' => 14],

            // 15. DI Yogyakarta
            ['nama_kota' => 'Yogyakarta', 'provinsi_id' => 15],
            ['nama_kota' => 'Sleman', 'provinsi_id' => 15],
            ['nama_kota' => 'Bantul', 'provinsi_id' => 15],

            // 16. Jawa Timur
            ['nama_kota' => 'Surabaya', 'provinsi_id' => 16],
            ['nama_kota' => 'Malang', 'provinsi_id' => 16],
            ['nama_kota' => 'Kediri', 'provinsi_id' => 16],

            // 17. Bali
            ['nama_kota' => 'Denpasar', 'provinsi_id' => 17],
            ['nama_kota' => 'Badung', 'provinsi_id' => 17],
            ['nama_kota' => 'Gianyar', 'provinsi_id' => 17],

            // 18. NTB
            ['nama_kota' => 'Mataram', 'provinsi_id' => 18],
            ['nama_kota' => 'Lombok Barat', 'provinsi_id' => 18],
            ['nama_kota' => 'Bima', 'provinsi_id' => 18],

            // 19. NTT
            ['nama_kota' => 'Kupang', 'provinsi_id' => 19],
            ['nama_kota' => 'Ende', 'provinsi_id' => 19],
            ['nama_kota' => 'Maumere', 'provinsi_id' => 19],

            // 20. Kalimantan Barat
            ['nama_kota' => 'Pontianak', 'provinsi_id' => 20],
            ['nama_kota' => 'Singkawang', 'provinsi_id' => 20],
            ['nama_kota' => 'Ketapang', 'provinsi_id' => 20],

            // 21. Kalimantan Tengah
            ['nama_kota' => 'Palangka Raya', 'provinsi_id' => 21],
            ['nama_kota' => 'Kotawaringin Barat', 'provinsi_id' => 21],
            ['nama_kota' => 'Kapuas', 'provinsi_id' => 21],

            // 22. Kalimantan Selatan
            ['nama_kota' => 'Banjarmasin', 'provinsi_id' => 22],
            ['nama_kota' => 'Banjarbaru', 'provinsi_id' => 22],
            ['nama_kota' => 'Martapura', 'provinsi_id' => 22],

            // 23. Kalimantan Timur
            ['nama_kota' => 'Samarinda', 'provinsi_id' => 23],
            ['nama_kota' => 'Balikpapan', 'provinsi_id' => 23],
            ['nama_kota' => 'Bontang', 'provinsi_id' => 23],

            // 24. Kalimantan Utara
            ['nama_kota' => 'Tarakan', 'provinsi_id' => 24],
            ['nama_kota' => 'Nunukan', 'provinsi_id' => 24],
            ['nama_kota' => 'Malinau', 'provinsi_id' => 24],

            // 25. Sulawesi Utara
            ['nama_kota' => 'Manado', 'provinsi_id' => 25],
            ['nama_kota' => 'Bitung', 'provinsi_id' => 25],
            ['nama_kota' => 'Tomohon', 'provinsi_id' => 25],

            // 26. Gorontalo
            ['nama_kota' => 'Kota Gorontalo', 'provinsi_id' => 26],
            ['nama_kota' => 'Bone Bolango', 'provinsi_id' => 26],
            ['nama_kota' => 'Boalemo', 'provinsi_id' => 26],

            // 27. Sulawesi Tengah
            ['nama_kota' => 'Palu', 'provinsi_id' => 27],
            ['nama_kota' => 'Poso', 'provinsi_id' => 27],
            ['nama_kota' => 'Donggala', 'provinsi_id' => 27],

            // 28. Sulawesi Barat
            ['nama_kota' => 'Mamuju', 'provinsi_id' => 28],
            ['nama_kota' => 'Majene', 'provinsi_id' => 28],
            ['nama_kota' => 'Polewali Mandar', 'provinsi_id' => 28],

            // 29. Sulawesi Selatan
            ['nama_kota' => 'Makassar', 'provinsi_id' => 29],
            ['nama_kota' => 'Parepare', 'provinsi_id' => 29],
            ['nama_kota' => 'Palopo', 'provinsi_id' => 29],

            // 30. Sulawesi Tenggara
            ['nama_kota' => 'Kendari', 'provinsi_id' => 30],
            ['nama_kota' => 'Bau-Bau', 'provinsi_id' => 30],
            ['nama_kota' => 'Kolaka', 'provinsi_id' => 30],

            // 31. Maluku
            ['nama_kota' => 'Ambon', 'provinsi_id' => 31],
            ['nama_kota' => 'Tual', 'provinsi_id' => 31],
            ['nama_kota' => 'Maluku Tengah', 'provinsi_id' => 31],

            // 32. Maluku Utara
            ['nama_kota' => 'Ternate', 'provinsi_id' => 32],
            ['nama_kota' => 'Tidore', 'provinsi_id' => 32],
            ['nama_kota' => 'Halmahera Barat', 'provinsi_id' => 32],

            // 33. Papua
            ['nama_kota' => 'Jayapura', 'provinsi_id' => 33],
            ['nama_kota' => 'Merauke', 'provinsi_id' => 33],
            ['nama_kota' => 'Timika', 'provinsi_id' => 33],

            // 34. Papua Barat
            ['nama_kota' => 'Manokwari', 'provinsi_id' => 34],
            ['nama_kota' => 'Sorong', 'provinsi_id' => 34],
            ['nama_kota' => 'Fakfak', 'provinsi_id' => 34],

        ];
        DB::table('kotas')->insert($kotas);
    }
}
