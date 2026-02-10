<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHorarioClaseUnicaRequest;
use App\Http\Requests\UpdateHorarioClaseUnicaRequest;
use App\Repositories\HorarioClaseUnicaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Repositories\ClaseRepository;
use App\Models\User;

class HorarioClaseUnicaController extends AppBaseController
{
   


    private $horarioClaseUnicaRepository;
    private $claseRepository;

    public function __construct(HorarioClaseUnicaRepository $horarioClaseUnicaRepo, ClaseRepository $claseRepo)
    {
        $this->horarioClaseUnicaRepository = $horarioClaseUnicaRepo;
        $this->claseRepository = $claseRepo;
    }

    /**
     * Display a listing of the HorarioClaseUnica.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $horarioClaseUnicas = $this->horarioClaseUnicaRepository->withRelations();

        

        return view('horario_clase_unicas.index')
            ->with('horarioClaseUnicas', $horarioClaseUnicas);
    }

    /**
     * Show the form for creating a new HorarioClaseUnica.
     *
     * @return Response
     */
    public function create()
    {
        $clases = $this->claseRepository->all();
        $instructores = User::selectRaw("id, CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido) as nombre_completo")
    ->get()
    ->pluck('nombre_completo', 'id');



       //dd($instructores);
        $backpack = [
            "clases" => $clases,
            "instructores" => $instructores
        ];

        return view('horario_clase_unicas.create',$backpack);
    }

    /**
     * Store a newly created HorarioClaseUnica in storage.
     *
     * @param CreateHorarioClaseUnicaRequest $request
     *
     * @return Response
     */
    public function store(CreateHorarioClaseUnicaRequest $request)
    {
        $input = $request->all();

        $input['cupos_disponibles'] = $request->cupo_maximo;

        $horarioClaseUnica = $this->horarioClaseUnicaRepository->create($input);

        Flash::success('Horario Clase Unica saved successfully.');

        return redirect(route('horarioClaseUnicas.index'));
    }

    /**
     * Display the specified HorarioClaseUnica.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $horarioClaseUnica = $this->horarioClaseUnicaRepository->find($id);

        if (empty($horarioClaseUnica)) {
            Flash::error('Horario Clase Unica not found');

            return redirect(route('horarioClaseUnicas.index'));
        }

        return view('horario_clase_unicas.show')->with('horarioClaseUnica', $horarioClaseUnica);
    }

    /**
     * Show the form for editing the specified HorarioClaseUnica.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $horarioClaseUnica = $this->horarioClaseUnicaRepository->find($id);

        if (empty($horarioClaseUnica)) {
            Flash::error('Horario Clase Unica not found');

            return redirect(route('horarioClaseUnicas.index'));
        }

        $clases = $this->claseRepository->all();
        $instructores = User::selectRaw("id, CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido) as nombre_completo")
         ->get()
        ->pluck('nombre_completo', 'id');



       //dd($instructores);
        $backpack = [
            "clases" => $clases,
            "instructores" => $instructores,
            'horarioClaseUnica' => $horarioClaseUnica
        ];

        return view('horario_clase_unicas.edit',$backpack);
    }

    /**
     * Update the specified HorarioClaseUnica in storage.
     *
     * @param int $id
     * @param UpdateHorarioClaseUnicaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHorarioClaseUnicaRequest $request)
    {
        $horarioClaseUnica = $this->horarioClaseUnicaRepository->find($id);

        if (empty($horarioClaseUnica)) {
            Flash::error('Horario Clase Unica not found');

            return redirect(route('horarioClaseUnicas.index'));
        }

        $horarioClaseUnica = $this->horarioClaseUnicaRepository->update($request->all(), $id);

        

        Flash::success('Horario Clase Unica updated successfully.');

        return redirect(route('horarioClaseUnicas.index'));
    }

    /**
     * Remove the specified HorarioClaseUnica from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $horarioClaseUnica = $this->horarioClaseUnicaRepository->find($id);

        if (empty($horarioClaseUnica)) {
            Flash::error('Horario Clase Unica not found');

            return redirect(route('horarioClaseUnicas.index'));
        }

        $this->horarioClaseUnicaRepository->delete($id);

        Flash::success('Horario Clase Unica deleted successfully.');

        return redirect(route('horarioClaseUnicas.index'));
    }
}
