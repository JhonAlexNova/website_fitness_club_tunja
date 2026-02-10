<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRutinaEjercicioRequest;
use App\Http\Requests\UpdateRutinaEjercicioRequest;
use App\Repositories\RutinaEjercicioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RutinaEjercicioController extends AppBaseController
{
    /** @var RutinaEjercicioRepository $rutinaEjercicioRepository*/
    private $rutinaEjercicioRepository;

    public function __construct(RutinaEjercicioRepository $rutinaEjercicioRepo)
    {
        $this->rutinaEjercicioRepository = $rutinaEjercicioRepo;
    }

    /**
     * Display a listing of the RutinaEjercicio.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $rutinaEjercicios = $this->rutinaEjercicioRepository->all();

        return view('rutina_ejercicios.index')
            ->with('rutinaEjercicios', $rutinaEjercicios);
    }

    /**
     * Show the form for creating a new RutinaEjercicio.
     *
     * @return Response
     */
    public function create()
    {
        return view('rutina_ejercicios.create');
    }

    /**
     * Store a newly created RutinaEjercicio in storage.
     *
     * @param CreateRutinaEjercicioRequest $request
     *
     * @return Response
     */
    public function store(CreateRutinaEjercicioRequest $request)
    {
        if (empty($request["ejercicios"])) {
            Flash::error('No hay ningun ejercicio seleccionado.');

            return redirect()->back();
        }

        foreach($request["ejercicios"] as $index => $id_ejercicio){
            $volumen = $request["volumen|$id_ejercicio"][0];
            $intensidad = $request["intensidad|$id_ejercicio"][0];
            $frecuencia = $request["frecuencia|$id_ejercicio"][0];

            $attributes = [
                'id_ejercicio' => $id_ejercicio,
                "id_rutina" => $request->id_rutina,
                'volumen' => $volumen,
                'intensidad' => $intensidad,
                'frecuencia' => $frecuencia,
            ];
        }

        $rutinaEjercicio = $this->rutinaEjercicioRepository->create($attributes);

        Flash::success('Ejercicios agregados a la rutina correctamente');

        return redirect()->back();
    }

    /**
     * Display the specified RutinaEjercicio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rutinaEjercicio = $this->rutinaEjercicioRepository->find($id);

        if (empty($rutinaEjercicio)) {
            Flash::error('Rutina Ejercicio not found');

            return redirect(route('rutinaEjercicios.index'));
        }

        return view('rutina_ejercicios.show')->with('rutinaEjercicio', $rutinaEjercicio);
    }

    /**
     * Show the form for editing the specified RutinaEjercicio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ejercicioRutina = $this->rutinaEjercicioRepository->find($id);
        return response()->json([
            'html' => view('rutina_ejercicios.partials.form-edit', compact('ejercicioRutina'))->render()
        ]);
    }

    /**
     * Update the specified RutinaEjercicio in storage.
     *
     * @param int $id
     * @param UpdateRutinaEjercicioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRutinaEjercicioRequest $request)
    {
        $rutinaEjercicio = $this->rutinaEjercicioRepository->find($id);


        if (empty($rutinaEjercicio)) {
            Flash::error('Rutina Ejercicio not found');

            return redirect(route('rutinaEjercicios.index'));
        }

        $rutinaEjercicio = $this->rutinaEjercicioRepository->update($request->all(), $id);

        Flash::success('Registro actualizado correctamente');

        return redirect()->back();
    }

    /**
     * Remove the specified RutinaEjercicio from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rutinaEjercicio = $this->rutinaEjercicioRepository->find($id);

        if (empty($rutinaEjercicio)) {
            Flash::error('Rutina Ejercicio not found');

            return redirect(route('rutinaEjercicios.index'));
        }

        $this->rutinaEjercicioRepository->delete($id);

        Flash::success('Ejercicio eliminado de la rutina correctamente');

        return redirect()->back();
    }
}
