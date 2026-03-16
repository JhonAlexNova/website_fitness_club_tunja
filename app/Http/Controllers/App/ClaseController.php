<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\ClaseRecurrente;
use App\Models\HorarioClaseUnica;
use App\Models\Reserva;
use Carbon\Carbon;

class ClaseController extends Controller
{

    public function index(Request $request)
    {
        $fecha_inicio = $request->query('fecha_inicio', Carbon::now()->startOfWeek()->toDateString());
        $fecha_fin = $request->query('fecha_fin', Carbon::now()->endOfWeek()->toDateString());

        $horariosUnicas = HorarioClaseUnica::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->whereBetween('fecha_hora', [$fecha_inicio, $fecha_fin])
            ->get()
            ->map(function ($horario) {

                $fechaClase = Carbon::parse($horario->fecha_hora)->format('Y-m-d');

                $reservasContadas = Reserva::where('horario_clase_id', $horario->id)
                    ->where('tipo_clase', 'unica')
                    ->whereDate('fecha_reserva', $fechaClase)
                    ->where('estado', 'Reservada')
                    ->count();

                return [
                    'id' => $horario->id,
                    'title' => optional($horario->clase)->nombre ?? 'Clase',
                    'start' => $horario->fecha_hora,
                    'end' => Carbon::parse($horario->fecha_hora)->addMinutes(optional($horario->clase)->duracion ?? 60),
                    'instructor' => optional($horario->instructor)->nombre ?? 'Instructor',
                    'cupo_maximo' => $horario->cupo_maximo,
                    'cupos_disponibles' => $horario->cupo_maximo - $reservasContadas,
                    'tipo' => 'unica',
                    'dia_semana' => Carbon::parse($horario->fecha_hora)->locale('es')->isoFormat('dddd'),
                ];
            })
            ->groupBy('dia_semana');


        $horariosRecurrentes = ClaseRecurrente::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->get()
            ->flatMap(function ($recurrente) use ($fecha_inicio, $fecha_fin) {

                $eventos = [];

                for ($i = 0; $i < 20; $i++) {

                    $fecha = Carbon::parse($fecha_inicio)
                        ->startOfWeek()
                        ->addDays($recurrente->dia_semana - 1)
                        ->addWeeks($i);

                    if ($fecha->between(Carbon::parse($fecha_inicio), Carbon::parse($fecha_fin))) {

                        $reservasContadas = Reserva::where('horario_clase_id', $recurrente->id)
                            ->where('tipo_clase', 'recurrente')
                            ->where('estado', 'Reservada')
                            ->whereDate('fecha_reserva', $fecha->format('Y-m-d'))
                            ->count();

                        $eventos[] = [
                            'id' => $recurrente->id,
                            'title' => optional($recurrente->clase)->nombre ?? 'Clase',
                            'start' => $fecha->format('Y-m-d') . ' ' . $recurrente->hora,
                            'end' => $fecha->copy()->addMinutes($recurrente->duracion)->format('Y-m-d H:i:s'),
                            'instructor' => optional($recurrente->instructor)->nombre ?? 'Instructor',
                            'cupo_maximo' => $recurrente->cupo_maximo,
                            'cupos_disponibles' => $recurrente->cupo_maximo - $reservasContadas,
                            'tipo' => 'recurrente',
                            'fecha_reserva' => $fecha->format('Y-m-d'),
                            'dia_semana' => $fecha->locale('es')->isoFormat('dddd'),
                        ];
                    }
                }

                return $eventos;
            })
            ->groupBy('dia_semana');


        $clases = array_merge($horariosUnicas->toArray(), $horariosRecurrentes->toArray());

        return view("app.clases.index", [
            "clases" => $clases
        ]);
    }


    public function detalle($id, $tipo, $fecha = null, Request $request)
    {

        if ($tipo === 'unica') {

            $clase = HorarioClaseUnica::with(['clase', 'instructor'])
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (!$clase) {
                abort(404, 'Clase no encontrada');
            }

            $reserva = Reserva::where("horario_clase_id", $clase->id)
                ->where("cliente_id", Auth::user()->id)
                ->where("estado", "Reservada")
                ->where("tipo_clase", "unica")
                ->latest()
                ->first();
        }

        elseif ($tipo === 'recurrente') {

            $clase = ClaseRecurrente::with(['clase', 'instructor'])
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (!$clase) {
                abort(404, 'Clase no encontrada');
            }

            $fechaFormateada = Carbon::parse($fecha)->format('Y-m-d');

            $reservasContadas = Reserva::where('horario_clase_id', $id)
                ->where('tipo_clase', 'recurrente')
                ->where('estado', 'Reservada')
                ->whereDate('fecha_reserva', $fechaFormateada)
                ->count();

            $clase->cupos_disponibles = $clase->cupo_maximo - $reservasContadas;
            $clase->cantidad_inscritos = $reservasContadas;

            $reserva = Reserva::whereDate("fecha_reserva", $fechaFormateada)
                ->where("estado", "Reservada")
                ->where("cliente_id", Auth::user()->id)
                ->where("tipo_clase", "recurrente")
                ->where("horario_clase_id", $clase->id)
                ->first();

            $clase->fecha = $fechaFormateada . " " . $clase->hora;
        }

        return view('app.clases.detalles', [
            "clase" => $clase,
            "tipo" => $tipo,
            "reserva" => $reserva
        ]);
    }


    public function create(){}

    public function store(Request $request){}

    public function show($id){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}
}