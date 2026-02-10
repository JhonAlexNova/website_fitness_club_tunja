<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Factura;
use App\Models\Cierre;
use App\Models\Producto;
use App\Models\HistorialProducto;
use DB;


class ReporteController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('America/Bogota');
        $this->middleware('auth');
    }


    public function reporte_ventas(Request $request){
            
        if($request->fecha_inicio){
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
        }else{
            $fecha_inicio = date('Y-m-d');
            $fecha_fin = date('Y-m-d');
        }

        $ventas_totales_producto = DB::table('facturas as f')
        ->join('detalle_facturas as df', 'df.factura_id', 'f.id')
        ->join('productos as p', 'p.id', 'df.producto_id')
        //->where('f.cierre_id', $cierre->id)
        ->select('df.producto_id', 'p.nombre',DB::raw('SUM(df.total) as total_ventas'), DB::raw('SUM(df.cantidad) as total_productos'))
        ->groupBy('df.producto_id', 'p.nombre')
        ->get();

        if($request->cierre_id){
            $ventas_totales_producto = DB::table('facturas as f')
            ->join('detalle_facturas as df', 'df.factura_id', 'f.id')
            ->join('productos as p', 'p.id', 'df.producto_id')
            ->where('f.cierre_id', $request->cierre_id)
            ->select('df.producto_id', 'p.nombre',DB::raw('SUM(df.total) as total_ventas'), DB::raw('SUM(df.cantidad) as total_productos'))
            ->groupBy('df.producto_id', 'p.nombre')
            ->get();
        }



        $fechas_cierres = Cierre::whereBetween('created_at', [$fecha_inicio.' 00:00:00', $fecha_fin.' 23:59:59'])->get();

        

        $backpack = [
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'fechas_cierres' => $fechas_cierres,
            'cierre_id' => $request->cierre_id,
            'ventas_totales_producto' => $ventas_totales_producto
        ];

        return view('viewReport.ventas.index',$backpack);
    }



    public function inventario(Request $request){
        $cierre = Cierre::get()->last();
        $fecha_inicio = null;
        $fecha_fin = null;
        $cierres = [];
        $cierre_id = null;
      

       // dd($cierres);
        //dd($request->all());
        if($request->fecha_inicio){
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            $cierres = Cierre::whereBetween('created_at',[$fecha_inicio. ' 00:00:00', $fecha_fin. ' 23:59:59'])->get();
        }

        if($request->cierre_id && $request->cierre_id!='-99'){
            $cierre_id = $request->cierre_id;
            $cierre = Cierre::find($cierre_id);
        }




        $productos = Producto::select('id','nombre')->get();
        $data = [];

        foreach($productos as $producto){
            $obj = [];
            //PRIMER REGISTRO
           // dd($cierre);
            $historial_producto_first = HistorialProducto::where('producto_id',$producto->id)
            ->whereBetween('created_at',[$cierre->fecha_inicio, $cierre->fecha_fin])
            ->get()
            ->first();
            //ULTIMO REGISTRO
            $historial_producto_last = HistorialProducto::where('producto_id',$producto->id)
            ->whereBetween('created_at',[$cierre->fecha_inicio, $cierre->fecha_fin])
            ->get()
            ->last();

            
            
            if(!is_null($historial_producto_first)){
                $historial_ultimo_cierre = HistorialProducto::where('producto_id',$producto->id)->where("id","<",$historial_producto_first->id)->get()->last();
                if($producto->id==2){
                    //dd($historial_ultimo_cierre);
                }
               // dd($historial_ultimo_cierre);
                //ENTRADAS 
                $historial_entradas = HistorialProducto::where('producto_id',$producto->id)
                ->whereBetween('created_at',[$cierre->fecha_inicio, $cierre->fecha_fin])
                ->where('tipo','INGRESO')
                ->get()
                ->sum('cantidad');

                $historial_salidas = HistorialProducto::where('producto_id',$producto->id)
                ->whereBetween('created_at',[$cierre->fecha_inicio, $cierre->fecha_fin])
                ->whereIn('tipo',['SALIDA'])
                ->get()
                ->sum('cantidad');


                $obj['cantidad_inicial'] = $historial_ultimo_cierre->cantidad_actual;
                $obj['cantidad_final'] = $historial_producto_last->cantidad_actual;
                $obj['cantidad_ingresos'] = $historial_entradas;
                $obj['cantidad_salidas'] = $historial_salidas;
                $obj['producto'] = $producto; 
                array_push($data,$obj);
            }else{

                  //ULTIMO REGISTRO
                $historial_producto_last = HistorialProducto::where('producto_id',$producto->id)
                ->whereDate('created_at','<',$cierre->fecha_inicio)
                ->get()
                ->last();


               // dd($producto, $cierre);

                $historial_entradas = HistorialProducto::where('producto_id',$producto->id)
                ->whereBetween('created_at',[$cierre->fecha_inicio, $cierre->fecha_fin])
                ->where('tipo','INGRESO')
                ->get()
                ->sum('cantidad');

            

                $historial_salidas = HistorialProducto::where('producto_id',$producto->id)
                ->whereBetween('created_at',[$cierre->fecha_inicio, $cierre->fecha_fin])
                ->whereIn('tipo',['SALIDA'])
                ->get()
                ->sum('cantidad');



                $obj['producto'] = $producto;
                $obj['cantidad_inicial'] = $historial_producto_last->cantidad_actual;
                $obj['cantidad_final'] = $historial_producto_last->cantidad_actual;
                $obj['cantidad_ingresos'] = $historial_entradas;
                $obj['cantidad_salidas'] = $historial_salidas;

               // dd($historial_salidas);
              array_push($data,$obj); 
                //dd($prod);
             /*    $obj['cantidad_inicial'] = 0;
                $obj['cantidad_final'] = 0;
                $obj['cantidad_ingresos'] = $historial_entradas;
                $obj['cantidad_salidas'] = $historial_salidas; */
            }

           
        }

        if(is_null($cierre_id)){
            $data = [];
        }

        $backpack = [
            'data' => $data,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'cierres' => $cierres,
            'cierre_id' => $cierre_id
        ];

      //  dd($backpack);
        return view('viewReport.inventario.index',$backpack);
    }
}
