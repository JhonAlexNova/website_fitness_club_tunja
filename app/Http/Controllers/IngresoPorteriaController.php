<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIngresoPorteriaRequest;
use App\Http\Requests\UpdateIngresoPorteriaRequest;
use App\Repositories\IngresoPorteriaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class IngresoPorteriaController extends AppBaseController
{
    /** @var IngresoPorteriaRepository $ingresoPorteriaRepository*/
    private $ingresoPorteriaRepository;

    public function __construct(IngresoPorteriaRepository $ingresoPorteriaRepo)
    {
        $this->ingresoPorteriaRepository = $ingresoPorteriaRepo;
    }

    /**
     * Display a listing of the IngresoPorteria.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ingresoPorterias = $this->ingresoPorteriaRepository->all();

        return view('ingreso_porterias.index')
            ->with('ingresoPorterias', $ingresoPorterias);
    }


    public function ventas_porteria()
    {
        $ventas = $this->ingresoPorteriaRepository->withRelations();


        return view('ventas_porteria.index')
            ->with('ventas', $ventas);
    }

    

    /**
     * Show the form for creating a new IngresoPorteria.
     *
     * @return Response
     */
    public function create()
    {
        return view('ingreso_porterias.create');
    }

    /**
     * Store a newly created IngresoPorteria in storage.
     *
     * @param CreateIngresoPorteriaRequest $request
     *
     * @return Response
     */
    public function store(CreateIngresoPorteriaRequest $request)
    {
        $input = $request->all();

        $ingresoPorteria = $this->ingresoPorteriaRepository->create($input);

        Flash::success('Ingreso Porteria saved successfully.');

        return redirect(route('ingresoPorterias.index'));
    }

    /**
     * Display the specified IngresoPorteria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ingresoPorteria = $this->ingresoPorteriaRepository->find($id);

        if (empty($ingresoPorteria)) {
            Flash::error('Ingreso Porteria not found');

            return redirect(route('ingresoPorterias.index'));
        }

        return view('ingreso_porterias.show')->with('ingresoPorteria', $ingresoPorteria);
    }

    /**
     * Show the form for editing the specified IngresoPorteria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ingresoPorteria = $this->ingresoPorteriaRepository->find($id);

        if (empty($ingresoPorteria)) {
            Flash::error('Ingreso Porteria not found');

            return redirect(route('ingresoPorterias.index'));
        }

        return view('ingreso_porterias.edit')->with('ingresoPorteria', $ingresoPorteria);
    }

    /**
     * Update the specified IngresoPorteria in storage.
     *
     * @param int $id
     * @param UpdateIngresoPorteriaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIngresoPorteriaRequest $request)
    {
        $ingresoPorteria = $this->ingresoPorteriaRepository->find($id);

        if (empty($ingresoPorteria)) {
            Flash::error('Ingreso Porteria not found');

            return redirect(route('ingresoPorterias.index'));
        }

        $ingresoPorteria = $this->ingresoPorteriaRepository->update($request->all(), $id);

        Flash::success('Ingreso Porteria updated successfully.');

        return redirect(route('ingresoPorterias.index'));
    }

    /**
     * Remove the specified IngresoPorteria from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ingresoPorteria = $this->ingresoPorteriaRepository->find($id);

        if (empty($ingresoPorteria)) {
            Flash::error('Ingreso Porteria not found');

            return redirect(route('ingresoPorterias.index'));
        }

        $this->ingresoPorteriaRepository->delete($id);

        Flash::success('Ingreso Porteria deleted successfully.');

        return redirect(route('ingresoPorterias.index'));
    }
}
