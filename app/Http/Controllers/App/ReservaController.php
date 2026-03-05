<?php

namespace App\Http\Controllers\App;

use App\Models\Reserva;
use App\Models\HorarioClaseUnica;
use App\Models\ClaseRecurrente;
use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\Controller;
use Flash;
use Carbon\Carbon;

class ReservaController extends Controller
{
   

   public function store(Request $request)
{
    $fechaClase = Carbon::parse($request->fecha_reserva);

    // 1️⃣ No permitir reservar clases pasadas
    if ($fechaClase->lt(Carbon::now())) {
        Flash::error("No puedes reservar una clase que ya pasó.");
        return redirect()->back();
    }

    // 2️⃣ No permitir reservas duplicadas
    $existe = Reserva::where("cliente_id", Auth::id())
        ->where("horario_clase_id", $request->horario_clase_id)
        ->where("tipo_clase", $request->tipo)
        ->whereDate("fecha_reserva", $fechaClase->format("Y-m-d"))
        ->where("estado", "Reservada")
        ->exists();

    if ($existe) {
        Flash::warning("Ya estás inscrito en esta clase.");
        return redirect()->back();
    }

    // 3️⃣ Validar cupos disponibles
    if ($request->tipo == "unica") {

        $clase = HorarioClaseUnica::findOrFail($request->horario_clase_id);

        $reservas = Reserva::where("horario_clase_id", $clase->id)
            ->where("tipo_clase", "unica")
            ->where("estado", "Reservada")
            ->count();

    } else {

        $clase = ClaseRecurrente::findOrFail($request->horario_clase_id);

        $reservas = Reserva::where("horario_clase_id", $clase->id)
            ->where("tipo_clase", "recurrente")
            ->whereDate("fecha_reserva", $fechaClase->format("Y-m-d"))
            ->where("estado", "Reservada")
            ->count();
    }

    if ($reservas >= $clase->cupo_maximo) {
        Flash::error("Esta clase ya está llena.");
        return redirect()->back();
    }

    // 4️⃣ Crear la reserva
    $reserva = new Reserva();
    $reserva->cliente_id = Auth::id();
    $reserva->horario_clase_id = $request->horario_clase_id;
    $reserva->fecha_reserva = $fechaClase;
    $reserva->tipo_clase = $request->tipo;
    $reserva->estado = 'Reservada';
    $reserva->save();

    Flash::success("Reserva realizada correctamente");

    return redirect()->back();
}
   
}
