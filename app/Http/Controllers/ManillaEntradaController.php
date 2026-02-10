<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateManillaEntradaRequest;
use App\Http\Requests\UpdateManillaEntradaRequest;
use App\Repositories\ManillaEntradaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ManillaEntradaController extends AppBaseController
{
    /** @var ManillaEntradaRepository $manillaEntradaRepository*/
    private $manillaEntradaRepository;

    public function __construct(ManillaEntradaRepository $manillaEntradaRepo)
    {
        $this->manillaEntradaRepository = $manillaEntradaRepo;
    }

    /**
     * Display a listing of the ManillaEntrada.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $manillaEntradas = $this->manillaEntradaRepository->withRelations();

        //dd($manillaEntradas);

        return view('manilla_entradas.index')
            ->with('manillaEntradas', $manillaEntradas);
    }

    /**
     * Show the form for creating a new ManillaEntrada.
     *
     * @return Response
     */
    public function create()
    {
        return view('manilla_entradas.create');
    }

    /**
     * Store a newly created ManillaEntrada in storage.
     *
     * @param CreateManillaEntradaRequest $request
     *
     * @return Response
     */
    public function store(CreateManillaEntradaRequest $request)
    {
        $input = $request->all();

        $manillaEntrada = $this->manillaEntradaRepository->create($input);

        Flash::success('Manilla Entrada saved successfully.');

        return redirect(route('manillaEntradas.index'));
    }

    /**
     * Display the specified ManillaEntrada.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $manillaEntrada = $this->manillaEntradaRepository->find($id);

        if (empty($manillaEntrada)) {
            Flash::error('Manilla Entrada not found');

            return redirect(route('manillaEntradas.index'));
        }

        return view('manilla_entradas.show')->with('manillaEntrada', $manillaEntrada);
    }

    /**
     * Show the form for editing the specified ManillaEntrada.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $manillaEntrada = $this->manillaEntradaRepository->find($id);

        if (empty($manillaEntrada)) {
            Flash::error('Manilla Entrada not found');

            return redirect(route('manillaEntradas.index'));
        }

        return view('manilla_entradas.edit')->with('manillaEntrada', $manillaEntrada);
    }

    /**
     * Update the specified ManillaEntrada in storage.
     *
     * @param int $id
     * @param UpdateManillaEntradaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateManillaEntradaRequest $request)
    {
        $manillaEntrada = $this->manillaEntradaRepository->find($id);

        if (empty($manillaEntrada)) {
            Flash::error('Manilla Entrada not found');

            return redirect(route('manillaEntradas.index'));
        }

        $manillaEntrada = $this->manillaEntradaRepository->update($request->all(), $id);

        Flash::success('Manilla Entrada updated successfully.');

        return redirect(route('manillaEntradas.index'));
    }

    /**
     * Remove the specified ManillaEntrada from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $manillaEntrada = $this->manillaEntradaRepository->find($id);

        if (empty($manillaEntrada)) {
            Flash::error('Manilla Entrada not found');

            return redirect(route('manillaEntradas.index'));
        }

        $this->manillaEntradaRepository->delete($id);

        Flash::success('Manilla Entrada deleted successfully.');

        return redirect(route('manillaEntradas.index'));
    }
}
