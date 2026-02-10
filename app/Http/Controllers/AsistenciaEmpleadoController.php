<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAsistenciaEmpleadoRequest;
use App\Http\Requests\UpdateAsistenciaEmpleadoRequest;
use App\Repositories\AsistenciaEmpleadoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use App\Repositories\EmpleadoRepository;

use Flash;
use Response;

class AsistenciaEmpleadoController extends AppBaseController
{
    /** @var AsistenciaEmpleadoRepository $asistenciaEmpleadoRepository*/
    private $asistenciaEmpleadoRepository;
    private $empleadoRepository;

    public function __construct(AsistenciaEmpleadoRepository $asistenciaEmpleadoRepo, EmpleadoRepository $empleadoRepo)
    {
        $this->asistenciaEmpleadoRepository = $asistenciaEmpleadoRepo;
        $this->empleadoRepository = $empleadoRepo;
    }




    /**
     * Display a listing of the AsistenciaEmpleado. 
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $asistenciaEmpleados = $this->asistenciaEmpleadoRepository->withRelations();

        $empleados = $this->empleadoRepository->withRelations();

        $backpack = [
            'empleados' => $empleados,
            'asistenciaEmpleados' => $asistenciaEmpleados
        ];


        return view('asistencia_empleados.index',$backpack);
    }

    /**
     * Show the form for creating a new AsistenciaEmpleado.
     *
     * @return Response
     */
    public function create()
    {
        return view('asistencia_empleados.create');
    }

    /**
     * Store a newly created AsistenciaEmpleado in storage.
     *
     * @param CreateAsistenciaEmpleadoRequest $request
     *
     * @return Response
     */
    public function store(CreateAsistenciaEmpleadoRequest $request)
    {
        $input = $request->all();

        $asistenciaEmpleado = $this->asistenciaEmpleadoRepository->create($input);

        Flash::success('Asistencia agregada correctamente.');

        return redirect(route('asistenciaEmpleados.index'));
    }

    /**
     * Display the specified AsistenciaEmpleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $asistenciaEmpleado = $this->asistenciaEmpleadoRepository->find($id);

        if (empty($asistenciaEmpleado)) {
            Flash::error('Asistencia ');

            return redirect(route('asistenciaEmpleados.index'));
        }

        return view('asistencia_empleados.show')->with('asistenciaEmpleado', $asistenciaEmpleado);
    }

    /**
     * Show the form for editing the specified AsistenciaEmpleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $asistenciaEmpleado = $this->asistenciaEmpleadoRepository->find($id);

        if (empty($asistenciaEmpleado)) {
            Flash::error('Asistencia Empleado not found');

            return redirect(route('asistenciaEmpleados.index'));
        }

        return view('asistencia_empleados.edit')->with('asistenciaEmpleado', $asistenciaEmpleado);
    }

    /**
     * Update the specified AsistenciaEmpleado in storage.
     *
     * @param int $id
     * @param UpdateAsistenciaEmpleadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAsistenciaEmpleadoRequest $request)
    {
        $asistenciaEmpleado = $this->asistenciaEmpleadoRepository->find($id);

        if (empty($asistenciaEmpleado)) {
            Flash::error('Asistencia Empleado not found');

            return redirect(route('asistenciaEmpleados.index'));
        }

        $asistenciaEmpleado = $this->asistenciaEmpleadoRepository->update($request->all(), $id);

        Flash::success('Asistencia Empleado updated successfully.');

        return redirect(route('asistenciaEmpleados.index'));
    }

    /**
     * Remove the specified AsistenciaEmpleado from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $asistenciaEmpleado = $this->asistenciaEmpleadoRepository->find($id);

        if (empty($asistenciaEmpleado)) {
            Flash::error('Asistencia Empleado not found');

            return redirect(route('asistenciaEmpleados.index'));
        }

        $this->asistenciaEmpleadoRepository->delete($id);

        Flash::success('Asistencia Empleado deleted successfully.');

        return redirect(route('asistenciaEmpleados.index'));
    }
}
