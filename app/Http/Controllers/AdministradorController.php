<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Repositories\AdministradorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Storage;

use Hash;

use App\Models\TipoUsuario;
use DB;

class AdministradorController extends AppBaseController
{
    /** @var AdministradorRepository $AdministradorRepository*/
    private $AdministradorRepository;

    public function __construct(AdministradorRepository $administradorRepo)
    {
        $this->AdministradorRepository = $administradorRepo;
    }

    /**
     * Display a listing of the Empleado.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
       $administradores = $this->AdministradorRepository->withRelations();

        return view('administradores.index')
            ->with('administradores',$administradores);
    }

    /**
     * Show the form for creating a new Empleado.
     *
     * @return Response
     */
    public function create()
    {
        return view('administradores.create');
    }

    /**
     * Store a newly created Empleado in storage.
     *
     * @param CreateEmpleadoRequest $request
     *
     * @return Response
     */
    public function store(CreateEmpleadoRequest $request)
    {
        $input = $request->all();

        if($request->file('file')){
            $input['foto_perfil'] = Storage::disk('uploads')->putFile('avatar',$request->file);            
        }

        DB::beginTransaction();

        try {

            $input['password'] = Hash::make($request->documento);

            $usuario =  $this->AdministradorRepository->all()->where('email',$request->email)->last();


            
            if(!is_null($usuario)){
               // Flash::error('Este correo esta siendo usado en otra cuenta');
               // return redirect()->back();
            }
            
            $usuario = $this->AdministradorRepository->create($input);

            TipoUsuario::create([
                'rol_id' => 2,
                'user_id' => $usuario->id
            ]);
    
            Flash::success('Administrador creado correctamente.');

            DB::commit();
        } catch (\Exception  $e) {
            DB::rollback();
            Flash::error('Ocurrio un error al crear el empleado');
            dd('A ocurrido un error al crear el empleado.');
        }

       

        return redirect(route('administradores.index'));
    }

    /**
     * Display the specified Empleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $administrador = $this->AdministradorRepository->find($id);

        if (empty($administrador)) {
            Flash::error('Empleado not found');

            return redirect(route('administradores.index'));
        }

        return view('administradores.show')->with('empleado', $administrador);
    }

    /**
     * Show the form for editing the specified Empleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $administrador = $this->AdministradorRepository->find($id);

        if (empty($administrador)) {
            Flash::error('Empleado not found');

            return redirect(route('administradores.index'));
        }

        return view('administradores.edit')->with('administrador', $administrador);
    }

    /**
     * Update the specified Empleado in storage.
     *
     * @param int $id
     * @param UpdateEmpleadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmpleadoRequest $request)
    {
        $administrador = $this->AdministradorRepository->find($id);

        if (empty($administrador)) {
            Flash::error('Empleado not found');

            return redirect(route('administradores.index'));
        }

        if($request->file('file')){
            $request['foto_perfil'] = Storage::disk('uploads')->putFile('avatar',$request->file);            
        }

        DB::beginTransaction();
 
        try {
            $administrador = $this->AdministradorRepository->update($request->all(), $id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            //throw $th;
        }

        

        Flash::success('Administrador actualizado correctamente.');

        return redirect(route('administradores.index'));
    }

    /**
     * Remove the specified Empleado from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $administrador = $this->AdministradorRepository->find($id);

        if (empty($administrador)) {
            Flash::error('Empleado not found');

            return redirect(route('administradores.index'));
        }

        $this->AdministradorRepository->delete($id);

        Flash::success('Empleado eliminado correctamente.');

        return redirect(route('administradores.index'));
    }
}
