<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCaracteristicaProductoRequest;
use App\Http\Requests\UpdateCaracteristicaProductoRequest;
use App\Repositories\CaracteristicaProductoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CaracteristicaProductoController extends AppBaseController
{
    /** @var CaracteristicaProductoRepository $caracteristicaProductoRepository*/
    private $caracteristicaProductoRepository;

    public function __construct(CaracteristicaProductoRepository $caracteristicaProductoRepo)
    {
        $this->caracteristicaProductoRepository = $caracteristicaProductoRepo;
    }

    /**
     * Display a listing of the CaracteristicaProducto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $caracteristicaProductos = $this->caracteristicaProductoRepository->all();

        return view('caracteristica_productos.index')
            ->with('caracteristicaProductos', $caracteristicaProductos);
    }

    /**
     * Show the form for creating a new CaracteristicaProducto.
     *
     * @return Response
     */
    public function create()
    {
        return view('caracteristica_productos.create');
    }

    /**
     * Store a newly created CaracteristicaProducto in storage.
     *
     * @param CreateCaracteristicaProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateCaracteristicaProductoRequest $request)
    {
        $input = $request->all();

        $caracteristicaProducto = $this->caracteristicaProductoRepository->create($input);

        Flash::success('Caracteristica Producto saved successfully.');

        return redirect(route('caracteristicaProductos.index'));
    }

    /**
     * Display the specified CaracteristicaProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $caracteristicaProducto = $this->caracteristicaProductoRepository->find($id);

        if (empty($caracteristicaProducto)) {
            Flash::error('Caracteristica Producto not found');

            return redirect(route('caracteristicaProductos.index'));
        }

        return view('caracteristica_productos.show')->with('caracteristicaProducto', $caracteristicaProducto);
    }

    /**
     * Show the form for editing the specified CaracteristicaProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $caracteristicaProducto = $this->caracteristicaProductoRepository->find($id);

        if (empty($caracteristicaProducto)) {
            Flash::error('Caracteristica Producto not found');

            return redirect(route('caracteristicaProductos.index'));
        }

        return view('caracteristica_productos.edit')->with('caracteristicaProducto', $caracteristicaProducto);
    }

    /**
     * Update the specified CaracteristicaProducto in storage.
     *
     * @param int $id
     * @param UpdateCaracteristicaProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCaracteristicaProductoRequest $request)
    {
        $caracteristicaProducto = $this->caracteristicaProductoRepository->find($id);

        if (empty($caracteristicaProducto)) {
            Flash::error('Caracteristica Producto not found');

            return redirect(route('caracteristicaProductos.index'));
        }

        $caracteristicaProducto = $this->caracteristicaProductoRepository->update($request->all(), $id);

        Flash::success('Caracteristica Producto updated successfully.');

        return redirect(route('caracteristicaProductos.index'));
    }

    /**
     * Remove the specified CaracteristicaProducto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $caracteristicaProducto = $this->caracteristicaProductoRepository->find($id);

        if (empty($caracteristicaProducto)) {
            Flash::error('Caracteristica Producto not found');

            return redirect(route('caracteristicaProductos.index'));
        }

        $this->caracteristicaProductoRepository->delete($id);

        Flash::success('Caracteristica Producto deleted successfully.');

        return redirect(route('caracteristicaProductos.index'));
    }
}
