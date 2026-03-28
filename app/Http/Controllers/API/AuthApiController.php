<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales incorrectas.'],
            ]);
        }

        $membresiaActiva = $user->membresiaActiva()->with('membresia')->first();

        return response()->json([
            'token'     => $user->createToken('auth_token')->plainTextToken,
            'user'      => $user,
            'membresia' => $membresiaActiva ? $membresiaActiva->membresia->nombre : null
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'primer_nombre' => 'required|string',
            'segundo_nombre' => 'required|string',
            'primer_apellido' => 'required|string',
            'segundo_apellido' => 'required|string',
            'celular' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'documento' => 'required|string',
            'password' => 'required|min:6',
            'avatar' => 'required',
            'objetivos' => 'required|array',
            'ppm_max' => 'nullable|numeric',
            'ppm_min' => 'nullable|numeric'
        ]);

        $user = User::create([
            'name' => $data['primer_nombre'].' '.$data['primer_apellido'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => $data['avatar'],
            'celular' => $data['celular'],
            'documento' => $data['documento']
        ]);

        Perfil::create([
            'user_id' => $user->id,
            'primer_nombre' => $data['primer_nombre'],
            'segundo_nombre' => $data['segundo_nombre'],
            'primer_apellido' => $data['primer_apellido'],
            'segundo_apellido' => $data['segundo_apellido'],
            'ppm_max' => $data['ppm_max'],
            'ppm_min' => $data['ppm_min'],
            'objetivos' => json_encode($data['objetivos'])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);
    }
}