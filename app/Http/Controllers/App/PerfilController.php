<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Repositories\ClienteRepository;
use Auth;
use Storage;
use Flash;
use Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepo)
    {
        $this->clienteRepository = $clienteRepo;
    }


    public function index()
    {
        return view("app.profile.index");
    }

    public function editar_perfil(){
        return view("app.profile.editar-perfil");
    }

    public function editar_contrasena(){
        return view("app.profile.cambiar-password");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        
        $cliente = $this->clienteRepository->find(Auth::user()->id);


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

        $cliente = $this->clienteRepository->update($request->all(), $id);

    

        Flash::success('Datos actualizados correctamente');

        return redirect()->back();

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
