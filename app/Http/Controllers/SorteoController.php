<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Repositories\IngresoPorteriaRepository;


class SorteoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ingresoPorteriaRepository;

     public function __construct(IngresoPorteriaRepository $ingresoPorteriaRepo)
     {
         $this->ingresoPorteriaRepository = $ingresoPorteriaRepo;
     }


    public function index()
    {
        $ingresoPorterias = $this->ingresoPorteriaRepository->withRelations();



        $cadenaIngresos = "";
        $data = array();

        $nombre_archivo = "names.txt";
        $archivo = fopen($nombre_archivo, "w");
        $names="";
        foreach($ingresoPorterias as $ingreso){
            $names=$names.$ingreso->cliente->nombres.PHP_EOL;
            array_push($data, $ingreso->cliente->nombres);
        }
        fwrite($archivo, $names);


        $cadenaIngresos = implode(',',$data);

        $backpack = [
            'usuarios_porteria' => $cadenaIngresos
        ];

        return view("sorteos.index",$backpack);
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
