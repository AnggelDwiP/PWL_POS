<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        // Load all barang along with their kategori relationship
        return BarangModel::with('kategori')->get();
    }
    
    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'required|string|min:3',
            'barang_nama' => 'required|string|max:100',
            'harga_beli'  => 'required|integer',
            'harga_jual'  => 'required|integer',
            'kategori_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create barang
        $barang = BarangModel::create($request->all());
        
        return response()->json($barang->load('kategori'), 201);
    }

    public function show(BarangModel $barang)
    {
        // Load kategori relationship for the barang
        return response()->json($barang->load('kategori'));
    }

    public function update(Request $request, BarangModel $barang)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'sometimes|string|min:3|unique:m_barang,barang_kode,' . $barang->id . ',barang_id',
            'barang_nama' => 'sometimes|string|max:100',
            'harga_beli'  => 'sometimes|integer',
            'harga_jual'  => 'sometimes|integer',
            'kategori_id' => 'sometimes|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Prepare data for update
        $data = $request->only(['barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id']);
    
        $barang->update($data);
    
        return response()->json($barang->load('kategori'));
    }

    public function destroy(BarangModel $barang)
    {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
    }
}
