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
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Store the image and get the file name
        $image = $request->file('image');
        $image->store('images', 'public'); // Store in 'images' folder on 'public' disk

        // Create barang with image path
        $barang = BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli'  => $request->harga_beli,
            'harga_jual'  => $request->harga_jual,
            'image'       => $image->hashName(), // Save only the file name
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
            'image'       => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'sometimes|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Prepare data for update
        $data = $request->only(['barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id']);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($barang->image) {
                Storage::disk('public')->delete('images/' . $barang->image);
            }

            // Store new image and update data with the new image path
            $image = $request->file('image');
            $image->store('images', 'public');
            $data['image'] = $image->hashName();
        }

        // Update barang with new data
        $barang->update($data);

        return response()->json($barang->load('kategori'));
    }

    public function destroy(BarangModel $barang)
    {
        // Delete image if exists
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
