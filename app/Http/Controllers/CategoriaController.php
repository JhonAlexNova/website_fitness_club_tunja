<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Repositories\CategoriaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Storage;
use DB;

use App\Models\Producto;



class CategoriaController extends AppBaseController
{
    /** @var CategoriaRepository $categoriaRepository*/
    private $categoriaRepository;

    public function __construct(CategoriaRepository $categoriaRepo)
    {
        $this->categoriaRepository = $categoriaRepo;
    }

    /**
     * Display a listing of the Categoria.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categorias = $this->categoriaRepository->withRelations();

        return view('categorias.index')
            ->with('categorias', $categorias);
    }

    /**
     * Show the form for creating a new Categoria.
     *
     * @return Response
     */
    public function create()
    {
        $categorias = $this->categoriaRepository->withRelations();

        $backpack = [
            "categorias" => $categorias
        ];

        return view('categorias.create',$backpack);
    }

    /**
     * Store a newly created Categoria in storage.
     *
     * @param CreateCategoriaRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoriaRequest $request)
    {
        $input = $request->all();

        if($request->file('file')){
            $input['icono'] = Storage::disk('uploads')->putFile('avatar',$request->file);            
        }

        $categoria = $this->categoriaRepository->create($input);

        Flash::success('Categoria creada correctamente.');

        return redirect(route('categorias.index'));
    }

    /**
     * Display the specified Categoria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoria = $this->categoriaRepository->find($id);

        if (empty($categoria)) {
            Flash::error('Categoria not found');

            return redirect(route('categorias.index'));
        }

        return view('categorias.show')->with('categoria', $categoria);
    }

    /**
     * Show the form for editing the specified Categoria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoria = $this->categoriaRepository->find($id);

        if (empty($categoria)) {
            Flash::error('Categoria not found');

            return redirect(route('categorias.index'));
        }

        $categorias = $this->categoriaRepository->withRelations();


        $backpack = [
            "categorias" => $categorias,
            "categoria" => $categoria
        ];

        return view('categorias.edit',$backpack);
    }

    /**
     * Update the specified Categoria in storage.
     *
     * @param int $id
     * @param UpdateCategoriaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoriaRequest $request)
    {
        $categoria = $this->categoriaRepository->find($id);

        if (empty($categoria)) {
            Flash::error('Categoria not found');

            return redirect(route('categorias.index'));
        }

        if($request->file('file')){
            $request['icono'] = Storage::disk('uploads')->putFile('avatar',$request->file);            
        }


        $categoria = $this->categoriaRepository->update($request->all(), $id);

        Flash::success('Categoria actualizada correctamente.');

        return redirect(route('categorias.index'));
    }

    /**
     * Remove the specified Categoria from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoria = $this->categoriaRepository->find($id);

        if (empty($categoria)) {
            Flash::error('Categoria not found');

            return redirect(route('categorias.index'));
        }


        $productos  = Producto::where('categoria_id',$categoria->id)->get();

      /*   if(count($productos)>0){            
            Flash::error('No se a podido eliminar el producto porque tiene registro asociados.');
            return redirect()->back();
        }
 */

        $this->categoriaRepository->delete($id);

        Flash::success('Categoria deleted successfully.');

        return redirect(route('categorias.index'));
    }
}
