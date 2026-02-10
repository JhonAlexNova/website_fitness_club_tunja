<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cierre;
use Auth;
use App\Models\User;
use DB;
use Flash;
use App\Models\HistorialProducto;


use App\Repositories\DescuadreRepository;
use App\Repositories\HistorialPrecioProductoRepository;


class CierreController extends Controller
{
    private $descuadresRepository;
    private $historialPrecioProductoRepo;

    public function __construct(DescuadreRepository $DescuadreRepo, HistorialPrecioProductoRepository $HistorialPrecioProductoRepo){
        date_default_timezone_set("America/Bogota");
        $this->descuadresRepository = $DescuadreRepo;
        $this->historialPrecioProductoRepo = $HistorialPrecioProductoRepo;
    }

    public function abrir_dia(){
        Cierre::create([
            'fecha_inicio' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back();
    }


    public function fechas_cierre(Request $request){
        $fechas = Cierre::whereBetween('created_at', [$request->fecha_inicio. ' 00:00:00', $request->fecha_fin. ' 23:59:59'])->get();
        return $fechas;
    }

    public function cerrar_dia(Request $request){
        $user = User::where('email',$request->email)->get()->last();
        if(is_null($user)){
            Flash::error('Error al cerrar el dia, Contacte al administrador');
            return redirect()->back();
        }

        $rol = DB::table('tipo_usuario as tu')
        ->join('users as u','u.id','tu.user_id')
        ->join('rol as r','r.id','tu.rol_id')
        ->select('r.id')
        ->where('u.id',$user->id)->get()->last();

        if($rol->id==1 ||  $rol->id==2){
            if (password_verify($request->password, $user->password)) {
                $cierre = Cierre::get()->last();
                $cierre->fecha_fin = date('Y-m-d H:i:s');
                $cierre->save();
                Flash::success('Dia cerrado correctamente.');
            }else{
                Flash::error('Error al cerrar el dia, Contacte al administrador');
            }
        }else{
            Flash::error('Error al cerrar el dia, Contacte al administrador');
        }
      
        return redirect()->route('home');
    }


    public function cerrar_caja(Request $request){

        if(isset($request->producto_id)){
            foreach($request->producto_id as $index => $producto_id){
                $historial_producto_last = HistorialProducto::where('producto_id',$producto_id)
                ->get()
                ->last();

            

                $historial_precio_producto = $this->historialPrecioProductoRepo->all()->where("producto_id",$producto_id)->last();

                $cantidad_post = $request->cantidad[$index];
                
                $diferencia = $cantidad_post - $historial_producto_last->cantidad_actual;

            //  dd($request->all(), $diferencia,$cantidad_post);
        
                $tipo = null;
                if($diferencia>0){
                    $tipo = "GANANCIA";
                }else {
                    $tipo = "PERDIDA";
                    $diferencia = $diferencia * -1;
                }

    

                if($diferencia!=0){
                // dd($diferencia);
                    $attributes = [
                        "producto_id" => $producto_id,
                        "cantidad" => $diferencia,
                        "valor" => $historial_precio_producto->precio_venta * $diferencia,
                        'tipo' => $tipo
                    ];
                    $descuadres = $this->descuadresRepository->create($attributes);
                }
                
            }

        }
    

        $cierre = Cierre::all()->last();


        $cierre->cierre_caja = date('Y-m-d');
        $cierre->save();
        Flash::success('Caja cerrada correctamente.');
        return redirect()->back();
    }
}
