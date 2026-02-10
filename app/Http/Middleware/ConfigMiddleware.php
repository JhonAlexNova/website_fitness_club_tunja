<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use App\Models\Permiso;
use App\Models\Licencia;
use App\Models\Cierre;


Use Auth;


class ConfigMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       $acceso_habilitado =  $this->verificar_auth();
       if(!$acceso_habilitado){
         return redirect('login?error=disabled');
       }
        $this->verificar_licencia();
        $this->datosCompartidos();
        return $next($request);
    }

    public function verificar_licencia(){
        $fecha_actual = date('Y-m-d');


        $licencia = Licencia::whereDate('fecha_fin','>=',$fecha_actual)
        ->get()->last();

    }


    public function verificar_auth(){

        if(Auth::check()){
            $configGlobal = Configuracion::get()->last();    
    
           /*  if(Auth::user()->rol()->tipo=='VENDEDOR'){
                if($configGlobal->acceso=='Desabilitado'){
                    Auth::logout(); 
                    return false;
                }
            } */

        }

        return true;
    }

    public function datosCompartidos(){

        $fecha_actual = date('Y-m-d');
        
        $configGlobal = Configuracion::get()->last();
        $permisos = Permiso::with('modulo')->get()->toArray();
        // Ordenar la colección de permisos por una columna de la relación "modulo" (por ejemplo, "nombre")
        $permisos = collect($permisos)->sortBy(function ($permiso) {
            return $permiso['modulo']['orden']; // Cambia "nombre" por la columna que deseas usar para la ordenación
        })->values()->toArray();

//dd($permisos);

        $verificacion_licencia = Licencia::whereDate('fecha_fin','>=',$fecha_actual)
        ->get()->last();

        $licencia = Licencia::get()->last();
        $cierreGlobal = Cierre::get()->last();


        if(is_null($cierreGlobal->fecha_fin) && !is_null($cierreGlobal->cierre_caja)){
            \Toastr::error('No olvide cerrar el dia para poder seguir vendiendo, Caja cerrada...', 'Advertencia', ["positionClass" => "toast-bottom-right"]);
        }




        \View::share("configGlobal",$configGlobal);
        \View::share("permisosModulos",$permisos);
        \View::share('verificacion_licencia',$verificacion_licencia);
        \View::share('licencia',$licencia);
        \View::share('cierreGlobal',$cierreGlobal);
        
    }
}
