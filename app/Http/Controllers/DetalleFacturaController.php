<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDetalleFacturaRequest;
use App\Http\Requests\UpdateDetalleFacturaRequest;
use App\Repositories\DetalleFacturaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DetalleFacturaController extends AppBaseController
{
    /** @var DetalleFacturaRepository $detalleFacturaRepository*/
    private $detalleFacturaRepository;

    public function __construct(DetalleFacturaRepository $detalleFacturaRepo)
    {
        $this->detalleFacturaRepository = $detalleFacturaRepo;
    }

    /**
     * Display a listing of the DetalleFactura.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $detalleFacturas = $this->detalleFacturaRepository->all();

        return view('detalle_facturas.index')
            ->with('detalleFacturas', $detalleFacturas);
    }

    /**
     * Show the form for creating a new DetalleFactura.
     *
     * @return Response
     */
    public function create()
    {
        return view('detalle_facturas.create');
    }

    /**
     * Store a newly created DetalleFactura in storage.
     *
     * @param CreateDetalleFacturaRequest $request
     *
     * @return Response
     */
    public function store(CreateDetalleFacturaRequest $request)
    {
        $input = $request->all();

        $detalleFactura = $this->detalleFacturaRepository->create($input);

        Flash::success('Detalle Factura saved successfully.');

        return redirect(route('detalleFacturas.index'));
    }

    /**
     * Display the specified DetalleFactura.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detalleFactura = $this->detalleFacturaRepository->find($id);

        if (empty($detalleFactura)) {
            Flash::error('Detalle Factura not found');

            return redirect(route('detalleFacturas.index'));
        }

        return view('detalle_facturas.show')->with('detalleFactura', $detalleFactura);
    }

    /**
     * Show the form for editing the specified DetalleFactura.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detalleFactura = $this->detalleFacturaRepository->find($id);

        if (empty($detalleFactura)) {
            Flash::error('Detalle Factura not found');

            return redirect(route('detalleFacturas.index'));
        }

        return view('detalle_facturas.edit')->with('detalleFactura', $detalleFactura);
    }

    /**
     * Update the specified DetalleFactura in storage.
     *
     * @param int $id
     * @param UpdateDetalleFacturaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDetalleFacturaRequest $request)
    {
        $detalleFactura = $this->detalleFacturaRepository->find($id);

        if (empty($detalleFactura)) {
            Flash::error('Detalle Factura not found');

            return redirect(route('detalleFacturas.index'));
        }

        $detalleFactura = $this->detalleFacturaRepository->update($request->all(), $id);

        Flash::success('Detalle Factura updated successfully.');

        return redirect(route('detalleFacturas.index'));
    }

    /**
     * Remove the specified DetalleFactura from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detalleFactura = $this->detalleFacturaRepository->find($id);

        if (empty($detalleFactura)) {
            Flash::error('Detalle Factura not found');

            return redirect(route('detalleFacturas.index'));
        }

        $this->detalleFacturaRepository->delete($id);

        Flash::success('Detalle Factura deleted successfully.');

        return redirect(route('detalleFacturas.index'));
    }
}
