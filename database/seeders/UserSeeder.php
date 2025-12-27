<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([[
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin123'),
            'role' => 'superadmin',
        ],[
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ],[
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ],[
            'name' => 'Admin3',
            'email' => 'admin3@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ],[
            'name' => 'Staff1',
            'email' => 'staff1@gmail.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ],[
            'name' => 'Staff2',
            'email' => 'staff2@gmail.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ],[
            'name' => 'Staff3',
            'email' => 'staff3@gmail.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ],[
            'name' => 'Staff4',
            'email' => 'staff4@gmail.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ],[
            'name' => 'Staff5',
            'email' => 'staff5@gmail.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ],[
            'name' => 'Staff6',
            'email' => 'staff6@gmail.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ],[
            'name' => 'Staff7',
            'email' => 'staff7@gmail.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ],[
            'name' => 'Staff8',
            'email' => 'staff8@gmail.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ],[
            'name' => 'Staff9',
            'email' => 'staff9@gmail.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ]]);
    }
}
