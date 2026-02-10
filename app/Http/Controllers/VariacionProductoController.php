<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVariacionProductoRequest;
use App\Http\Requests\UpdateVariacionProductoRequest;
use App\Repositories\VariacionProductoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class VariacionProductoController extends AppBaseController
{
    /** @var VariacionProductoRepository $variacionProductoRepository*/
    private $variacionProductoRepository;

    public function __construct(VariacionProductoRepository $variacionProductoRepo)
    {
        $this->variacionProductoRepository = $variacionProductoRepo;
    }

    /**
     * Display a listing of the VariacionProducto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $variacionProductos = $this->variacionProductoRepository->all();

        return view('variacion_productos.index')
            ->with('variacionProductos', $variacionProductos);
    }

    public function variacionesProducto($producto_id, $caracteristica_id){
        $attributes = [
            "producto_id" => $producto_id,
            "caracteristica_id" => $caracteristica_id
        ];
        $variaciones_producto = $this->variacionProductoRepository->withProductoAndCaracteristica($attributes);

        return response()->json($variaciones_producto);
    }

    /**
     * Show the form for creating a new VariacionProducto.
     *
     * @return Response
     */
    public function create()
    {
        return view('variacion_productos.create');
    }

    /**
     * Store a newly created VariacionProducto in storage.
     *
     * @param CreateVariacionProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateVariacionProductoRequest $request)
    {
        $input = $request->all();

        $variacionProducto = $this->variacionProductoRepository->create($input);

        Flash::success('Variacion Producto saved successfully.');

        return redirect(route('variacionProductos.index'));
    }

    /**
     * Display the specified VariacionProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $variacionProducto = $this->variacionProductoRepository->find($id);

        if (empty($variacionProducto)) {
            Flash::error('Variacion Producto not found');

            return redirect(route('variacionProductos.index'));
        }

        return view('variacion_productos.show')->with('variacionProducto', $variacionProducto);
    }

    /**
     * Show the form for editing the specified VariacionProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $variacionProducto = $this->variacionProductoRepository->find($id);

        if (empty($variacionProducto)) {
            Flash::error('Variacion Producto not found');

            return redirect(route('variacionProductos.index'));
        }

        return view('variacion_productos.edit')->with('variacionProducto', $variacionProducto);
    }

    /**
     * Update the specified VariacionProducto in storage.
     *
     * @param int $id
     * @param UpdateVariacionProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVariacionProductoRequest $request)
    {
        $variacionProducto = $this->variacionProductoRepository->find($id);

        if (empty($variacionProducto)) {
            Flash::error('Variacion Producto not found');

            return redirect(route('variacionProductos.index'));
        }

        $variacionProducto = $this->variacionProductoRepository->update($request->all(), $id);

        Flash::success('Variacion Producto updated successfully.');

        return redirect(route('variacionProductos.index'));
    }

    /**
     * Remove the specified VariacionProducto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $variacionProducto = $this->variacionProductoRepository->find($id);

        if (empty($variacionProducto)) {
            Flash::error('Variacion Producto not found');

            return redirect(route('variacionProductos.index'));
        }

        $this->variacionProductoRepository->delete($id);

        Flash::success('Variacion Producto deleted successfully.');

        return redirect(route('variacionProductos.index'));
    }
}
