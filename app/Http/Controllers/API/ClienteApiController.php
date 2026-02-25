<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClienteApiController extends Controller
{
    /** @var ClienteRepository */
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * Crear cliente desde API.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_inscripcion' => 'nullable|date',
            'talla' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'perimetro_abdominal' => 'nullable|numeric',
            'porcentaje_grasa' => 'nullable|numeric',
            'porcentaje_musculo' => 'nullable|numeric',
            'observaciones' => 'nullable|string',
            'tipo' => 'nullable|string|max:255',
            'foto_perfil' => 'nullable|string|max:255',
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users', 'username')],
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'celular' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'documento' => ['required', 'string', 'max:255', Rule::unique('users', 'documento')],
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|min:8|max:255',
            'remember_token' => 'nullable|string|max:100',
        ]);

        $validated['tipo'] = 'Cliente';
        $validated['estado'] = $validated['estado'] ?? 'Activo';

        if ($request->hasFile('foto_perfil')) {
            $validated['foto_perfil'] = Storage::disk('public')->putFile('avatar/cliente', $request->file('foto_perfil'));
        }

        $validated['password'] = Hash::make($validated['password']);

        $cliente = $this->clienteRepository->create($validated);
        $cliente->makeHidden(['password', 'remember_token']);

        return response()->json([
            'message' => 'Cliente creado correctamente',
            'data' => $cliente,
        ], 201);
    }
}
