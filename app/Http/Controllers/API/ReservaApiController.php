<?php

namespace App\Http\Controllers\API;

use App\Models\Reserva;
use App\Models\HorarioClaseUnica;
use App\Models\ClaseRecurrente;
use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\Controller;
use Flash;

class ReservaApiController extends Controller
{
   

    public function store(Request $request)
    {

       
        $clase = ClaseRecurrente::find($request->horario_clase_id);
        
        
        if($request->cancelar_reserva){

            if($request->tipo=="unica"){
                $reserva = Reserva::where("horario_clase_id",$request->horario_clase_id)
                ->where("cliente_id",Auth::user()->id)
                ->where("estado","Reservada")
                ->where("tipo_clase","unica")
                ->get()->last();
            }else{
                $reserva = Reserva::where("fecha_reserva",$request->fecha_reserva)
                ->where("cliente_id",Auth::user()->id)
                ->where("estado","Reservada")
                ->where("tipo_clase","recurrente")
                ->get()->last();
            }

            $reserva->estado = "Cancelada";
            $reserva->save();

            Flash::success("Usted ha cancelado la reservación a la clase correctamente");
            return redirect()->back();
            
        }
         // Crear la reserva
         $reserva = new Reserva();
         $reserva->cliente_id = request()->user()->id;
         $reserva->horario_clase_id = $request->horario_clase_id;
         $reserva->fecha_reserva = "{$request->fecha_reserva} {$clase->hora}"; // Puede ser nula si es una clase úna
         $reserva->tipo_clase = $request->tipo_clase;
         $reserva->save();

         return response()->json(['message' => 'Inscripción exitosa. Puedes comprar productos y cancelar si no asistes.']);

        

        /* // Validar cupos disponibles
        if ($reservasContadas >= $horario->cupo_maximo) {
            return response()->json(['message' => 'No hay cupos disponibles para esta clase.'], 400);
        } */

        // Crear la reserva
   

        return response()->json($reserva, 201);
    }

    public function reserva_clase_usuario(Request $request){
        $clase = ClaseRecurrente::find($request->horario_clase_id);
        
        $reserva_user = Reserva::where("fecha_reserva",$request->fecha_reserva." ".$clase->hora)
        ->where("estado","Reservada")
        ->where("cliente_id",request()->user()->id)
        ->where("tipo_clase","recurrente")
        ->get()->last();

        return response()->json($reserva_user);
    }


    public function cancelarReserva(Request $request)
    {
        try {
            $reserva = Reserva::find($request->input('id'));
            $reserva->estado = "Cancelada";
            $reserva->save();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al cancelar la reserva'], 400);
        }
       

        return response()->json(['message' => 'Reserva cancelada correctamente'], 200);
    }

}
