<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCaracteristicaRequest;
use App\Http\Requests\UpdateCaracteristicaRequest;
use App\Repositories\CaracteristicaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CaracteristicaController extends AppBaseController
{
    /** @var CaracteristicaRepository $caracteristicaRepository*/
    private $caracteristicaRepository;

    public function __construct(CaracteristicaRepository $caracteristicaRepo)
    {
        $this->caracteristicaRepository = $caracteristicaRepo;
    }

    /**
     * Display a listing of the Caracteristica.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $caracteristicas = $this->caracteristicaRepository->all();

        return view('caracteristicas.index')
            ->with('caracteristicas', $caracteristicas);
    }

    /**
     * Show the form for creating a new Caracteristica.
     *
     * @return Response
     */
    public function create()
    {
        return view('caracteristicas.create');
    }

    /**
     * Store a newly created Caracteristica in storage.
     *
     * @param CreateCaracteristicaRequest $request
     *
     * @return Response
     */
    public function store(CreateCaracteristicaRequest $request)
    {
        $input = $request->all();

        $caracteristica = $this->caracteristicaRepository->create($input);

        Flash::success('Caracteristica saved successfully.');

        return redirect(route('caracteristicas.index'));
    }

    /**
     * Display the specified Caracteristica.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $caracteristica = $this->caracteristicaRepository->find($id);

        if (empty($caracteristica)) {
            Flash::error('Caracteristica not found');

            return redirect(route('caracteristicas.index'));
        }

        return view('caracteristicas.show')->with('caracteristica', $caracteristica);
    }

    /**
     * Show the form for editing the specified Caracteristica.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $caracteristica = $this->caracteristicaRepository->find($id);

        if (empty($caracteristica)) {
            Flash::error('Caracteristica not found');

            return redirect(route('caracteristicas.index'));
        }

        return view('caracteristicas.edit')->with('caracteristica', $caracteristica);
    }

    /**
     * Update the specified Caracteristica in storage.
     *
     * @param int $id
     * @param UpdateCaracteristicaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCaracteristicaRequest $request)
    {
        $caracteristica = $this->caracteristicaRepository->find($id);

        if (empty($caracteristica)) {
            Flash::error('Caracteristica not found');

            return redirect(route('caracteristicas.index'));
        }

        $caracteristica = $this->caracteristicaRepository->update($request->all(), $id);

        Flash::success('Caracteristica updated successfully.');

        return redirect(route('caracteristicas.index'));
    }

    /**
     * Remove the specified Caracteristica from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $caracteristica = $this->caracteristicaRepository->find($id);

        if (empty($caracteristica)) {
            Flash::error('Caracteristica not found');

            return redirect(route('caracteristicas.index'));
        }

        $this->caracteristicaRepository->delete($id);

        Flash::success('Caracteristica deleted successfully.');

        return redirect(route('caracteristicas.index'));
    }
}
