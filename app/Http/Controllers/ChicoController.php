<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChicoRequest;
use App\Http\Requests\UpdateChicoRequest;

use App\Repositories\ChicoRepository;
use App\Repositories\EmpleadoRepository;
use App\Repositories\CierreDiaRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Cierre;

use App\Models\Configuracion;

class ChicoController extends AppBaseController
{
    /** @var ChicoRepository $chicoRepository*/
    private $chicoRepository;
    private $empleadoRepository;
    private $cierreDiaRepository;

    public function __construct(
        ChicoRepository $chicoRepo,
        EmpleadoRepository $empleadoRepo,
        CierreDiaRepository $cierreDiaRepo
    )
    {
        $this->chicoRepository = $chicoRepo;
        $this->empleadoRepository = $empleadoRepo;
        $this->cierreDiaRepository = $cierreDiaRepo;
    }

    /**
     * Display a listing of the Chico.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $chicos = $this->chicoRepository->withRelations();
        

        return view('chicos.index')
            ->with('chicos', $chicos);
    }

    /**
     * Show the form for creating a new Chico.
     *
     * @return Response
     */
    public function create()
    {
        $empleados = $this->empleadoRepository->withRelations();
        $configuracion = Configuracion::get()->last();

        $backpack = [
            'empleados' => $empleados,
            'configuracion' => $configuracion
        ];

        return view('chicos.create',$backpack);
    }

    /**
     * Store a newly created Chico in storage.
     *
     * @param CreateChicoRequest $request
     *
     * @return Response
     */
    public function store(CreateChicoRequest $request)
    {
        $input = $request->all();
        $cierre =  $this->cierreDiaRepository->validar_dia();

        $input['cierre_id'] = $cierre->id;
        $input['valor'] = str_replace(array(',','.'),'',$request->valor);


        $chico = $this->chicoRepository->create($input);
        Flash::success('Registro creado correctamente.');

        return redirect(route('chicos.index'));
    }

    /**
     * Display the specified Chico.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $chico = $this->chicoRepository->find($id);

        if (empty($chico)) {
            Flash::error('Chico not found');

            return redirect(route('chicos.index'));
        }

        return view('chicos.show')->with('chico', $chico);
    }

    /**
     * Show the form for editing the specified Chico.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $chico = $this->chicoRepository->find($id);

        if (empty($chico)) {
            Flash::error('Chico not found');

            return redirect(route('chicos.index'));
        }

        return view('chicos.edit')->with('chico', $chico);
    }

    /**
     * Update the specified Chico in storage.
     *
     * @param int $id
     * @param UpdateChicoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChicoRequest $request)
    {
        $chico = $this->chicoRepository->find($id);

        if (empty($chico)) {
            Flash::error('Chico not found');

            return redirect(route('chicos.index'));
        }

        $chico = $this->chicoRepository->update($request->all(), $id);

        Flash::success('Chico updated successfully.');

        return redirect(route('chicos.index'));
    }

    /**
     * Remove the specified Chico from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $chico = $this->chicoRepository->find($id);

        if (empty($chico)) {
            Flash::error('Chico not found');

            return redirect(route('chicos.index'));
        }

        $this->chicoRepository->delete($id);

        Flash::success('Chico deleted successfully.');

        return redirect(route('chicos.index'));
    }
}
