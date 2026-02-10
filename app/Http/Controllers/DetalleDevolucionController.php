<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDetalleDevolucionRequest;
use App\Http\Requests\UpdateDetalleDevolucionRequest;
use App\Repositories\DetalleDevolucionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DetalleDevolucionController extends AppBaseController
{
    /** @var DetalleDevolucionRepository $detalleDevolucionRepository*/
    private $detalleDevolucionRepository;

    public function __construct(DetalleDevolucionRepository $detalleDevolucionRepo)
    {
        $this->detalleDevolucionRepository = $detalleDevolucionRepo;
    }

    /**
     * Display a listing of the DetalleDevolucion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $detalleDevolucions = $this->detalleDevolucionRepository->all();

        return view('detalle_devolucions.index')
            ->with('detalleDevolucions', $detalleDevolucions);
    }

    /**
     * Show the form for creating a new DetalleDevolucion.
     *
     * @return Response
     */
    public function create()
    {
        return view('detalle_devolucions.create');
    }

    /**
     * Store a newly created DetalleDevolucion in storage.
     *
     * @param CreateDetalleDevolucionRequest $request
     *
     * @return Response
     */
    public function store(CreateDetalleDevolucionRequest $request)
    {
        $input = $request->all();

        $detalleDevolucion = $this->detalleDevolucionRepository->create($input);

        Flash::success('Detalle Devolucion saved successfully.');

        return redirect(route('detalleDevolucions.index'));
    }

    /**
     * Display the specified DetalleDevolucion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detalleDevolucion = $this->detalleDevolucionRepository->find($id);

        if (empty($detalleDevolucion)) {
            Flash::error('Detalle Devolucion not found');

            return redirect(route('detalleDevolucions.index'));
        }

        return view('detalle_devolucions.show')->with('detalleDevolucion', $detalleDevolucion);
    }

    /**
     * Show the form for editing the specified DetalleDevolucion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detalleDevolucion = $this->detalleDevolucionRepository->find($id);

        if (empty($detalleDevolucion)) {
            Flash::error('Detalle Devolucion not found');

            return redirect(route('detalleDevolucions.index'));
        }

        return view('detalle_devolucions.edit')->with('detalleDevolucion', $detalleDevolucion);
    }

    /**
     * Update the specified DetalleDevolucion in storage.
     *
     * @param int $id
     * @param UpdateDetalleDevolucionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDetalleDevolucionRequest $request)
    {
        $detalleDevolucion = $this->detalleDevolucionRepository->find($id);

        if (empty($detalleDevolucion)) {
            Flash::error('Detalle Devolucion not found');

            return redirect(route('detalleDevolucions.index'));
        }

        $detalleDevolucion = $this->detalleDevolucionRepository->update($request->all(), $id);

        Flash::success('Detalle Devolucion updated successfully.');

        return redirect(route('detalleDevolucions.index'));
    }

    /**
     * Remove the specified DetalleDevolucion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detalleDevolucion = $this->detalleDevolucionRepository->find($id);

        if (empty($detalleDevolucion)) {
            Flash::error('Detalle Devolucion not found');

            return redirect(route('detalleDevolucions.index'));
        }

        $this->detalleDevolucionRepository->delete($id);

        Flash::success('Detalle Devolucion deleted successfully.');

        return redirect(route('detalleDevolucions.index'));
    }
}
