<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller 
{ 
    public function login() 
    { 
        if(Auth::check()){ // jika sudah login, maka redirect ke halaman home 
            return redirect('/'); 
        } 
        return view('auth.login'); 
    } 
 
    public function postlogin(Request $request) 
    { 
        if($request->ajax() || $request->wantsJson()){ 
            $credentials = $request->only('username', 'password'); 
 
            if (Auth::attempt($credentials)) { 
                return response()->json([ 
                    'status' => true, 
                    'message' => 'Login Berhasil', 
                    'redirect' => url('/') 
                ]); 
            } 
             
            return response()->json([ 
                'status' => false, 
                'message' => 'Login Gagal' 
            ]); 
        } 
 
        return redirect('login'); 
    } 
    public function register() 
    { 
        $level = LevelModel::all();

        return view('auth.register', compact('level')); 
    } 
    public function postregister(Request $request)
    {
        // Cek apakah request berupa Ajax atau JSON
        if($request->ajax() || $request->wantsJson()) {

            // Aturan validasi
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6|confirmed' 
            ];

            // Validasi input
            $validator = Validator::make($request->all(), $rules);

            // Jika validasi gagal, kirim response dengan error
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            // Jika validasi berhasil, simpan data ke database
            UserModel::create([
                'level_id' => $request->level_id,
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => Hash::make($request->password), // Enkripsi password
            ]);

            // Kirim response success dan arahkan ke login
            return response()->json([
                'status' => true,
                'message' => 'Registrasi Berhasil, Silahkan Login!',
                'redirect' => url('login') 
            ]);
        }

        return redirect('register');
    }
    public function logout(Request $request) 
    { 
        Auth::logout(); 
 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();     
        return redirect('login'); 
    } 
} 