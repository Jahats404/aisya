<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'name' => 'fajri',
            'tanggal_lahir' => '2023-06-30',
            'nik' => '123123',
            'kk' => '123123',
            'no_hp' => '123123',
            'email' => 'fajri@gmail.com',
            'password' => Hash::make('fajri'),
            'role_id' => 1,
            'kecamatan' => 'kesugihan',
            'desa' => 'kalisabuk',
            'remember_token' => Str::random(60),
        ]);
        // User::create([
        //     'name' => 'hengri',
        //     'tanggal_lahir' => '2023-06-30',
        //     'nik' => '123123',
        //     'kk' => '123123',
        //     'no_hp' => '123123',
        //     'email' => 'hengri@gmail.com',
        //     'password' => Hash::make('hengri'),
        //     'role_id' => 2,
        //     'kecamatan' => 'kesugihan',
        //     'desa' => 'kalisabuk',
        //     'remember_token' => Str::random(60),
        // ]);
        // User::create([
        //     'name' => 'dimas',
        //     'tanggal_lahir' => '2023-06-30',
        //     'nik' => '123123',
        //     'kk' => '123123',
        //     'no_hp' => '123123',
        //     'email' => 'dimas@gmail.com',
        //     'password' => bcrypt('dimas'),
        //     'role_id' => 2,
        //     'remember_token' => Str::random(60),
        // ]);
    }
}
