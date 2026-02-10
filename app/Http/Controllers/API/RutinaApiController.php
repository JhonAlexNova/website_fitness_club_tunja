<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rutina;
use App\Models\RutinaEjercicio;
use App\Models\Ejercicio;

class RutinaApiController extends Controller
{
    public function rutinasGenerales(Request $request){
        $rutinas = Rutina::where("es_general",1)->get();
        return response()->json($rutinas, 200);
    }

    public function rutinasUsuario(Request $request){
        $user = $request->user();
        $rutinas = Rutina::where("user_id", $user->id)->get();
        return response()->json($rutinas, 200);
    }

    public function ejericiosRutina($rutina_id){
       /*  $ejerciciosRutina = Ejercicio::with(["ejercicios_rutinas"])->whereHas('ejercicios_rutinas', function($query) use ($rutina_id) {
                $query->where('id_rutina', $rutina_id);
            })->get();
        */

        $ejerciciosRutina = RutinaEjercicio::with(['ejercicio'])
            ->where('id_rutina', $rutina_id)
            ->get();


        return response()->json($ejerciciosRutina, 200);
    }
}
