<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\ClaseRecurrente;
use App\Models\HorarioClaseUnica;
use App\Models\Reserva;
use Carbon\Carbon;

class EjercicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       

        return view("app.ejercicio.index");
    }



    public function detalle($id, $tipo, $fecha=null, Request $request)
    {
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
                

                $reserva = Reserva::where("fecha_reserva",$fecha." ".$clase->hora)
                ->where("estado","Reservada")
                ->where("cliente_id",Auth::user()->id)
                ->where("tipo_clase","recurrente")
                ->get()->last();
                

                $fecha = $fecha. " ".$clase->hora;
                $clase->fecha = $fecha;
        }

       
        

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
