<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FnbSeeder::class,
            ProvinsiSeeder::class,
            KotaSeeder::class,
            JenisMejaSeeder::class,
            UserSeeder::class,
            PusatSeeder::class,
            UserPusatSeeder::class,
            FnBPusatSeeder::class,

            // Kalau beneren di deploy, di comment
            MejaSeeder::class,
            TransactionHeaderSeeder::class,
            TransactionDetailSeeder::class,
        ]);
    }
}
