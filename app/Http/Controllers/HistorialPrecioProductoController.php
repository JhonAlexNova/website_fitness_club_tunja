<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHistorialPrecioProductoRequest;
use App\Http\Requests\UpdateHistorialPrecioProductoRequest;
use App\Repositories\HistorialPrecioProductoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HistorialPrecioProductoController extends AppBaseController
{
    /** @var HistorialPrecioProductoRepository $historialPrecioProductoRepository*/
    private $historialPrecioProductoRepository;

    public function __construct(HistorialPrecioProductoRepository $historialPrecioProductoRepo)
    {
        $this->historialPrecioProductoRepository = $historialPrecioProductoRepo;
    }

    /**
     * Display a listing of the HistorialPrecioProducto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $historialPrecioProductos = $this->historialPrecioProductoRepository->all();

        return view('historial_precio_productos.index')
            ->with('historialPrecioProductos', $historialPrecioProductos);
    }

    /**
     * Show the form for creating a new HistorialPrecioProducto.
     *
     * @return Response
     */
    public function create()
    {
        return view('historial_precio_productos.create');
    }

    /**
     * Store a newly created HistorialPrecioProducto in storage.
     *
     * @param CreateHistorialPrecioProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateHistorialPrecioProductoRequest $request)
    {
        $input = $request->all();

        $historialPrecioProducto = $this->historialPrecioProductoRepository->create($input);

        Flash::success('Historial Precio Producto saved successfully.');

        return redirect(route('historialPrecioProductos.index'));
    }

    /**
     * Display the specified HistorialPrecioProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $historialPrecioProducto = $this->historialPrecioProductoRepository->find($id);

        if (empty($historialPrecioProducto)) {
            Flash::error('Historial Precio Producto not found');

            return redirect(route('historialPrecioProductos.index'));
        }

        return view('historial_precio_productos.show')->with('historialPrecioProducto', $historialPrecioProducto);
    }

    /**
     * Show the form for editing the specified HistorialPrecioProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $historialPrecioProducto = $this->historialPrecioProductoRepository->find($id);

        if (empty($historialPrecioProducto)) {
            Flash::error('Historial Precio Producto not found');

            return redirect(route('historialPrecioProductos.index'));
        }

        return view('historial_precio_productos.edit')->with('historialPrecioProducto', $historialPrecioProducto);
    }

    /**
     * Update the specified HistorialPrecioProducto in storage.
     *
     * @param int $id
     * @param UpdateHistorialPrecioProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHistorialPrecioProductoRequest $request)
    {
        $historialPrecioProducto = $this->historialPrecioProductoRepository->find($id);

        if (empty($historialPrecioProducto)) {
            Flash::error('Historial Precio Producto not found');

            return redirect(route('historialPrecioProductos.index'));
        }

        $historialPrecioProducto = $this->historialPrecioProductoRepository->update($request->all(), $id);

        Flash::success('Historial Precio Producto updated successfully.');

        return redirect(route('historialPrecioProductos.index'));
    }

    /**
     * Remove the specified HistorialPrecioProducto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $historialPrecioProducto = $this->historialPrecioProductoRepository->find($id);

        if (empty($historialPrecioProducto)) {
            Flash::error('Historial Precio Producto not found');

            return redirect(route('historialPrecioProductos.index'));
        }

        $this->historialPrecioProductoRepository->delete($id);

        Flash::success('Historial Precio Producto deleted successfully.');

        return redirect(route('historialPrecioProductos.index'));
    }
}
