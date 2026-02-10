<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\ClaseRecurrente;
use App\Models\HorarioClaseUnica;
use App\Models\Reserva;
use Carbon\Carbon;

class ClaseApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fecha_inicio = $request->query('fecha_inicio', Carbon::now()->startOfWeek()->toDateString());
        $fecha_fin = $request->query('fecha_fin', Carbon::now()->endOfWeek()->toDateString());
    
        // Obtener clases únicas
        $horariosUnicas = HorarioClaseUnica::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->whereBetween('fecha_hora', [$fecha_inicio, $fecha_fin])
            ->get()
            ->map(function ($horario) {
                $reservasContadas = Reserva::where('horario_clase_id', $horario->id)
                    ->where('tipo_clase', 'unica')
                    ->count();
    
                return [
                    'id' => $horario->id,
                    'name' => $horario->clase->nombre ?? 'Clase sin nombre',
                    'trainer' => $horario->instructor->nombre ?? 'Instructor desconocido',
                    'startTime' => Carbon::parse($horario->fecha_hora)->format('H:i'),
                    'endTime' => Carbon::parse($horario->fecha_hora)->addMinutes($horario->clase->duracion)->format('H:i'),
                    'dayOfWeek' => Carbon::parse($horario->fecha_hora)->dayOfWeekIso,
                    'capacity' => $horario->cupo_maximo,
                    'enrolled' => $reservasContadas,
                    'room' => $horario->clase->sala ?? 'Sala no asignada',
                    'level' => $horario->clase->nivel ?? 'Desconocido',
                    'description' => $horario->clase->descripcion ?? 'Sin descripción disponible.',
                ];
            });
    
        // Obtener clases recurrentes
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
                            'name' => optional($recurrente->clase)->nombre ?? 'Clase sin nombre',
                            'trainer' => optional($recurrente->instructor)->nombre ?? 'Instructor desconocido',
                            'startTime' => $recurrente->hora,
                            'endTime' => Carbon::parse($recurrente->hora)->addMinutes($recurrente->duracion)->format('H:i'),
                            'dayOfWeek' => $fecha->dayOfWeekIso,
                            'capacity' => $recurrente->cupo_maximo,
                            'enrolled' => $reservasContadas,
                            'room' => optional($recurrente->clase)->sala ?? 'Sala no asignada',
                            'level' => optional($recurrente->clase)->nivel ?? 'Desconocido',
                            'description' => optional($recurrente->clase)->descripcion ?? 'Sin descripción disponible.',
                        ];
                    }
                }
                return $eventos;
            });
    
        // Fusionar ambas listas
        //$clases = collect($horariosUnicas)->merge($horariosRecurrentes)->values();
        $clases = collect($horariosRecurrentes)->values();

    
        return response()->json($clases);
    }


    public function show($id, $fechaBusqueda)
    {
        $fecha_actual = Carbon::now();
        $fecha_inicio = $fecha_actual->startOfWeek()->toDateString();
        $fecha_fin = $fecha_actual->endOfWeek()->toDateString();
    
        $clase = ClaseRecurrente::with(['clase', 'instructor'])
            ->whereNull('deleted_at')
            ->where('id', $id)
            ->get()
            ->flatMap(function ($recurrente) use ($fecha_actual, $fecha_inicio, $fecha_fin, $fechaBusqueda) {
                $eventos = [];
    
                for ($i = 0; $i < 20; $i++) {
                    $fecha = Carbon::parse($fecha_inicio)
                        ->startOfWeek()
                        ->addDays($recurrente->dia_semana - 1)
                        ->addWeeks($i);
    
                    if ($fecha->between(Carbon::parse($fecha_inicio), Carbon::parse($fecha_fin))) {
                        $hora_inicio = Carbon::parse($fecha->format('Y-m-d') . ' ' . $recurrente->hora);
                        $hora_fin = $hora_inicio->copy()->addMinutes($recurrente->duracion);

                        $fechayHoraHoy = Carbon::now(); // Fecha y hora actual
                        $fechaInicioClase = Carbon::parse($fechaBusqueda . ' ' . $recurrente->hora);
                        $fechaFinClase = $fechaInicioClase->copy()->addMinutes($recurrente->duracion); // Calcula la hora de fin
                        
                        if ($fechayHoraHoy->lt($fechaInicioClase)) {
                            $status = 'Abierta'; // Antes de que inicie
                        } elseif ($fechayHoraHoy->between($fechaInicioClase, $fechaFinClase)) {
                            $status = 'En proceso'; // La clase ya inició pero no ha terminado
                        } else {
                            $status = 'Cerrada'; // La clase ya terminó
                        }


    
                        // Determinar si la clase está abierta o cerrada
                       // $status = $fecha_actual->greaterThanOrEqualTo($hora_inicio) ? 'Cerrada' : 'Abierta';
    
                        $reservasContadas = Reserva::where('horario_clase_id', $recurrente->id)
                            ->where('tipo_clase', 'recurrente')
                            ->where('estado', 'Reservada')
                            ->whereDate('fecha_reserva', $fecha->format('Y-m-d'))
                            ->count();
    
                        $eventos[] = [
                            'id' => $recurrente->id,
                            'name' => optional($recurrente->clase)->nombre ?? 'Clase sin nombre',
                            'trainer' => optional($recurrente->instructor)->nombre ?? 'Instructor desconocido',
                            'startTime' => $recurrente->hora,
                            'endTime' => $hora_fin->format('H:i'),
                            'dayOfWeek' => $fecha->dayOfWeekIso,
                            'capacity' => $recurrente->cupo_maximo,
                            'enrolled' => $reservasContadas,
                            'room' => optional($recurrente->clase)->sala ?? 'Sala no asignada',
                            'level' => optional($recurrente->clase)->nivel ?? 'Desconocido',
                            'description' => optional($recurrente->clase)->descripcion ?? 'Sin descripción disponible.',
                            'status' => $status, // Agregar el estado de la clase
                        ];
                    }
                }
                return $eventos;
            });
    
        if ($clase->isEmpty()) {
            return response()->json(['message' => 'Clase no encontrada'], 404);
        }
    
        return response()->json($clase->values()->first()); // Devolver solo la primera coincidencia
    }
    

    



    public function detalle($id, $tipo, $fecha=null, Request $request)
    {
        $fechaFormateada = Carbon::parse('2025-02-25'); // Convertir string a Carbon
        
        // Aquí puedes agregar la lógica para obtener los detalles de la clase
        
        if ($tipo === 'unica') {
            $clase = HorarioClaseUnica::with(['clase', 'instructor'])
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

                $reserva = Reserva::where("horario_clase_id",$clase->id)
                ->where("cliente_id",Auth::user()->id)
                ->where("estado","Reservada")
                ->where("tipo_clase","unica")
                ->get()->last();

        } elseif ($tipo === 'recurrente') {
            $clase = ClaseRecurrente::with(['clase', 'instructor'])
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

               // dd($clase);

                $reservasContadas = Reserva::where('horario_clase_id', $id)
                    ->where('tipo_clase', 'recurrente')
                    ->where('estado', 'Reservada')
                    ->whereDate('fecha_reserva', $fechaFormateada->format('Y-m-d'))
                    ->count();

               // $fechaHora = Carbon::parse("$fecha $clase->hora"); // Asegurar formato correcto

               $clase->cupos_disponibles = $clase->cupo_maximo - $reservasContadas;
               $clase->cantidad_inscritos =  $reservasContadas;
                

                $reserva = Reserva::where("fecha_reserva",$fecha." ".$clase->hora)
                ->where("estado","Reservada")
                ->where("cliente_id",Auth::user()->id)
                ->where("tipo_clase","recurrente")
                ->get()->last();
                

                $fecha = $fecha. " ".$clase->hora;
                $clase->fecha = $fecha;
        }

     // dd($clase);
        

        // Asegúrate de que la clase existe
        if (!$clase) {
            abort(404, 'Clase no encontrada');
        }
        
       // dd($clase);
        
        $backpack = [
          "clase" => $clase,
          "tipo" => $tipo,
          "reserva" => $reserva
        ];

        // Devuelve una vista o un JSON con los detalles
        return view('app.clases.detalles', $backpack);
        // o para JSON
        // return response()->json($clase);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
