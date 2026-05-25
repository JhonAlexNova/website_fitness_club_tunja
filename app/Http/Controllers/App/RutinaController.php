<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\ClaseRecurrente;
use App\Models\HorarioClaseUnica;
use App\Models\Reserva;
use App\Models\Rutina;
use Carbon\Carbon;

class RutinaController extends Controller
{
    public function index(Request $request)
    {
        return view("app.rutinas.index");
    }

    public function detalle($id, $tipo, $fecha = null, Request $request)
    {
        if ($tipo === 'unica') {
            $clase = HorarioClaseUnica::with(['clase', 'instructor'])
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            $reserva = Reserva::where("horario_clase_id", $clase->id)
                ->where("cliente_id", Auth::user()->id)
                ->where("estado", "Reservada")
                ->where("tipo_clase", "unica")
                ->get()->last();

        } elseif ($tipo === 'recurrente') {
            $clase = ClaseRecurrente::with(['clase', 'instructor'])
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            $reserva = Reserva::where("fecha_reserva", $fecha . " " . $clase->hora)
                ->where("estado", "Reservada")
                ->where("cliente_id", Auth::user()->id)
                ->where("tipo_clase", "recurrente")
                ->get()->last();

            $fecha = $fecha . " " . $clase->hora;
            $clase->fecha = $fecha;
        }

        if (!$clase) {
            abort(404, 'Clase no encontrada');
        }

        $backpack = [
            "clase"   => $clase,
            "tipo"    => $tipo,
            "reserva" => $reserva
        ];

        return view('app.clases.detalles', $backpack);
    }

    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}

    public function destroy($id)
    {
        // Busca solo rutinas que pertenezcan al usuario logueado
        // Las rutinas generales no tienen user_id del usuario → firstOrFail lanza 404
        $rutina = Rutina::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        // Eliminar ejercicios asociados si tiene relación
        if (method_exists($rutina, 'ejercicios')) {
            $rutina->ejercicios()->delete();
        }

        $rutina->delete();

        return response()->json(['message' => 'Rutina eliminada correctamente.']);
    }
}