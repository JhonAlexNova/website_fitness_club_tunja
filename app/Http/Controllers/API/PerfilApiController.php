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
        $cliente = $this->clienteRepository->find(request()->user()->id);

        

        $cliente->primer_nombre = $request->primer_nombre;
        $cliente->segundo_nombre = $request->segundo_nombre;
        $cliente->primer_apellido = $request->primer_apellido;
        $cliente->segundo_apellido = $request->segundo_apellido;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->documento = $request->documento;
        $cliente->save();

        return response()->json(["response"=>"Datos actualizados correctamente"]);


        if($request->new_password){
            // Validaciones
            $request->validate([
                'current_password' => ['required'],
                'new_password' => ['required', 'string', 'min:8', 'confirmed'], // Debe coincidir con new_password_confirmation
            ]);

            $cliente = $this->clienteRepository->find(Auth::user()->id);

            // Verificar que la contraseña actual sea correcta
            if (!Hash::check($request->current_password, $cliente->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'La contraseña actual no es correcta.',
                ]);
            }

            // Actualizar la contraseña
            $cliente->password = Hash::make($request->new_password);
            $this->clienteRepository->update(['password' => $cliente->password], $cliente->id);

            Flash::success('Contraseña actualizada correctamente');
            return redirect()->back();
        }

        if($request->file("file_foto_perfil")){
            $request["foto_perfil"] = Storage::disk("public")->putFile("avatar",$request->file("file_foto_perfil"));

           // dd($request->file_foto_perfil,$request->all());
        }

        //dd($cliente);

        
        $cliente = $this->clienteRepository->update($request->all(), request()->user()->id);
        return $request->all();

        
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
