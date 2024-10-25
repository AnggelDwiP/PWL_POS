<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\SupplierModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        $totalUser = UserModel::count();
        $totalPenjualan = PenjualanModel::count();
        $totalBarang = BarangModel::count();
        $totalSupplier = SupplierModel::count();

        return view('welcome', compact('totalUser', 'totalPenjualan', 'totalBarang', 'totalSupplier'), ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
