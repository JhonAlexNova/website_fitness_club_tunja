<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMetodoPagoRequest;
use App\Http\Requests\UpdateMetodoPagoRequest;
use App\Repositories\MetodoPagoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MetodoPagoController extends AppBaseController
{
    /** @var MetodoPagoRepository $metodoPagoRepository*/
    private $metodoPagoRepository;

    public function __construct(MetodoPagoRepository $metodoPagoRepo)
    {
        $this->metodoPagoRepository = $metodoPagoRepo;
    }

    /**
     * Display a listing of the MetodoPago.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $metodoPagos = $this->metodoPagoRepository->all();

        return view('metodo_pagos.index')
            ->with('metodoPagos', $metodoPagos);
    }

    /**
     * Show the form for creating a new MetodoPago.
     *
     * @return Response
     */
    public function create()
    {
        return view('metodo_pagos.create');
    }

    /**
     * Store a newly created MetodoPago in storage.
     *
     * @param CreateMetodoPagoRequest $request
     *
     * @return Response
     */
    public function store(CreateMetodoPagoRequest $request)
    {
        $input = $request->all();

        $metodoPago = $this->metodoPagoRepository->create($input);

        Flash::success('Metodo Pago saved successfully.');

        return redirect(route('metodoPagos.index'));
    }

    /**
     * Display the specified MetodoPago.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $metodoPago = $this->metodoPagoRepository->find($id);

        if (empty($metodoPago)) {
            Flash::error('Metodo Pago not found');

            return redirect(route('metodoPagos.index'));
        }

        return view('metodo_pagos.show')->with('metodoPago', $metodoPago);
    }

    /**
     * Show the form for editing the specified MetodoPago.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $metodoPago = $this->metodoPagoRepository->find($id);

        if (empty($metodoPago)) {
            Flash::error('Metodo Pago not found');

            return redirect(route('metodoPagos.index'));
        }

        return view('metodo_pagos.edit')->with('metodoPago', $metodoPago);
    }

    /**
     * Update the specified MetodoPago in storage.
     *
     * @param int $id
     * @param UpdateMetodoPagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMetodoPagoRequest $request)
    {
        $metodoPago = $this->metodoPagoRepository->find($id);

        if (empty($metodoPago)) {
            Flash::error('Metodo Pago not found');

            return redirect(route('metodoPagos.index'));
        }

        $metodoPago = $this->metodoPagoRepository->update($request->all(), $id);

        Flash::success('Metodo Pago updated successfully.');

        return redirect(route('metodoPagos.index'));
    }

    /**
     * Remove the specified MetodoPago from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $metodoPago = $this->metodoPagoRepository->find($id);

        if (empty($metodoPago)) {
            Flash::error('Metodo Pago not found');

            return redirect(route('metodoPagos.index'));
        }

        $this->metodoPagoRepository->delete($id);

        Flash::success('Metodo Pago deleted successfully.');

        return redirect(route('metodoPagos.index'));
    }
}
