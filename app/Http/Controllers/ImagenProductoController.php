<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImagenProductoRequest;
use App\Http\Requests\UpdateImagenProductoRequest;
use App\Repositories\ImagenProductoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ImagenProductoController extends AppBaseController
{
    /** @var ImagenProductoRepository $imagenProductoRepository*/
    private $imagenProductoRepository;

    public function __construct(ImagenProductoRepository $imagenProductoRepo)
    {
        $this->imagenProductoRepository = $imagenProductoRepo;
    }

    /**
     * Display a listing of the ImagenProducto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $imagenProductos = $this->imagenProductoRepository->all();

        return view('imagen_productos.index')
            ->with('imagenProductos', $imagenProductos);
    }

    /**
     * Show the form for creating a new ImagenProducto.
     *
     * @return Response
     */
    public function create()
    {
        return view('imagen_productos.create');
    }

    /**
     * Store a newly created ImagenProducto in storage.
     *
     * @param CreateImagenProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateImagenProductoRequest $request)
    {
        $input = $request->all();

        $imagenProducto = $this->imagenProductoRepository->create($input);

        Flash::success('Imagen Producto saved successfully.');

        return redirect(route('imagenProductos.index'));
    }

    /**
     * Display the specified ImagenProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $imagenProducto = $this->imagenProductoRepository->find($id);

        if (empty($imagenProducto)) {
            Flash::error('Imagen Producto not found');

            return redirect(route('imagenProductos.index'));
        }

        return view('imagen_productos.show')->with('imagenProducto', $imagenProducto);
    }

    /**
     * Show the form for editing the specified ImagenProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $imagenProducto = $this->imagenProductoRepository->find($id);

        if (empty($imagenProducto)) {
            Flash::error('Imagen Producto not found');

            return redirect(route('imagenProductos.index'));
        }

        return view('imagen_productos.edit')->with('imagenProducto', $imagenProducto);
    }

    /**
     * Update the specified ImagenProducto in storage.
     *
     * @param int $id
     * @param UpdateImagenProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImagenProductoRequest $request)
    {
        $imagenProducto = $this->imagenProductoRepository->find($id);

        if (empty($imagenProducto)) {
            Flash::error('Imagen Producto not found');

            return redirect(route('imagenProductos.index'));
        }

        $imagenProducto = $this->imagenProductoRepository->update($request->all(), $id);

        Flash::success('Imagen Producto updated successfully.');

        return redirect(route('imagenProductos.index'));
    }

    /**
     * Remove the specified ImagenProducto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $imagenProducto = $this->imagenProductoRepository->find($id);

        if (empty($imagenProducto)) {
            Flash::error('Imagen Producto not found');

            return redirect(route('imagenProductos.index'));
        }

        $this->imagenProductoRepository->delete($id);

        Flash::success('Imagen Producto deleted successfully.');

        return redirect(route('imagenProductos.index'));
    }
}
