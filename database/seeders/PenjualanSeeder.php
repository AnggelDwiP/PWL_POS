<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1, 
                'penjualan_kode' => 'PJ01',
                'pembeli' => 'John Doe',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 2, 
                'penjualan_kode' => 'PJ02',
                'pembeli' => 'Jane Smith',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 3, 
                'penjualan_kode' => 'PJ03',
                'pembeli' => 'Alice Johnson',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 1, 
                'penjualan_kode' => 'PJ04',
                'pembeli' => 'Bob Williams',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 2, 
                'penjualan_kode' => 'PJ05',
                'pembeli' => 'Eva Brown',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 3, 
                'penjualan_kode' => 'PJ06',
                'pembeli' => 'David Davis',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 1, 
                'penjualan_kode' => 'PJ07',
                'pembeli' => 'Grace Garcia',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 2, 
                'penjualan_kode' => 'PJ08',
                'pembeli' => 'Henry Harris',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 3, 
                'penjualan_kode' => 'PJL009',
                'pembeli' => 'Ivy Ingram',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 1, 
                'penjualan_kode' => 'PJL010',
                'pembeli' => 'Jack Jackson',
                'penjualan_tanggal' => Carbon::now(),
            ],
        ];
        
        DB::table('t_penjualan')->insert($data);
    }
}
