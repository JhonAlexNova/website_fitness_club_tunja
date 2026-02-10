<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHistorialProductoRequest;
use App\Http\Requests\UpdateHistorialProductoRequest;
use App\Repositories\HistorialProductoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HistorialProductoController extends AppBaseController
{
    /** @var HistorialProductoRepository $historialProductoRepository*/
    private $historialProductoRepository;

    public function __construct(HistorialProductoRepository $historialProductoRepo)
    {
        $this->historialProductoRepository = $historialProductoRepo;
    }

    /**
     * Display a listing of the HistorialProducto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $historialProductos = $this->historialProductoRepository->all();

        return view('historial_productos.index')
            ->with('historialProductos', $historialProductos);
    }

    /**
     * Show the form for creating a new HistorialProducto.
     *
     * @return Response
     */
    public function create()
    {
        return view('historial_productos.create');
    }

    /**
     * Store a newly created HistorialProducto in storage.
     *
     * @param CreateHistorialProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateHistorialProductoRequest $request)
    {
        $input = $request->all();

        $historialProducto = $this->historialProductoRepository->create($input);

        Flash::success('Historial Producto saved successfully.');

        return redirect(route('historialProductos.index'));
    }

    /**
     * Display the specified HistorialProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $historialProducto = $this->historialProductoRepository->find($id);

        if (empty($historialProducto)) {
            Flash::error('Historial Producto not found');

            return redirect(route('historialProductos.index'));
        }

        return view('historial_productos.show')->with('historialProducto', $historialProducto);
    }

    /**
     * Show the form for editing the specified HistorialProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $historialProducto = $this->historialProductoRepository->find($id);

        if (empty($historialProducto)) {
            Flash::error('Historial Producto not found');

            return redirect(route('historialProductos.index'));
        }

        return view('historial_productos.edit')->with('historialProducto', $historialProducto);
    }

    /**
     * Update the specified HistorialProducto in storage.
     *
     * @param int $id
     * @param UpdateHistorialProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHistorialProductoRequest $request)
    {
        $historialProducto = $this->historialProductoRepository->find($id);

        if (empty($historialProducto)) {
            Flash::error('Historial Producto not found');

            return redirect(route('historialProductos.index'));
        }

        $historialProducto = $this->historialProductoRepository->update($request->all(), $id);

        Flash::success('Historial Producto updated successfully.');

        return redirect(route('historialProductos.index'));
    }

    /**
     * Remove the specified HistorialProducto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $historialProducto = $this->historialProductoRepository->find($id);

        if (empty($historialProducto)) {
            Flash::error('Historial Producto not found');

            return redirect(route('historialProductos.index'));
        }

        $this->historialProductoRepository->delete($id);

        Flash::success('Historial Producto deleted successfully.');

        return redirect(route('historialProductos.index'));
    }
}
