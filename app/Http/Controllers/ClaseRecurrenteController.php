<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClaseRecurrenteRequest;
use App\Http\Requests\UpdateClaseRecurrenteRequest;

use App\Repositories\ClaseRecurrenteRepository;
use App\Repositories\ClaseRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\User;

class ClaseRecurrenteController extends AppBaseController
{
    /** @var ClaseRecurrenteRepository $claseRecurrenteRepository*/
    private $claseRecurrenteRepository;
    private $claseRepository;

    public function __construct(
        ClaseRecurrenteRepository $claseRecurrenteRepo,
        ClaseRepository $claseRepo
    )
    {
        $this->claseRecurrenteRepository = $claseRecurrenteRepo;
        $this->claseRepository = $claseRepo;
    }

    /**
     * Display a listing of the ClaseRecurrente.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $claseRecurrentes = $this->claseRecurrenteRepository->all();

        return view('clase_recurrentes.index')
            ->with('claseRecurrentes', $claseRecurrentes);
    }

    /**
     * Show the form for creating a new ClaseRecurrente.
     *
     * @return Response
     */
    public function create()
    {
        $diasSemana = [
            0 => 'Domingo',
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
        ];


        $clases = $this->claseRepository->all();
        $instructores = User::selectRaw("id, CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido) as nombre_completo")
    ->get()
    ->pluck('nombre_completo', 'id');

        
        
        

        $backpack = [
            "diasSemana" => $diasSemana,
            "clases" => $clases,
            "instructores" => $instructores
        ];
        
        return view('clase_recurrentes.create',$backpack);
    }

    /**
     * Store a newly created ClaseRecurrente in storage.
     *
     * @param CreateClaseRecurrenteRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $claseRecurrente = $this->claseRecurrenteRepository->create($input);

        Flash::success('Clase Recurrente saved successfully.');

        return redirect(route('claseRecurrentes.index'));
    }

    /**
     * Display the specified ClaseRecurrente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $claseRecurrente = $this->claseRecurrenteRepository->find($id);

        if (empty($claseRecurrente)) {
            Flash::error('Clase Recurrente not found');

            return redirect(route('claseRecurrentes.index'));
        }

        return view('clase_recurrentes.show')->with('claseRecurrente', $claseRecurrente);
    }

    /**
     * Show the form for editing the specified ClaseRecurrente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $claseRecurrente = $this->claseRecurrenteRepository->find($id);

        if (empty($claseRecurrente)) {
            Flash::error('Clase Recurrente not found');

            return redirect(route('claseRecurrentes.index'));
        }
        $diasSemana = [
            0 => 'Domingo',
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
        ];

        $clases = $this->claseRepository->all();
        $instructores = User::selectRaw("id, CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido) as nombre_completo")
    ->get()
    ->pluck('nombre_completo', 'id');

        
        
        

        $backpack = [
            "diasSemana" => $diasSemana,
            "clases" => $clases,
            "instructores" => $instructores,
            "claseRecurrente" => $claseRecurrente
        ];

        return view('clase_recurrentes.edit',$backpack);
    }

    /**
     * Update the specified ClaseRecurrente in storage.
     *
     * @param int $id
     * @param UpdateClaseRecurrenteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClaseRecurrenteRequest $request)
    {
        $claseRecurrente = $this->claseRecurrenteRepository->find($id);

        if (empty($claseRecurrente)) {
            Flash::error('Clase Recurrente not found');

            return redirect(route('claseRecurrentes.index'));
        }

        $claseRecurrente = $this->claseRecurrenteRepository->update($request->all(), $id);

        Flash::success('Clase Recurrente updated successfully.');

        return redirect(route('claseRecurrentes.index'));
    }

    /**
     * Remove the specified ClaseRecurrente from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $claseRecurrente = $this->claseRecurrenteRepository->find($id);

        if (empty($claseRecurrente)) {
            Flash::error('Clase Recurrente not found');

            return redirect(route('claseRecurrentes.index'));
        }

        $this->claseRecurrenteRepository->delete($id);

        Flash::success('Clase Recurrente deleted successfully.');

        return redirect(route('claseRecurrentes.index'));
    }
}
