<?php

namespace App\Http\Controllers\App;

use App\Models\Reserva;
use App\Models\HorarioClaseUnica;
use App\Models\ClaseRecurrente;
use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\Controller;
use Flash;

class ReservaController extends Controller
{
   

    public function store(Request $request)
    {

       
        
        
       
         // Crear la reserva
         $reserva = new Reserva();
         $reserva->cliente_id = Auth::user()->id;
         $reserva->horario_clase_id = $request->input('horario_clase_id');
         $reserva->fecha_reserva = $request->input('fecha_reserva'); // Puede ser nula si es una clase única
         $reserva->tipo_clase = $request->input('tipo');
         $reserva->save();

         Flash::success("Usted se a inscrito correctamente a la clase, no olvide cancelarla en caso de no poder asistir");


         return redirect()->back();
   

        return response()->json($reserva, 201);
    }


   
}
