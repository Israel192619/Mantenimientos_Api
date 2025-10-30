<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register() {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'rol' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $role = Role::where('nombre_rol', request()->rol)->first();

        if (!$role) {
            return response()->json(['mensaje' => 'Rol no encontrado'], 404);
        }

        $user = new User;
        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user->role_id = $role->id;
        $user->save();

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        // Crear token
        //$token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            //'token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        //$user->currentAccessToken()->delete();
        //$user->tokens()->delete();

        return response()->json(['message' => 'Logout exitoso'], 200);
    }
}
