<?php

namespace App\Http\Controllers\App;

use App\Models\Reserva;
use App\Models\HorarioClaseUnica;
use App\Models\ClaseRecurrente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

use App\Http\Controllers\Controller;
use Flash;
use Carbon\Carbon;

class ReservaController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'horario_clase_id' => 'required|integer',
            'tipo' => 'required|in:unica,recurrente',
            'fecha_reserva' => 'required|date'
        ]);

        $fechaClase = Carbon::parse($request->fecha_reserva);

        // 1️⃣ No permitir reservar clases pasadas
        if ($fechaClase->lt(Carbon::today())) {
            Flash::error("No puedes reservar una clase que ya pasó.");
            return redirect()->back();
        }

        DB::beginTransaction();

        try {

            // 2️⃣ Verificar si ya existe la reserva
            $existe = Reserva::where("cliente_id", Auth::id())
                ->where("horario_clase_id", $request->horario_clase_id)
                ->where("tipo_clase", $request->tipo)
                ->whereDate("fecha_reserva", $fechaClase->format("Y-m-d"))
                ->where("estado", "Reservada")
                ->exists();

            if ($existe) {
                DB::rollBack();
                Flash::warning("Ya estás inscrito en esta clase.");
                return redirect()->back();
            }

            // 3️⃣ Buscar la clase
            if ($request->tipo == "unica") {

                $clase = HorarioClaseUnica::find($request->horario_clase_id);

                if (!$clase) {
                    DB::rollBack();
                    Flash::error("Clase no encontrada.");
                    return redirect()->back();
                }

                $reservas = Reserva::where("horario_clase_id", $clase->id)
                    ->where("tipo_clase", "unica")
                    ->where("estado", "Reservada")
                    ->count();

            } else {

                $clase = ClaseRecurrente::find($request->horario_clase_id);

                if (!$clase) {
                    DB::rollBack();
                    Flash::error("Clase no encontrada.");
                    return redirect()->back();
                }

                $reservas = Reserva::where("horario_clase_id", $clase->id)
                    ->where("tipo_clase", "recurrente")
                    ->whereDate("fecha_reserva", $fechaClase->format("Y-m-d"))
                    ->where("estado", "Reservada")
                    ->count();
            }

            // 4️⃣ Verificar cupos disponibles
            if ($reservas >= $clase->cupo_maximo) {
                DB::rollBack();
                Flash::error("Esta clase ya está llena.");
                return redirect()->back();
            }

            // 5️⃣ Crear la reserva
            $reserva = new Reserva();
            $reserva->cliente_id = Auth::id();
            $reserva->horario_clase_id = $request->horario_clase_id;
            $reserva->fecha_reserva = $fechaClase->format('Y-m-d');
            $reserva->tipo_clase = $request->tipo;
            $reserva->estado = 'Reservada';
            $reserva->save();

            DB::commit();

            Flash::success("Reserva realizada correctamente");
            return redirect()->back();

        } catch (\Exception $e) {

            DB::rollBack();
            Flash::error("Ocurrió un error al realizar la reserva.");
            return redirect()->back();
        }
    }


    public function cancelar($id)
    {
        $reserva = Reserva::where('id', $id)
            ->where('cliente_id', Auth::id())
            ->first();

        if (!$reserva) {
            Flash::error("Reserva no encontrada.");
            return redirect()->back();
        }

        if ($reserva->estado == "Cancelada") {
            Flash::warning("La reserva ya estaba cancelada.");
            return redirect()->back();
        }

        $reserva->estado = 'Cancelada';
        $reserva->save();

        Flash::success('Reserva cancelada correctamente');
        return redirect()->back();
    }
}