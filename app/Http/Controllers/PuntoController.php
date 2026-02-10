<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePuntoRequest;
use App\Http\Requests\UpdatePuntoRequest;
use App\Repositories\PuntoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Punto;
use DB;

class PuntoController extends AppBaseController
{
    /** @var PuntoRepository $puntoRepository*/
    private $puntoRepository;

    public function __construct(PuntoRepository $puntoRepo)
    {
        $this->puntoRepository = $puntoRepo;
    }

    /**
     * Display a listing of the Punto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /* $puntos = $this->puntoRepository->all();

        return view('puntos.index')
            ->with('puntos', $puntos); */

        $puntos = Punto::with('user')
        ->select('user_id', DB::raw('SUM(puntos) as total_puntos'))
        ->groupBy('user_id')
        ->get();

      //  dd($puntos);

        return view('puntos.index')
            ->with('puntos', $puntos);
    }

    /**
     * Show the form for creating a new Punto.
     *
     * @return Response
     */
    public function create()
    {
        return view('puntos.create');
    }

    /**
     * Store a newly created Punto in storage.
     *
     * @param CreatePuntoRequest $request
     *
     * @return Response
     */
    public function store(CreatePuntoRequest $request)
    {
        $input = $request->all();

        $punto = $this->puntoRepository->create($input);

        Flash::success('Punto saved successfully.');

        return redirect(route('puntos.index'));
    }

    /**
     * Display the specified Punto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $punto = $this->puntoRepository->find($id);

        if (empty($punto)) {
            Flash::error('Punto not found');

            return redirect(route('puntos.index'));
        }

        return view('puntos.show')->with('punto', $punto);
    }

    /**
     * Show the form for editing the specified Punto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $punto = $this->puntoRepository->find($id);

        if (empty($punto)) {
            Flash::error('Punto not found');

            return redirect(route('puntos.index'));
        }

        return view('puntos.edit')->with('punto', $punto);
    }

    /**
     * Update the specified Punto in storage.
     *
     * @param int $id
     * @param UpdatePuntoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePuntoRequest $request)
    {
        $punto = $this->puntoRepository->find($id);

        if (empty($punto)) {
            Flash::error('Punto not found');

            return redirect(route('puntos.index'));
        }

        $punto = $this->puntoRepository->update($request->all(), $id);

        Flash::success('Punto updated successfully.');

        return redirect(route('puntos.index'));
    }

    /**
     * Remove the specified Punto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $punto = $this->puntoRepository->find($id);

        if (empty($punto)) {
            Flash::error('Punto not found');

            return redirect(route('puntos.index'));
        }

        $this->puntoRepository->delete($id);

        Flash::success('Punto deleted successfully.');

        return redirect(route('puntos.index'));
    }
}
