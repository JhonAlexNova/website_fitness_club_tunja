<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use App\Models\Permiso;
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
        $this->datosCompartidos();
        return $next($request);
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
            // Si no existe modulo u orden, lo enviamos al final
            return data_get($permiso, 'modulo.orden', PHP_INT_MAX);
        })->values()->toArray();

//dd($permisos);

        $cierreGlobal = Cierre::get()->last();


        if(is_null($cierreGlobal->fecha_fin) && !is_null($cierreGlobal->cierre_caja)){
            \Toastr::error('No olvide cerrar el dia para poder seguir vendiendo, Caja cerrada...', 'Advertencia', ["positionClass" => "toast-bottom-right"]);
        }




        \View::share("configGlobal",$configGlobal);
        \View::share("permisosModulos",$permisos);
        \View::share('cierreGlobal',$cierreGlobal);
        
    }
}
