<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // GET /api/profile
    public function getProfile(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'primer_nombre'    => $user->primer_nombre,
            'segundo_nombre'   => $user->segundo_nombre,
            'primer_apellido'  => $user->primer_apellido,
            'segundo_apellido' => $user->segundo_apellido,
            'celular'          => $user->celular,
            'email'            => $user->email,
            'documento'        => $user->documento,
            'foto_perfil'      => $user->foto_perfil, // ← un solo campo para todo
        ]);
    }

    // POST /api/profile
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'primer_nombre'    => 'sometimes|string|max:100',
            'segundo_nombre'   => 'nullable|string|max:100',
            'primer_apellido'  => 'sometimes|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'celular'          => 'sometimes|string|max:20',
            'email'            => 'sometimes|email|unique:users,email,' . $user->id,
            'documento'        => 'sometimes|string|max:20',
            'avatar'           => 'nullable|string',
            'foto'             => 'nullable|image|max:4096',
        ]);

        $user->fill($request->only([
            'primer_nombre',
            'segundo_nombre',
            'primer_apellido',
            'segundo_apellido',
            'celular',
            'email',
            'documento',
        ]));

        // Si elige avatar de la grilla → guardar la ruta local directamente
        if ($request->filled('avatar')) {
            $user->foto_perfil = $request->avatar; // ej: "assets/avatars/a3.png"
        }

        // Si sube una foto desde el dispositivo → guardar en storage
        if ($request->hasFile('foto')) {
            // Eliminar foto anterior solo si era una foto subida (no un avatar local)
            if ($user->foto_perfil && !str_starts_with($user->foto_perfil, 'assets/')) {
                Storage::disk('public')->delete($user->foto_perfil);
            }

            $path = $request->file('foto')->store('fotos', 'public');
            $user->foto_perfil = $path; // ej: "fotos/abc123.jpg"
        }

        $user->save();

        return response()->json([
            'message'     => 'Perfil actualizado correctamente',
            'foto_perfil' => $user->foto_perfil,
        ]);
    }
}