<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'barang_kode' => 'KS01', 
                'barang_nama' => 'SnackTock',
                'harga_beli' => '9000',
                'harga_jual' => '10000',
            ],
            [
                'kategori_id' => 1,
                'barang_kode' => 'KS02', 
                'barang_nama' => 'Nui GreenTea',
                'harga_beli' => '5500',
                'harga_jual' => '7000',
            ],
            [
                'kategori_id' => 1,
                'barang_kode' => 'KS03', 
                'barang_nama' => 'Basreng',
                'harga_beli' => '3000',
                'harga_jual' => '5000',
            ],

            [
                'kategori_id' => 2,
                'barang_kode' => 'EK01', 
                'barang_nama' => 'Kipas Angin',
                'harga_beli' => '60000',
                'harga_jual' => '75000',
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'EK02', 
                'barang_nama' => 'Televisi',
                'harga_beli' => '90000',
                'harga_jual' => '120000',
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'EK03', 
                'barang_nama' => 'Mixer',
                'harga_beli' => '45000',
                'harga_jual' => '50000',
            ],

            [
                'kategori_id' => 3,
                'barang_kode' => 'FN01', 
                'barang_nama' => 'Meja',
                'harga_beli' => '45000',
                'harga_jual' => '50000',
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'FN02', 
                'barang_nama' => 'Kursi',
                'harga_beli' => '20000',
                'harga_jual' => '30000',
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'FN03', 
                'barang_nama' => 'Bangku',
                'harga_beli' => '30000',
                'harga_jual' => '35000',
            ],

            [
                'kategori_id' => 4,
                'barang_kode' => 'KC01', 
                'barang_nama' => 'Serum',
                'harga_beli' => '70000',
                'harga_jual' => '80000',
            ],
            [
                'kategori_id' => 4,
                'barang_kode' => 'KC02', 
                'barang_nama' => 'FaceWash',
                'harga_beli' => '25000',
                'harga_jual' => '30000',
            ],
            [
                'kategori_id' => 4,
                'barang_kode' => 'KC03', 
                'barang_nama' => 'LipCream',
                'harga_beli' => '15000',
                'harga_jual' => '25000',
            ],

            [
                'kategori_id' => 5,
                'barang_kode' => 'KH01', 
                'barang_nama' => 'Alcohol',
                'harga_beli' => '25000',
                'harga_jual' => '30000',
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'KH02', 
                'barang_nama' => 'Betadine',
                'harga_beli' => '15000',
                'harga_jual' => '20000',
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'KH03', 
                'barang_nama' => 'Hansaplast',
                'harga_beli' => '10000',
                'harga_jual' => '15000',
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
