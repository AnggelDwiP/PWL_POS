<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return UserModel::with('level')->get();
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100',                     
            'password' => 'required|min:5',                            
            'level_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = UserModel::create($request->all());
        
        return response()->json($user->load('level'), 201);
    }

    public function show(UserModel $user)
    {
        return response()->json($user->load('level'));
    }

    public function update(Request $request, UserModel $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|string|min:3|max:20|unique:m_user,username,' . $user->id . ',user_id',
            'nama'     => 'sometimes|string|max:100',
            'password' => 'sometimes|string|min:5', 
            'level_id' => 'sometimes|integer', 
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['username', 'nama', 'password', 'level_id']);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
    
        $user->update($data);
    
        return response()->json($user->load('level'));
    }

    public function destroy(UserModel $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
    }
}
