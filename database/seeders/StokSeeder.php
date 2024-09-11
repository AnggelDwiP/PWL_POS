<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'barang_id' => 16, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:25:00',
                'stok_jumlah' => '70',
            ],
            [
                'supplier_id' => 1,
                'barang_id' => 17, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:25:20',
                'stok_jumlah' => '50',
            ],
            [
                'supplier_id' => 1,
                'barang_id' => 18, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:25:30',
                'stok_jumlah' => '60',
            ],

            [
                'supplier_id' => 2,
                'barang_id' => 19, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:26:00',
                'stok_jumlah' => '100',
            ],
            [
                'supplier_id' => 2,
                'barang_id' => 20, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:26:10',
                'stok_jumlah' => '80',
            ],
            [
                'supplier_id' => 2,
                'barang_id' => 21, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:26:20',
                'stok_jumlah' => '90',
            ],

            [
                'supplier_id' => 2,
                'barang_id' => 22, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:27:30',
                'stok_jumlah' => '100',
            ],
            [
                'supplier_id' => 2,
                'barang_id' => 23, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:27:40',
                'stok_jumlah' => '110',
            ],
            [
                'supplier_id' => 2,
                'barang_id' => 24, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:27:50',
                'stok_jumlah' => '150',
            ],

            [
                'supplier_id' => 3,
                'barang_id' => 25, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:28:20',
                'stok_jumlah' => '60',
            ],
            [
                'supplier_id' => 3,
                'barang_id' => 26, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:28:40',
                'stok_jumlah' => '80',
            ],
            [
                'supplier_id' => 3,
                'barang_id' => 27, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:28:10',
                'stok_jumlah' => '70',
            ],

            [
                'supplier_id' => 3,
                'barang_id' => 28, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:29:00',
                'stok_jumlah' => '50',
            ],
            [
                'supplier_id' => 3,
                'barang_id' => 29, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:29:15',
                'stok_jumlah' => '40',
            ],
            [
                'supplier_id' => 3,
                'barang_id' => 30, 
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11 11:29:20',
                'stok_jumlah' => '65',
            ],
        ];
        DB::table('t_stok')->insert($data);
    }
}
