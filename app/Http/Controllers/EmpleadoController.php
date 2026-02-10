<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Repositories\EmpleadoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Storage;

use Hash;

use App\Models\TipoUsuario;
use DB;

class EmpleadoController extends AppBaseController
{
    /** @var EmpleadoRepository $empleadoRepository*/
    private $empleadoRepository;

    public function __construct(EmpleadoRepository $empleadoRepo)
    {
        $this->empleadoRepository = $empleadoRepo;
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
        $empleados = $this->empleadoRepository->withRelations();

        return view('empleados.index')
            ->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new Empleado.
     *
     * @return Response
     */
    public function create()
    {
        return view('empleados.create');
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

            $empleado =  $this->empleadoRepository->all()->where('email',$request->email)->last();


            
            if(!is_null($empleado)){
               // Flash::error('Este correo esta siendo usado en otra cuenta');
               // return redirect()->back();
            }
            
            $empleado = $this->empleadoRepository->create($input);

            TipoUsuario::create([
                'rol_id' => 3,
                'user_id' => $empleado->id
            ]);
    
            Flash::success('Empleado creado correctamente.');

            DB::commit();
        } catch (\Exception  $e) {
            DB::rollback();
            Flash::error('Ocurrio un error al crear el empleado');
            dd('A ocurrido un error al crear el empleado.');
        }

       

        return redirect(route('empleados.index'));
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
        $empleado = $this->empleadoRepository->find($id);

        if (empty($empleado)) {
            Flash::error('Empleado not found');

            return redirect(route('empleados.index'));
        }

        return view('empleados.show')->with('empleado', $empleado);
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
        $empleado = $this->empleadoRepository->find($id);

        if (empty($empleado)) {
            Flash::error('Empleado not found');

            return redirect(route('empleados.index'));
        }

        return view('empleados.edit')->with('empleado', $empleado);
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
        $empleado = $this->empleadoRepository->find($id);

        if (empty($empleado)) {
            Flash::error('Empleado not found');

            return redirect(route('empleados.index'));
        }

        if($request->file('file')){
            $request['foto_perfil'] = Storage::disk('uploads')->putFile('avatar',$request->file);            
        }

        DB::beginTransaction();
 
        try {
            $request['password'] = Hash::make($request->documento);
            $empleado = $this->empleadoRepository->update($request->all(), $id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            //throw $th;
        }

        

        Flash::success('Empleado updated successfully.');

        return redirect(route('empleados.index'));
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
        $empleado = $this->empleadoRepository->find($id);

        if (empty($empleado)) {
            Flash::error('Empleado not found');

            return redirect(route('empleados.index'));
        }

        $this->empleadoRepository->delete($id);

        Flash::success('Empleado deleted successfully.');

        return redirect(route('empleados.index'));
    }
}
