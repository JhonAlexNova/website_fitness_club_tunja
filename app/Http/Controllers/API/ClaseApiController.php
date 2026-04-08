<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClaseRecurrente;
use App\Models\HorarioClaseUnica;
use App\Models\Reserva;
use Carbon\Carbon;

class ClaseApiController extends Controller
{
    public function index(Request $request)
    {
        $fecha_inicio = $request->query('fecha_inicio', Carbon::now()->startOfWeek()->toDateString());
        $fecha_fin    = $request->query('fecha_fin', Carbon::now()->endOfWeek()->toDateString());

        $horariosUnicas = HorarioClaseUnica::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->whereBetween('fecha_hora', [$fecha_inicio . ' 00:00:00', $fecha_fin . ' 23:59:59'])
            ->get()
            ->map(function ($horario) {
                $reservasContadas = Reserva::where('horario_clase_id', $horario->id)
                    ->where('tipo_clase', 'unica')
                    ->where('estado', 'Reservada')
                    ->count();

                return [
                    'id'          => $horario->id,
                    'tipo'        => 'unica',
                    'name'        => optional($horario->clase)->nombre ?? 'Clase sin nombre',
                    'trainer'     => optional($horario->instructor)->nombre ?? 'Instructor desconocido',
                    'startTime'   => Carbon::parse($horario->fecha_hora)->format('H:i'),
                    'endTime'     => Carbon::parse($horario->fecha_hora)->addMinutes(optional($horario->clase)->duracion ?? 60)->format('H:i'),
                    'dayOfWeek'   => Carbon::parse($horario->fecha_hora)->dayOfWeekIso,
                    'capacity'    => $horario->cupo_maximo,
                    'enrolled'    => $reservasContadas,
                    'description' => optional($horario->clase)->descripcion ?? 'Sin descripción.',
                    'imagen'      => optional($horario->clase)->imagen ? url('storage/' . $horario->clase->imagen) : null,
                ];
            });

        $horariosRecurrentes = ClaseRecurrente::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->get()
            ->flatMap(function ($recurrente) use ($fecha_inicio, $fecha_fin) {
                $eventos = [];

                $fecha = Carbon::parse($fecha_inicio)->startOfWeek()->addDays($recurrente->dia_semana - 1);

                if ($fecha->between(Carbon::parse($fecha_inicio), Carbon::parse($fecha_fin))) {
                    $reservasContadas = Reserva::where('horario_clase_id', $recurrente->id)
                        ->where('tipo_clase', 'recurrente')
                        ->where('estado', 'Reservada')
                        ->whereDate('fecha_reserva', $fecha->format('Y-m-d'))
                        ->count();

                    $eventos[] = [
                        'id'          => $recurrente->id,
                        'tipo'        => 'recurrente',
                        'name'        => optional($recurrente->clase)->nombre ?? 'Clase sin nombre',
                        'trainer'     => optional($recurrente->instructor)->nombre ?? 'Instructor desconocido',
                        'startTime'   => $recurrente->hora,
                        'endTime'     => Carbon::parse($recurrente->hora)->addMinutes($recurrente->duracion)->format('H:i'),
                        'dayOfWeek'   => $fecha->dayOfWeekIso,
                        'capacity'    => $recurrente->cupo_maximo,
                        'enrolled'    => $reservasContadas,
                        'description' => optional($recurrente->clase)->descripcion ?? 'Sin descripción.',
                        'imagen'      => optional($recurrente->clase)->imagen ? url('storage/' . $recurrente->clase->imagen) : null,
                    ];
                }

                return $eventos;
            });

        $clases = collect($horariosUnicas)->merge($horariosRecurrentes)->values();

        return response()->json($clases);
    }

    public function show($id, $fechaBusqueda)
    {
        $recurrente = ClaseRecurrente::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->find($id);

        if ($recurrente) {
            $fechaClase      = Carbon::parse($fechaBusqueda);
            $fechaHoraInicio = Carbon::parse($fechaBusqueda . ' ' . $recurrente->hora);
            $fechaHoraFin    = $fechaHoraInicio->copy()->addMinutes($recurrente->duracion);
            $ahora           = Carbon::now();

            if ($ahora->lt($fechaHoraInicio)) {
                $status = 'Abierta'; // ← LÍNEA 93 (antes era: $horasRestantes >= 5 ? 'Abierta' : 'Proxima')
            } elseif ($ahora->between($fechaHoraInicio, $fechaHoraFin)) {
                $status = 'En proceso';
            } else {
                $status = 'Cerrada';
            }

            $reservasContadas = Reserva::where('horario_clase_id', $recurrente->id)
                ->where('tipo_clase', 'recurrente')
                ->where('estado', 'Reservada')
                ->whereDate('fecha_reserva', $fechaClase->format('Y-m-d'))
                ->count();

            return response()->json([
                'id'          => $recurrente->id,
                'tipo'        => 'recurrente',
                'name'        => optional($recurrente->clase)->nombre ?? 'Clase sin nombre',
                'trainer'     => optional($recurrente->instructor)->nombre ?? 'Instructor desconocido',
                'startTime'   => $recurrente->hora,
                'endTime'     => $fechaHoraFin->format('H:i'),
                'dayOfWeek'   => $fechaClase->dayOfWeekIso,
                'capacity'    => $recurrente->cupo_maximo,
                'enrolled'    => $reservasContadas,
                'status'      => $status,
                'description' => optional($recurrente->clase)->descripcion ?? 'Sin descripción.',
                'imagen'      => optional($recurrente->clase)->imagen ? url('storage/' . $recurrente->clase->imagen) : null,
            ]);
        }

        $unica = HorarioClaseUnica::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->find($id);

        if ($unica) {
            $fechaHoraInicio = Carbon::parse($unica->fecha_hora);
            $fechaHoraFin    = $fechaHoraInicio->copy()->addMinutes(optional($unica->clase)->duracion ?? 60);
            $ahora           = Carbon::now();

            if ($ahora->lt($fechaHoraInicio)) {
                $status = 'Abierta'; // ← LÍNEA 132 (antes era: $horasRestantes >= 5 ? 'Abierta' : 'Proxima')
            } elseif ($ahora->between($fechaHoraInicio, $fechaHoraFin)) {
                $status = 'En proceso';
            } else {
                $status = 'Cerrada';
            }

            $reservasContadas = Reserva::where('horario_clase_id', $unica->id)
                ->where('tipo_clase', 'unica')
                ->where('estado', 'Reservada')
                ->count();

            return response()->json([
                'id'          => $unica->id,
                'tipo'        => 'unica',
                'name'        => optional($unica->clase)->nombre ?? 'Clase sin nombre',
                'trainer'     => optional($unica->instructor)->nombre ?? 'Instructor desconocido',
                'startTime'   => $fechaHoraInicio->format('H:i'),
                'endTime'     => $fechaHoraFin->format('H:i'),
                'dayOfWeek'   => $fechaHoraInicio->dayOfWeekIso,
                'capacity'    => $unica->cupo_maximo,
                'enrolled'    => $reservasContadas,
                'status'      => $status,
                'description' => optional($unica->clase)->descripcion ?? 'Sin descripción.',
                'imagen'      => optional($unica->clase)->imagen ? url('storage/' . $unica->clase->imagen) : null,
            ]);
        }

        return response()->json(['message' => 'Clase no encontrada.'], 404);
    }
}