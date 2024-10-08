<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list'  => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }
    public function list(Request $request) 
    { 
        $barang = barangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id') 
                    ->with('kategori'); 

        if ($request->kategori_id){
            $barang->where('kategori_id', $request->kategori_id);
        }
    
        return DataTables::of($barang) 
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addIndexColumn()  
            ->addColumn('aksi', function ($barang) {  // menambahkan kolom aksi 
                $btn  = '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> '; 
                $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> '; 
                $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/delete_ajax').'\')"  class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn; 
            }) 
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true); 
    } 
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah barang',
            'list'  => ['Home', 'barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang Baru'
        ];

        $kategori = kategoriModel::all();
        $activeMenu = 'barang';

        return view('barang.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'kategori' => $kategori, 
            'activeMenu' => $activeMenu
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|min:3', 
            'barang_nama' => 'required|string|max:100',                    
            'harga_beli'  => 'required|integer',      
            'harga_jual'  => 'required|integer',                         
            'kategori_id' => 'required|integer',                       
        ]);

        barangModel::create([
            'barang_kode'  => $request->barang_kode,
            'barang_nama'  => $request->barang_nama,
            'harga_beli'   => $request->harga_beli,
            'harga_jual'   => $request->harga_jual,
            'kategori_id'  => $request->kategori_id,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }
    public function show(string $id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail barang',
            'list'  => ['Home', 'barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'barang' => $barang, 
            'activeMenu' => $activeMenu
        ]);
    }
    public function edit(string $id)
    {
        $barang = barangModel::find($id);
        $kategori = kategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit barang',
            'list' => ['Home', 'barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit barang'
        ];

        $activeMenu = 'barang';

        return view('barang.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|min:3', 
            'barang_nama' => 'required|string|max:100',                    
            'harga_beli'  => 'required|integer',      
            'harga_jual'  => 'required|integer',                         
            'kategori_id' => 'required|integer',  
        ]);

        barangModel::find($id)->update([
            'barang_kode'  => $request->barang_kode,
            'barang_nama'  => $request->barang_nama,
            'harga_beli'   => $request->harga_beli,
            'harga_jual'   => $request->harga_jual,
            'kategori_id'  => $request->kategori_id,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }
    public function destroy (string  $id)
    {
        $check = barangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak Ditemukan');
        } 
        
        try{
            barangModel::destroy($id);

            return redirect('/barang')->with('success', 'Data barang Berhasil dihapus');
        } catch (\Illuminate\Database\QueryException){
            return redirect('/barang')->with('error', 'Data barang Gagal dihapus karena terdapat Tabel lain yang terkait dengan data ini');
        }
    }
    public function create_ajax()
    {
        $kategori = kategoriModel::select('kategori_id', 'kategori_nama')->get();

        return view('barang.create_ajax')
        ->with('kategori', $kategori);
    }
    public function store_ajax(Request $request) {
        // Cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_kode' => 'required|string|min:3', 
                'barang_nama' => 'required|string|max:100',                    
                'harga_beli'  => 'required|integer',      
                'harga_jual'  => 'required|integer',                         
                'kategori_id' => 'required|integer',    
            ];
    
            // Menggunakan Validator dari Illuminate\Support\Facades\Validator
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }
    
            barangModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data barang berhasil disimpan'
            ]);
        }
    
        redirect('/');
    }
    public function show_ajax(string $id)
    {
        $barang = barangModel::find($id);

        return view('barang.show_ajax', ['barang' => $barang]);
    }
    public function edit_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = kategoriModel::select('kategori_id', 'kategori_nama')->get();

        return view('barang.edit_ajax', ['barang' => $barang, 'kategori' => $kategori]);
    }
    public function update_ajax(Request $request, $id)
    { 
        if ($request->ajax() || $request->wantsJson()) 
        { 
            $rules = [ 
                'barang_kode' => 'required|string|min:3', 
                'barang_nama' => 'required|string|max:100',                    
                'harga_beli'  => 'required|integer',      
                'harga_jual'  => 'required|integer',                         
                'kategori_id' => 'required|integer',    
            ];

            $validator = Validator::make($request->all(), $rules); 
    
            if ($validator->fails()) { 
                return response()->json([ 
                    'status'   => false,    // respon json, true: berhasil, false: gagal 
                    'message'  => 'Validasi gagal.', 
                    'msgField' => $validator->errors()  // menunjukkan field mana yang error 
                ]); 
            } 
        
            $check = barangModel::find($id); 
            if ($check) { 
                if(!$request->filled('password') ){ 
                    $request->request->remove('password'); 
                } 
                    
                $check->update($request->all()); 
                return response()->json([ 
                    'status'  => true, 
                    'message' => 'Data berhasil diupdate' 
                ]); 
            } else{ 
                return response()->json([ 
                    'status'  => false, 
                    'message' => 'Data tidak ditemukan' 
                ]); 
            } 
        } 
        return redirect('/'); 
    }
    public function confirm_ajax(string $id)
    {
        $barang = barangModel::find($id);

        return view('barang.confirm_ajax', ['barang' => $barang]);
    }
    public function delete_ajax(Request $request, $id) 
    {
        if($request->ajax() || $request->wantsJson()) {
            $barang = barangModel::find($id);

            if ($barang) {
                $barang->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        } else {
            return redirect('/');
        }
    }
}