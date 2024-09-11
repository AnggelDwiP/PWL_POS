<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'B01', 
                'kategori_nama' => 'Konsumsi',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'B02', 
                'kategori_nama' => 'Elektronik',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'B03', 
                'kategori_nama' => 'Furniture',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'B04', 
                'kategori_nama' => 'Kecantikan',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'B05', 
                'kategori_nama' => 'Kesehatan',
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
