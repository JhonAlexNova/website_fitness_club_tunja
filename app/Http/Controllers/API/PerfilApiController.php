<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\ClienteRepository;
use Auth;
use Storage;
use Hash;

class PerfilApiController extends Controller
{
    private $clienteRepository;
    

    public function __construct(ClienteRepository $clienteRepo)
    {
        $this->clienteRepository = $clienteRepo;
    }


    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = request()->user();

        return response()->json($user,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user(); // ← directo del modelo, sin repositorio

        $user->primer_nombre    = $request->primer_nombre;
        $user->segundo_nombre   = $request->segundo_nombre;
        $user->primer_apellido  = $request->primer_apellido;
        $user->segundo_apellido = $request->segundo_apellido;
        $user->celular          = $request->celular;
        $user->email            = $request->email;
        $user->documento        = $request->documento;

        // Avatar de la grilla
        if ($request->filled('avatar')) {
            $user->avatar = $request->avatar;
        }

        // Foto subida desde el dispositivo
        if ($request->hasFile('foto')) {
            $user->avatar = Storage::disk('public')->putFile('avatar', $request->file('foto'));
        }

        $user->save();

        return response()->json([
            'response' => 'Datos actualizados correctamente',
            'avatar'   => $user->avatar,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
