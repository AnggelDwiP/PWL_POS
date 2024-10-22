<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\SupplierModel;
use App\Models\UserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list'  => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar Stok yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok';

        $supplier = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all();

        return view('stok.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'supplier' => $supplier,
            'barang' => $barang,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }
    public function list(Request $request){
        $stok = stokmodel::select('stok_id','supplier_id','barang_id','user_id','stok_tanggal','stok_jumlah')
        ->with(['supplier','barang','user']);

        if($request->supplier_id){
            $stok->where('supplier_id',$request->supplier_id);
        }elseif($request->barang_id){
            $stok->where('barang_id',$request->barang_id);
        }elseif($request->user_id){
            $stok->where('user_id',$request->user_id);
        }

        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) { 
                $btn  = '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) 
            ->make(true);
    }

    public function create_ajax()
    {
        $supplier = suppliermodel::all();
        $barang = barangmodel::all();
        $user = usermodel::all();
        $stok = stokmodel::all();

        return view('stok.create_ajax', 
        [
            'supplier' => $supplier,
            'barang'=>$barang,
            'user'=>$user,
            'stok'=>$stok
        ]);
    }

    public function store_ajax(Request $request){
        if ($request->ajax() || $request->wantsJson()){
            $rules = [
                'supplier_id'=>'required|integer',
                'barang_id'=>'required|integer',
                'stok_tanggal'=>'required|date',
                'stok_jumlah'=>'required|integer',
                'user_id'=>'required|integer',
            ];
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            stokmodel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data stok berhasil disimpan'
            ]);
        }
        redirect('/');
    }
    public function show_ajax(string $stok_id)
    {
        $supplier = suppliermodel::all();
        $barang = barangmodel::all();
        $user = barangmodel::all();
        $stok = stokmodel::find($stok_id);
        return view('stok.show_ajax', ['supplier' => $supplier, 'stok' => $stok,'barang'=>$barang,'user'=>$user],);

    }
    public function edit_ajax(string $stok_id){
        $supplier = suppliermodel::select('supplier_id','supplier_nama')->get();
        $stok = stokmodel::find($stok_id);
        $barang = barangmodel::select('barang_id','barang_nama')->get();
        $user = usermodel::select('user_id','nama')->get();

        return view('stok.edit_ajax',['supplier'=>$supplier,'stok'=>$stok,'barang'=>$barang,'user'=>$user]);
    }

    public function update_ajax(Request $request, $stok_id){
        if($request->ajax() || $request->wantsJson()){
            $rules = [
                'supplier_id'=>'required|integer',
                'barang_id'=>'required|integer',                
                'stok_tanggal'=>'required|date',
                'stok_jumlah'=>'required|integer',
                'user_id'=>'required|integer'
            ];
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return response()->json([
                    'status'   => false,    // respon json, true: berhasil, false: gagal
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }
            $check = stokmodel::find($stok_id);
            if($check){
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $stok_id){
        $supplier = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all();
        $stok = StokModel::find($stok_id);
        return view('stok.confirm_ajax', ['supplier' => $supplier, 'stok' => $stok,'barang'=>$barang,'user'=>$user],);
    }

    public function delete_ajax(Request $request, $stok_id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $stok = stokmodel::find($stok_id);

            if ($stok) {
                try {
                    $stok->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
    public function import()
    {
        return view('stok.import');  // Menampilkan halaman import stok
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_stok' => ['required', 'mimes:xlsx', 'max:1024'] // Validasi file
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_stok'); // Mengambil file dari request
            $reader = IOFactory::createReader('Xlsx'); // Load Excel reader
            $reader->setReadDataOnly(true); // Hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // Load file Excel
            $sheet = $spreadsheet->getActiveSheet(); // Ambil sheet aktif

            $data = $sheet->toArray(null, false, true, true); // Ubah data sheet menjadi array

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        // Convert Excel date to PHP DateTime object (if it's an Excel date format)
                        $stok_tanggal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value['D'])->format('Y-m-d H:i:s');

                        $insert[] = [
                            'supplier_id' => $value['A'],
                            'barang_id' => $value['B'],
                            'user_id' => $value['C'],
                            'stok_tanggal' => $stok_tanggal, // Menggunakan tanggal dari Excel
                            'stok_jumlah' => $value['E'],
                            'created_at' => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    // Masukkan data ke database, abaikan jika data sudah ada
                    stokmodel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }
    public function export_excel()
    {
        $stok = stokmodel::select('stok_id', 'supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with(['supplier', 'barang', 'user']) 
            ->orderBy('stok_tanggal')
            ->get();

        // Load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); 

        // Set header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Tanggal Stok');
        $sheet->setCellValue('C1', 'Supplier ID');
        $sheet->setCellValue('D1', 'Barang ID');
        $sheet->setCellValue('E1', 'Jumlah Stok');
        $sheet->setCellValue('F1', 'User ID');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true); 
        $no = 1; 
        $baris = 2; 

        foreach ($stok as $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->stok_tanggal);
            $sheet->setCellValue('C' . $baris, $value->supplier->supplier_nama);
            $sheet->setCellValue('D' . $baris, $value->barang->barang_nama);
            $sheet->setCellValue('E' . $baris, $value->stok_jumlah); 
            $sheet->setCellValue('F' . $baris, $value->user->nama);
            $baris++;
            $no++;
        }

        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Stok'); 

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Stok ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }
    public function export_pdf()
    {
        $stok = stokmodel::select('stok_id', 'supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with(['supplier', 'barang', 'user']) 
            ->orderBy('stok_tanggal')
            ->get();

        $pdf = Pdf::loadView('stok.export_pdf', ['stok' => $stok]);

        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption("isRemoteEnabled", true); 
        $pdf->render();

        return $pdf->stream('Data Stok ' . date('Y-m-d H:i:s') . '.pdf');
    }

}
