<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kategori::truncate();
        Kategori::create([
            'id_kategori' => 'P01',
            'nama_kategori' => 'Ijazah',
        ]);
        // Kategori::create([
        //     'id_kategori' => 'P02',
        //     'nama_kategori' => 'Raport',
        // ]);
        
        
    }
}
