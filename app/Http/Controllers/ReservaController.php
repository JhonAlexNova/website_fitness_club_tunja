<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reserva;

use App\Models\ClaseRecurrente;
use App\Models\HorarioClaseUnica;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $reservasUnicas = Reserva::groupBy("horario_clase_id")->where("tipo_clase","unica")->get();
        $reservasRecurrentes = Reserva::groupBy("fecha_reserva")->where("tipo_clase","recurrente")->get();

        $reservas = array_merge($reservasUnicas->toArray(), $reservasRecurrentes->toArray());

        $reservas = collect($reservas);

       // dd($reservas);

       

       /*  foreach($reservasUnicas as $reserva){
            if($reserva["tipo_clase"]=="recurrente"){
                $horario_clase =  ClaseRecurrente::with(["clase","instructor"])->find($reserva->horario_clase_id);
                $inscritos = Reserva::where("fecha_reserva",$reserva->fecha_reserva)->select("id")->get()->count();
                $reserva["horario_clase"] = $horario_clase;
                $reserva["inscritos"] = $inscritos;
                $data[] = $reserva; 
            }else{
                $horario_clase =  HorarioClaseUnica::with(["clase","instructor"])->find($reserva->horario_clase_id);
                $inscritos = Reserva::where("horario_clase_id",$horario_clase->id)->select("id")->get()->count();
                $reserva["horario_clase"] = $horario_clase;
                $reserva["inscritos"] = $inscritos;
                $data[] = $reserva;
            }
        } */

        $data = [];
        foreach($reservasRecurrentes as $reserva){
            $horario_clase =  ClaseRecurrente::with(["clase","instructor"])->find($reserva->horario_clase_id);
            $inscritos = Reserva::where("fecha_reserva",$reserva->fecha_reserva)->select("id")->get()->count();
            $reserva["horario_clase"] = $horario_clase;
            $reserva["inscritos"] = $inscritos;
            $data[] = $reserva; 
        }
        

        $backpack = [
            "reservas_clase" => $data
        ];

        return view("admin.reservas.index", $backpack);
    }


    public function inscritos_clase(Request $request){
        $reservas = Reserva::with("cliente")->where("fecha_reserva",$request->fecha_reserva)->select("cliente_id","id","estado","created_at")->get();

        $backpack = [
            "reservas" => $reservas
        ];
        return view("admin.reservas.table-inscritos-clase",$backpack);
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
