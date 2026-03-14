<?php

namespace App\Http\Controllers\API;

use App\Models\Reserva;
use App\Models\HorarioClaseUnica;
use App\Models\ClaseRecurrente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservaApiController extends Controller
{
    /**
     * Obtener fecha/hora de inicio de la clase según tipo
     */
    private function getFechaHoraClase($clase, string $tipo, string $fecha_clase): Carbon
    {
        if ($tipo === 'unica') {
            return Carbon::parse($clase->fecha_hora);
        }
        return Carbon::parse($fecha_clase . ' ' . $clase->hora);
    }

    /**
     * Validar que falten más de 5 horas para la clase
     */
    private function validarVentana5Horas(Carbon $fechaHoraClase): bool
    {
        return Carbon::now()->diffInHours($fechaHoraClase, false) >= 5;
    }

    /**
     * Contar reservas activas para una clase en una fecha
     */
    private function contarReservas($horario_clase_id, string $tipo, string $fecha_clase): int
    {
        $query = Reserva::where('horario_clase_id', $horario_clase_id)
            ->where('tipo_clase', $tipo)
            ->where('estado', 'Reservada');

        if ($tipo === 'recurrente') {
            $query->whereDate('fecha_reserva', $fecha_clase);
        }

        return $query->count();
    }

    /**
     * Crear reserva
     */
    public function store(Request $request)
    {
        $request->validate([
            'horario_clase_id' => 'required|integer',
            'fecha_reserva'    => 'required|date',
            'tipo_clase'       => 'required|in:unica,recurrente'
        ]);

        $usuario = $request->user();
        $tipo    = $request->tipo_clase;
        $fecha   = $request->fecha_reserva;

        // Obtener clase según tipo
        $clase = $tipo === 'unica'
            ? HorarioClaseUnica::findOrFail($request->horario_clase_id)
            : ClaseRecurrente::findOrFail($request->horario_clase_id);

        // Validar ventana de 5 horas
        $fechaHoraClase = $this->getFechaHoraClase($clase, $tipo, $fecha);

        if (!$this->validarVentana5Horas($fechaHoraClase)) {
            return response()->json([
                'message' => 'Solo puedes reservar con al menos 5 horas de anticipación.'
            ], 422);
        }

        // Evitar reservas duplicadas
        $query = Reserva::where('cliente_id', $usuario->id)
            ->where('horario_clase_id', $request->horario_clase_id)
            ->where('tipo_clase', $tipo)
            ->where('estado', 'Reservada');

        if ($tipo === 'recurrente') {
            $query->whereDate('fecha_reserva', $fecha);
        }

        if ($query->exists()) {
            return response()->json([
                'message' => 'Ya tienes una reserva activa para esta clase.'
            ], 422);
        }

        // Fecha de reserva formateada
        $fechaReserva = $tipo === 'unica'
            ? $clase->fecha_hora
            : $fecha . ' ' . $clase->hora;

        // Crear reserva con transacción y bloqueo contra condición de carrera
        try {
            DB::transaction(function () use ($request, $clase, $tipo, $fecha, $fechaReserva, $usuario) {

                $reservasContadas = Reserva::where('horario_clase_id', $request->horario_clase_id)
                    ->where('tipo_clase', $tipo)
                    ->where('estado', 'Reservada')
                    ->when($tipo === 'recurrente', fn($q) => $q->whereDate('fecha_reserva', $fecha))
                    ->lockForUpdate()
                    ->count();

                if ($reservasContadas >= $clase->cupo_maximo) {
                    throw new \Exception('No hay cupos disponibles para esta clase.');
                }

                Reserva::create([
                    'cliente_id'       => $usuario->id,
                    'horario_clase_id' => $request->horario_clase_id,
                    'tipo_clase'       => $tipo,
                    'fecha_reserva'    => $fechaReserva,
                    'estado'           => 'Reservada'
                ]);
            });

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Reserva realizada correctamente. Puedes cancelar hasta 5 horas antes de la clase.'
        ], 201);
    }

    /**
     * Cancelar reserva
     */
    public function cancelarReserva(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $reserva = Reserva::find($request->id);

        if (!$reserva) {
            return response()->json(['message' => 'Reserva no encontrada.'], 404);
        }

        // Verificar que la reserva pertenece al usuario
        if ($reserva->cliente_id !== $request->user()->id) {
            return response()->json(['message' => 'No tienes permiso para cancelar esta reserva.'], 403);
        }

        if ($reserva->estado !== 'Reservada') {
            return response()->json(['message' => 'Esta reserva ya fue cancelada o completada.'], 422);
        }

        // Obtener clase para validar las 5 horas
        $clase = $reserva->tipo_clase === 'unica'
            ? HorarioClaseUnica::find($reserva->horario_clase_id)
            : ClaseRecurrente::find($reserva->horario_clase_id);

        if (!$clase) {
            return response()->json(['message' => 'Clase no encontrada.'], 404);
        }

        $fechaHoraClase = $this->getFechaHoraClase(
            $clase,
            $reserva->tipo_clase,
            Carbon::parse($reserva->fecha_reserva)->toDateString()
        );

        if (!$this->validarVentana5Horas($fechaHoraClase)) {
            return response()->json([
                'message' => 'No puedes cancelar con menos de 5 horas de anticipación.'
            ], 422);
        }

        $reserva->estado = 'Cancelada';
        $reserva->save();

        return response()->json(['message' => 'Reserva cancelada correctamente.']);
    }

    /**
     * Aplazar reserva
     */
    public function aplazarReserva(Request $request)
    {
        $request->validate([
            'id'          => 'required|integer',
            'nueva_fecha' => 'required|date'
        ]);

        $reserva = Reserva::find($request->id);

        if (!$reserva) {
            return response()->json(['message' => 'Reserva no encontrada.'], 404);
        }

        if ($reserva->cliente_id !== $request->user()->id) {
            return response()->json(['message' => 'No tienes permiso para aplazar esta reserva.'], 403);
        }

        if ($reserva->estado !== 'Reservada') {
            return response()->json(['message' => 'Solo puedes aplazar reservas activas.'], 422);
        }

        if ($reserva->tipo_clase !== 'recurrente') {
            return response()->json(['message' => 'Solo se pueden aplazar clases recurrentes.'], 422);
        }

        $clase = ClaseRecurrente::find($reserva->horario_clase_id);

        if (!$clase) {
            return response()->json(['message' => 'Clase no encontrada.'], 404);
        }

        // Validar 5 horas sobre la clase actual
        $fechaActual     = Carbon::parse($reserva->fecha_reserva)->toDateString();
        $fechaHoraActual = $this->getFechaHoraClase($clase, 'recurrente', $fechaActual);

        if (!$this->validarVentana5Horas($fechaHoraActual)) {
            return response()->json([
                'message' => 'No puedes aplazar con menos de 5 horas de anticipación.'
            ], 422);
        }

        // Validar que la nueva fecha tenga más de 5 horas
        $fechaHoraNueva = $this->getFechaHoraClase($clase, 'recurrente', $request->nueva_fecha);

        if (!$this->validarVentana5Horas($fechaHoraNueva)) {
            return response()->json([
                'message' => 'La nueva fecha debe ser al menos 5 horas en el futuro.'
            ], 422);
        }

        // Verificar duplicado en nueva fecha
        $duplicado = Reserva::where('cliente_id', $reserva->cliente_id)
            ->where('horario_clase_id', $reserva->horario_clase_id)
            ->where('tipo_clase', 'recurrente')
            ->where('estado', 'Reservada')
            ->whereDate('fecha_reserva', $request->nueva_fecha)
            ->exists();

        if ($duplicado) {
            return response()->json([
                'message' => 'Ya tienes una reserva activa para esa fecha.'
            ], 422);
        }

        // Verificar cupos en nueva fecha con transacción
        try {
            DB::transaction(function () use ($request, $reserva, $clase) {

                $reservasNuevaFecha = Reserva::where('horario_clase_id', $reserva->horario_clase_id)
                    ->where('tipo_clase', 'recurrente')
                    ->where('estado', 'Reservada')
                    ->whereDate('fecha_reserva', $request->nueva_fecha)
                    ->lockForUpdate()
                    ->count();

                if ($reservasNuevaFecha >= $clase->cupo_maximo) {
                    throw new \Exception('No hay cupos disponibles en la nueva fecha.');
                }

                // Cancelar reserva actual y crear nueva
                $reserva->estado = 'Cancelada';
                $reserva->save();

                Reserva::create([
                    'cliente_id'       => $reserva->cliente_id,
                    'horario_clase_id' => $reserva->horario_clase_id,
                    'tipo_clase'       => 'recurrente',
                    'fecha_reserva'    => $request->nueva_fecha . ' ' . $clase->hora,
                    'estado'           => 'Reservada'
                ]);
            });

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Reserva aplazada correctamente para el ' . $request->nueva_fecha . '.'
        ]);
    }

    /**
     * Obtener reserva activa del usuario para una clase/fecha específica
     */
    public function reserva_clase_usuario(Request $request)
    {
        $request->validate([
            'horario_clase_id' => 'required|integer',
            'fecha_reserva'    => 'required|date',
            'tipo_clase'       => 'required|in:unica,recurrente'
        ]);

        $tipo  = $request->tipo_clase;
        $fecha = $request->fecha_reserva;

        $query = Reserva::where('cliente_id', $request->user()->id)
            ->where('horario_clase_id', $request->horario_clase_id)
            ->where('tipo_clase', $tipo)
            ->where('estado', 'Reservada');

        if ($tipo === 'recurrente') {
            $query->whereDate('fecha_reserva', $fecha);
        }

        return response()->json($query->first());
    }

    /**
     * Mis reservas
     */
    public function misReservas(Request $request)
    {
        $usuario = $request->user();

        $reservas = Reserva::where('cliente_id', $usuario->id)
            ->orderBy('fecha_reserva', 'desc')
            ->get()
            ->map(function ($reserva) {
                if ($reserva->tipo_clase === 'unica') {
                    $clase      = HorarioClaseUnica::with('clase', 'instructor')->find($reserva->horario_clase_id);
                    $nombre     = optional(optional($clase)->clase)->nombre ?? 'Clase sin nombre';
                    $instructor = optional(optional($clase)->instructor)->nombre ?? 'Sin instructor';
                    $hora       = $clase ? Carbon::parse($clase->fecha_hora)->format('H:i') : '--';
                } else {
                    $clase      = ClaseRecurrente::with('clase', 'instructor')->find($reserva->horario_clase_id);
                    $nombre     = optional(optional($clase)->clase)->nombre ?? 'Clase sin nombre';
                    $instructor = optional(optional($clase)->instructor)->nombre ?? 'Sin instructor';
                    $hora       = $clase ? $clase->hora : '--';
                }

                return [
                    'id'               => $reserva->id,
                    'nombre_clase'     => $nombre,
                    'instructor'       => $instructor,
                    'hora'             => $hora,
                    'fecha_reserva'    => Carbon::parse($reserva->fecha_reserva)->format('Y-m-d'),
                    'fecha_completa'   => Carbon::parse($reserva->fecha_reserva)->format('d/m/Y H:i'),
                    'estado'           => $reserva->estado,
                    'tipo_clase'       => $reserva->tipo_clase,
                    'horario_clase_id' => $reserva->horario_clase_id,
                    'cancelable'       => $reserva->estado === 'Reservada' &&
                                         Carbon::now()->diffInHours(Carbon::parse($reserva->fecha_reserva), false) >= 5,
                    'aplazable'        => $reserva->estado === 'Reservada' &&
                                         $reserva->tipo_clase === 'recurrente' &&
                                         Carbon::now()->diffInHours(Carbon::parse($reserva->fecha_reserva), false) >= 5,
                ];
            });

        return response()->json($reservas);
    }
}