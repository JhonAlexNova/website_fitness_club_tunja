<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\ProductoRepository;
use App\Repositories\HistorialProductoRepository;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $productoRepository;
    private $historialProductoRepository;


    public function __construct(
        ProductoRepository $productoRepo,
        HistorialProductoRepository $HistorialProductoRepo
    )
    {
        $this->productoRepository = $productoRepo;
        $this->historialProductoRepository = $HistorialProductoRepo;
    }


    public function index()
    {
        $productos = $this->productoRepository->withRelations();

        $backpack = [
            'productos' => $productos
        ]; 
        return view('stock.index',$backpack);
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
        $producto = $this->productoRepository->withRelations()->find($id);

        $backpack = [
            'producto' => $producto
        ]; 

        return view('stock.edit',$backpack);

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

        $producto = $this->productoRepository->withRelations()->find($id);

        if($request->action=='create'){
            $cantidad_nueva = intval($producto->historial_producto->cantidad_actual) + intval($request->cantidad);

                $attributesStcokNuevo = [
                    'producto_id' => $producto->id,
                    'cantidad' => $request->cantidad,
                    'cantidad_anterior' => $producto->historial_producto->cantidad,
                    'cantidad_actual' => $cantidad_nueva,
                    'precio_entrada' => str_replace(array(',','.'),'',$request->precio_entrada),
                    'tipo' => 'INGRESO'
                ];

                $this->historialProductoRepository->create($attributesStcokNuevo);
            }else if($request->action=='edit'){
                $historial = $this->historialProductoRepository->all()->where('producto_id',$producto->id)->last();


                $attributesStcokNuevo = [
                    'cantidad_actual' => $request->cantidad
                ];
                
                $update = $this->historialProductoRepository->update($attributesStcokNuevo, $historial->id);


                return $update;
            }
                
            return response()->json(['message'=>'Stock actualizado correctamente']);



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
