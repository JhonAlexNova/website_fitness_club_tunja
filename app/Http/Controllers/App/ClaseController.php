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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fecha_inicio = $request->query('fecha_inicio', Carbon::now()->startOfWeek()->toDateString());
        $fecha_fin = $request->query('fecha_fin', Carbon::now()->endOfWeek()->toDateString());
        
        


        $horariosUnicas = HorarioClaseUnica::with(['clase', 'instructor'])
        ->whereNull('deleted_at') // Ignorar las eliminadas
        ->whereBetween('fecha_hora', [$fecha_inicio, $fecha_fin]) // Filtrar por rango de fechas
        ->get()
        ->map(function ($horario) {
            $reservasContadas = Reserva::where('horario_clase_id', $horario->id)
                ->where('tipo_clase', 'unica')
                ->count();

            return [
                'id' => $horario->id,
                'title' => $horario->clase->nombre,
                'start' => $horario->fecha_hora,
                'end' => Carbon::parse($horario->fecha_hora)->addMinutes($horario->clase->duracion),
                'instructor' => $horario->instructor->nombre,
                'cupo_maximo' => $horario->cupo_maximo,
                'cupos_disponibles' => $horario->cupo_maximo - $reservasContadas, // Calcular cupos disponibles
                'tipo' => 'unica', // Agregar el tipo de clase
                'dia_semana' => Carbon::parse($horario->fecha_hora)->locale('es')->isoFormat('dddd'), // Día de la semana en español
            ];
        })
        ->groupBy('dia_semana'); // Agrupar por día de la semana

    // Si necesitas convertirlo a un array para usarlo en JSON o en una vista
    $horariosAgrupados = $horariosUnicas->toArray();

    $horariosRecurrentes = ClaseRecurrente::with(['clase', 'instructor'])
    ->whereNull('deleted_at')  // Ignorar eliminadas
    ->get()
    ->flatMap(function ($recurrente) use ($fecha_inicio, $fecha_fin) {
        $eventos = [];

        for ($i = 0; $i < 20; $i++) {
            $fecha = Carbon::parse($fecha_inicio)
                ->startOfWeek() // Ir al lunes de la semana de fecha_inicio
                ->addDays($recurrente->dia_semana - 1) // Ajustar al día correcto
                ->addWeeks($i); // Avanzar semanas

            // Verificar si la fecha está en el rango
            if ($fecha->between(Carbon::parse($fecha_inicio), Carbon::parse($fecha_fin))) {
                $reservasContadas = Reserva::where('horario_clase_id', $recurrente->id)
                    ->where('tipo_clase', 'recurrente')
                    ->where('estado', 'Reservada')
                    ->whereDate('fecha_reserva', $fecha->format('Y-m-d'))
                    ->count();

                $eventos[] = [
                    'id' => $recurrente->id,
                    'title' => optional($recurrente->clase)->nombre ?? 'Clase sin nombre',
                    'start' => $fecha->format('Y-m-d') . ' ' . $recurrente->hora,
                    'end' => $fecha->copy()->addMinutes($recurrente->duracion)->format('Y-m-d H:i:s'),
                    'instructor' => optional($recurrente->instructor)->nombre ?? 'Instructor desconocido',
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


// Convertir a array si es necesario
$horariosAgrupadosRecurrentes = $horariosRecurrentes->toArray();


    

        $clases = array_merge($horariosUnicas->toArray(), $horariosRecurrentes->toArray());

            $backpack = [
                "clases" => $clases
            ];


        return view("app.clases.index",$backpack);
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
    public function show($id)
    {
        //
    }

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
