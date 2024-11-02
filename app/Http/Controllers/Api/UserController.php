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
        // Load all users along with their level relationship
        return UserModel::with('level')->get();
    }
    
    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100',                     
            'password' => 'required|min:5',                            
            'level_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create user
        $user = UserModel::create($request->all());
        
        return response()->json($user->load('level'), 201);
    }

    public function show(UserModel $user)
    {
        // Load level relationship for the user
        return response()->json($user->load('level'));
    }

    public function update(Request $request, UserModel $user)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|string|min:3|max:20|unique:m_user,username,' . $user->id . ',user_id',
            'nama'     => 'sometimes|string|max:100',
            'password' => 'sometimes|string|min:5', 
            'level_id' => 'sometimes|integer', 
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Prepare data for update
        $data = $request->only(['username', 'nama', 'password', 'level_id']);
    
        // Only update password if it is provided
        if (!empty($data['password'])) {
            // Encrypt the password if it's being updated
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
