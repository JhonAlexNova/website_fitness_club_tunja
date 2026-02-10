<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBaseEmpleadoRequest;
use App\Http\Requests\UpdateBaseEmpleadoRequest;

use App\Repositories\BaseEmpleadoRepository;
use App\Repositories\EmpleadoRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BaseEmpleadoController extends AppBaseController
{
    /** @var BaseEmpleadoRepository $baseEmpleadoRepository*/
    private $baseEmpleadoRepository;
    private $empleadoRepository;

    public function __construct(BaseEmpleadoRepository $baseEmpleadoRepo,
    EmpleadoRepository $empleadoRepo
    )
    {
        $this->baseEmpleadoRepository = $baseEmpleadoRepo;
        $this->empleadoRepository = $empleadoRepo;
    }

    /**
     * Display a listing of the BaseEmpleado.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $baseEmpleados = $this->baseEmpleadoRepository->withRelations();

      //  dd($baseEmpleados);

        return view('base_empleados.index')
            ->with('baseEmpleados', $baseEmpleados);
    }

    /**
     * Show the form for creating a new BaseEmpleado.
     *
     * @return Response
     */
    public function create()
    {
        $empleados = $this->empleadoRepository->withRelations();

        $backpack = [
            'empleados' => $empleados
        ];

        

        return view('base_empleados.create', $backpack);
    }

    /**
     * Store a newly created BaseEmpleado in storage.
     *
     * @param CreateBaseEmpleadoRequest $request
     *
     * @return Response
     */
    public function store(CreateBaseEmpleadoRequest $request)
    {
        $input = $request->all();

        $baseEmpleado = $this->baseEmpleadoRepository->create($input);

        Flash::success('Base Empleado saved successfully.');

        return redirect(route('baseEmpleados.index'));
    }

    /**
     * Display the specified BaseEmpleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $baseEmpleado = $this->baseEmpleadoRepository->find($id);

        if (empty($baseEmpleado)) {
            Flash::error('Base Empleado not found');

            return redirect(route('baseEmpleados.index'));
        }

        return view('base_empleados.show')->with('baseEmpleado', $baseEmpleado);
    }

    /**
     * Show the form for editing the specified BaseEmpleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $baseEmpleado = $this->baseEmpleadoRepository->find($id);

        if (empty($baseEmpleado)) {
            Flash::error('Base Empleado not found');

            return redirect(route('baseEmpleados.index'));
        }

        return view('base_empleados.edit')->with('baseEmpleado', $baseEmpleado);
    }

    /**
     * Update the specified BaseEmpleado in storage.
     *
     * @param int $id
     * @param UpdateBaseEmpleadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBaseEmpleadoRequest $request)
    {
        $baseEmpleado = $this->baseEmpleadoRepository->find($id);

        if (empty($baseEmpleado)) {
            Flash::error('Base Empleado not found');

            return redirect(route('baseEmpleados.index'));
        }

        $baseEmpleado = $this->baseEmpleadoRepository->update($request->all(), $id);

        Flash::success('Base Empleado updated successfully.');

        return redirect(route('baseEmpleados.index'));
    }

    /**
     * Remove the specified BaseEmpleado from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $baseEmpleado = $this->baseEmpleadoRepository->find($id);

        if (empty($baseEmpleado)) {
            Flash::error('Base Empleado not found');

            return redirect(route('baseEmpleados.index'));
        }

        $this->baseEmpleadoRepository->delete($id);

        Flash::success('Base Empleado deleted successfully.');

        return redirect(route('baseEmpleados.index'));
    }
}
