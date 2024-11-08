<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::with('kategori')->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'required|string|min:3',
            'barang_nama' => 'required|string|max:100',
            'harga_beli'  => 'required|integer',
            'harga_jual'  => 'required|integer',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $image = $request->file('image');
        $image->store('images', 'public'); 

        $barang = BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli'  => $request->harga_beli,
            'harga_jual'  => $request->harga_jual,
            'image'       => $image->hashName(), 
            'kategori_id' => $request->kategori_id,
        ]);

        if ($barang) {
            return response()->json($barang->load('kategori'), 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data gagal disimpan'
        ], 409);
    }

    public function show(BarangModel $barang)
    {
        return response()->json($barang->load('kategori'));
    }

    public function update(Request $request, BarangModel $barang)
    {
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'sometimes|string|min:3|unique:m_barang,barang_kode,' . $barang->id . ',barang_id',
            'barang_nama' => 'sometimes|string|max:100',
            'harga_beli'  => 'sometimes|integer',
            'harga_jual'  => 'sometimes|integer',
            'image'       => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'sometimes|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id']);

        if ($request->hasFile('image')) {
            if ($barang->image) {
                Storage::disk('public')->delete('images/' . $barang->image);
            }

            $image = $request->file('image');
            $image->store('images', 'public');
            $data['image'] = $image->hashName();
        }

        $barang->update($data);

        return response()->json($barang->load('kategori'));
    }

    public function destroy(BarangModel $barang)
    {
        if ($barang->image) {
            Storage::disk('public')->delete('images/' . $barang->image);
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
    }
}
