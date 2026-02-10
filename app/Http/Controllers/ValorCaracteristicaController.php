<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateValorCaracteristicaRequest;
use App\Http\Requests\UpdateValorCaracteristicaRequest;

use App\Repositories\ValorCaracteristicaRepository;
use App\Repositories\CaracteristicaRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ValorCaracteristicaController extends AppBaseController
{
    /** @var ValorCaracteristicaRepository $valorCaracteristicaRepository*/
    private $valorCaracteristicaRepository;
    private $caracteristicaRepository;

    public function __construct(ValorCaracteristicaRepository $valorCaracteristicaRepo, CaracteristicaRepository $caracteristicaRepo)
    {
        $this->valorCaracteristicaRepository = $valorCaracteristicaRepo;
        $this->caracteristicaRepository = $caracteristicaRepo;
    }

    /**
     * Display a listing of the ValorCaracteristica.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $valorCaracteristicas = $this->valorCaracteristicaRepository->all();

        return view('valor_caracteristicas.index')
            ->with('valorCaracteristicas', $valorCaracteristicas);
    }

    /**
     * Show the form for creating a new ValorCaracteristica.
     *
     * @return Response
     */
    public function create()
    {
        $caracteristicas = $this->caracteristicaRepository->all();
        $backpack = [
            "caracteristicas" => $caracteristicas
        ];
        return view('valor_caracteristicas.create',$backpack);
    }


    public function valoresCaracteristica($caracteristica_id){
        $valores_caracteristica = $this->valorCaracteristicaRepository->withRelations()->where("caracteristica_id",$caracteristica_id);
        return response()->json($valores_caracteristica);
    }

    /**
     * Store a newly created ValorCaracteristica in storage.
     *
     * @param CreateValorCaracteristicaRequest $request
     *
     * @return Response
     */
    public function store(CreateValorCaracteristicaRequest $request)
    {
        $input = $request->all();

        $valorCaracteristica = $this->valorCaracteristicaRepository->create($input);

        Flash::success('Valor Caracteristica saved successfully.');

        return redirect(route('valorCaracteristicas.index'));
    }

    /**
     * Display the specified ValorCaracteristica.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $valorCaracteristica = $this->valorCaracteristicaRepository->find($id);

        if (empty($valorCaracteristica)) {
            Flash::error('Valor Caracteristica not found');

            return redirect(route('valorCaracteristicas.index'));
        }

        return view('valor_caracteristicas.show')->with('valorCaracteristica', $valorCaracteristica);
    }

    /**
     * Show the form for editing the specified ValorCaracteristica.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $valorCaracteristica = $this->valorCaracteristicaRepository->find($id);

        if (empty($valorCaracteristica)) {
            Flash::error('Valor Caracteristica not found');

            return redirect(route('valorCaracteristicas.index'));
        }

        return view('valor_caracteristicas.edit')->with('valorCaracteristica', $valorCaracteristica);
    }

    /**
     * Update the specified ValorCaracteristica in storage.
     *
     * @param int $id
     * @param UpdateValorCaracteristicaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateValorCaracteristicaRequest $request)
    {
        $valorCaracteristica = $this->valorCaracteristicaRepository->find($id);

        if (empty($valorCaracteristica)) {
            Flash::error('Valor Caracteristica not found');

            return redirect(route('valorCaracteristicas.index'));
        }

        $valorCaracteristica = $this->valorCaracteristicaRepository->update($request->all(), $id);

        Flash::success('Valor Caracteristica updated successfully.');

        return redirect(route('valorCaracteristicas.index'));
    }

    /**
     * Remove the specified ValorCaracteristica from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $valorCaracteristica = $this->valorCaracteristicaRepository->find($id);

        if (empty($valorCaracteristica)) {
            Flash::error('Valor Caracteristica not found');

            return redirect(route('valorCaracteristicas.index'));
        }

        $this->valorCaracteristicaRepository->delete($id);

        Flash::success('Valor Caracteristica deleted successfully.');

        return redirect(route('valorCaracteristicas.index'));
    }
}
