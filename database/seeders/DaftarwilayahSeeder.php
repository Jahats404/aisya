<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Daftarwilayah;

class DaftarwilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Daftarwilayah::tuncate();
        Daftarwilayah::create([
            'nama' => 'Kesugihan',
        ]);
        Daftarwilayah::create([
            'nama' => 'Kesugihan',
        ]);
        Daftarwilayah::create([
            'nama' => 'Kalisabuk',
        ]);
        Daftarwilayah::create([
            'nama' => 'Kalisabuk',
        ]);
    }
}
