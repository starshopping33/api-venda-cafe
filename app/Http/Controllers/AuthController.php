<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCadastro;
use App\Http\Requests\RequestLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RequestCadastro $request)
    {
        $validando = $request->all();

        $user = new User();
        $user->name = $validando['nome_de_usuario'];
        $user->email = $validando['email'];
        $user->password = Hash::make($validando['password']);
        $user->save();
        
        return response()->json([
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => $user
        ], 201);
    }

    public function login(RequestLogin $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        
        $token = $user->createToken('token_app')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso!'
        ]);
    }
}
