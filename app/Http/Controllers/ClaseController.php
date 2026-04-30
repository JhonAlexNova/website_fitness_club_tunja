<?php

namespace App\Http\Controllers;

use App\Models\HorarioClaseUnica;
use App\Models\ClaseRecurrente;
use App\Http\Requests\CreateClaseRequest;
use App\Http\Requests\UpdateClaseRequest;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;

use App\Repositories\ClaseRepository;

class ClaseController extends Controller
{
    private $claseRepository;

    public function __construct(ClaseRepository $claseRepo)
    {
        $this->claseRepository = $claseRepo;
    }

    public function index(Request $request)
    {
        $clases = $this->claseRepository->all();
        return view('clases.index')->with('clases', $clases);
    }

    public function create()
    {
        return view('clases.create');
    }

    public function store(CreateClaseRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('clases', 'public');
            $input['imagen'] = $path;
        }

        $clase = $this->claseRepository->create($input);

        Flash::success('Clase creada correctamente.');

        return redirect(route('admon.clases.index'));
    }

    public function edit($id)
    {
        $clase = $this->claseRepository->find($id);

        if (empty($clase)) {
            Flash::error('Clase not found');
            return redirect(route('admon.clases.index'));
        }

        return view('clases.edit')->with('clase', $clase);
    }

    public function update($id, UpdateClaseRequest $request)
    {
        $clase = $this->claseRepository->find($id);

        if (empty($clase)) {
            Flash::error('Clase not found');
            return redirect(route('admon.clases.index'));
        }

        $input = $request->all();

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('clases', 'public');
            $input['imagen'] = $path;
        }

        $clase = $this->claseRepository->update($input, $id);

        Flash::success('Clase updated successfully.');

        return redirect(route('admon.clases.index'));
    }

    public function destroy($id)
    {
        $clase = $this->claseRepository->find($id);

        if (empty($clase)) {
            Flash::error('Clase not found');
            return redirect(route('admon.clases.index'));
        }

        $this->claseRepository->delete($id);

        Flash::success('Clase deleted successfully.');

        return redirect(route('admon.clases.index'));
    }

    public function getHorarios()
    {
        $horariosUnicas = HorarioClaseUnica::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->whereHas('clase')       // <-- descarta huérfanos
            ->whereHas('instructor')
            ->get()
            ->map(function ($horario) {
                return [
                    'id'               => $horario->id,
                    'title'            => $horario->clase->nombre,
                    'imagen'           => $horario->clase->imagen
                        ? asset('storage/' . $horario->clase->imagen)
                        : null,
                    'start'            => $horario->fecha_hora,
                    'end'              => Carbon::parse($horario->fecha_hora)
                                            ->addMinutes($horario->clase->duracion),
                    'instructor'       => $horario->instructor->nombre,
                    'cupo_maximo'      => $horario->cupo_maximo,
                    'cupos_disponibles'=> $horario->cupos_disponibles,
                ];
            });

        $horariosRecurrentes = ClaseRecurrente::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->whereHas('clase')       // <-- descarta huérfanos
            ->whereHas('instructor')
            ->get()
            ->flatMap(function ($recurrente) {
                $eventos = [];
                for ($i = 0; $i < 100; $i++) {
                    $fecha = Carbon::now()->next($recurrente->dia_semana)->addWeeks($i);
                    $eventos[] = [
                        'id'          => $recurrente->id,
                        'title'       => $recurrente->clase->nombre,
                        'imagen'      => $recurrente->clase->imagen
                            ? asset('storage/' . $recurrente->clase->imagen)
                            : null,
                        'start'       => $fecha->format('Y-m-d') . ' ' . $recurrente->hora,
                        'end'         => $fecha->addMinutes($recurrente->duracion),
                        'instructor'  => $recurrente->instructor->nombre,
                        'cupo_maximo' => $recurrente->cupo_maximo,
                    ];
                }
                return $eventos;
            });

        return response()->json(
            array_merge($horariosUnicas->toArray(), $horariosRecurrentes->toArray())
        );
    }

    public function createHorarioUnico(Request $request)
    {
        $request->validate([
            'clase_id'      => 'required|exists:clases,id',
            'instructor_id' => 'required|exists:instructores,id',
            'fecha_hora'    => 'required|date',
            'cupo_maximo'   => 'required|integer|min:0',
        ]);

        $horario = HorarioClaseUnica::create([
            'clase_id'          => $request->clase_id,
            'instructor_id'     => $request->instructor_id,
            'fecha_hora'        => $request->fecha_hora,
            'cupo_maximo'       => $request->cupo_maximo,
            'cupos_disponibles' => $request->cupo_maximo,
        ]);

        return response()->json($horario, 201);
    }

    public function createClaseRecurrente(Request $request)
    {
        $request->validate([
            'clase_id'      => 'required|exists:clases,id',
            'instructor_id' => 'required|exists:instructores,id',
            'dia_semana'    => 'required|integer|between:0,6',
            'hora'          => 'required|date_format:H:i',
            'duracion'      => 'required|integer|min:1',
            'cupo_maximo'   => 'required|integer|min:0',
        ]);

        $recurrente = ClaseRecurrente::create([
            'clase_id'      => $request->clase_id,
            'instructor_id' => $request->instructor_id,
            'dia_semana'    => $request->dia_semana,
            'hora'          => $request->hora,
            'duracion'      => $request->duracion,
            'cupo_maximo'   => $request->cupo_maximo,
        ]);

        return response()->json($recurrente, 201);
    }

    public function updateHorarioUnico(Request $request, $id)
    {
        $horario = HorarioClaseUnica::findOrFail($id);
        $request->validate([
            'fecha_hora'  => 'date',
            'cupo_maximo' => 'integer|min:0',
        ]);

        $horario->update($request->only(['fecha_hora', 'cupo_maximo', 'cupos_disponibles']));
        return response()->json($horario);
    }

    public function updateClaseRecurrente(Request $request, $id)
    {
        $recurrente = ClaseRecurrente::findOrFail($id);
        $request->validate([
            'dia_semana'  => 'integer|between:0,6',
            'hora'        => 'date_format:H:i',
            'duracion'    => 'integer|min:1',
            'cupo_maximo' => 'integer|min:0',
        ]);

        $recurrente->update($request->only(['dia_semana', 'hora', 'duracion', 'cupo_maximo']));
        return response()->json($recurrente);
    }

    public function deleteHorarioUnico($id)
    {
        $horario = HorarioClaseUnica::findOrFail($id);
        $horario->delete();
        return response()->json(['message' => 'Horario de clase única eliminado.']);
    }

    public function deleteClaseRecurrente($id)
    {
        $recurrente = ClaseRecurrente::findOrFail($id);
        $recurrente->delete();
        return response()->json(['message' => 'Clase recurrente eliminada.']);
    }
}