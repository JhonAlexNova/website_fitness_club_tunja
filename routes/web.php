<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/storage/{archivo}',[App\Http\Controllers\FileController::class,'verImagen'])->where('archivo', '.*')->name('storage');
Route::group(["middleware"=>["config"]],function(){
    
   //Route::get('/', function () {});
    Auth::routes();
});


/* RUTAS WEB SITE */
Route::resource('/', App\Http\Controllers\WebSite\HomeController::class);
Route::resource('tienda', App\Http\Controllers\WebSite\TiendaController::class);

Route::group(["as" => "website."], function () {
    Route::resource('productos', App\Http\Controllers\WebSite\ProductoController::class);
    Route::resource('carrito', App\Http\Controllers\WebSite\CarritoController::class);
    Route::resource('membresias', App\Http\Controllers\WebSite\MembresiaController::class);
});

/* DASHBOARD ADMIN */
Route::group(["middleware"=>["auth","config"],"prefix"=>"admon"],function(){
            Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
           // Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index2'])->name('home2');
            Route::resource('configuracions', App\Http\Controllers\ConfiguracionController::class);
            
            Route::post('estado-acceso', [App\Http\Controllers\ConfiguracionController::class,'estadoAcceso']);
            
            Route::resource('empleados', App\Http\Controllers\EmpleadoController::class);
            Route::resource('administradores', App\Http\Controllers\AdministradorController::class);

            
            Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
    
    
            Route::resource('productos', App\Http\Controllers\ProductoController::class);
            Route::get('productos/sku/{referencia}', [App\Http\Controllers\ProductoController::class,'producto_por_referencia']);
            Route::get('productos/categoria/{categoria_id}', [App\Http\Controllers\ProductoController::class,'producto_por_categoria']);
    
            Route::resource('sedes', App\Http\Controllers\SedeController::class);
            Route::resource('historialPrecioProductos', App\Http\Controllers\HistorialPrecioProductoController::class);
            Route::resource('stock', App\Http\Controllers\StockController::class);
            Route::resource('historialProductos', App\Http\Controllers\HistorialProductoController::class);
            Route::resource('baseEmpleados', App\Http\Controllers\BaseEmpleadoController::class);
            Route::resource('ventas', App\Http\Controllers\VentaController::class);
            Route::resource('devoluciones-simples', App\Http\Controllers\DevolucionSimpleController::class);
            
            Route::resource('facturas', App\Http\Controllers\FacturaController::class);
            Route::post('cambiar-estado', [App\Http\Controllers\FacturaController::class, 'cambiarEstado'])->name('cambiarEstado');

            Route::resource('detalleFacturas', App\Http\Controllers\DetalleFacturaController::class);
            Route::resource('chicos', App\Http\Controllers\ChicoController::class);
            Route::get('abrir-dia', [App\Http\Controllers\CierreController::class,'abrir_dia']);
    
            Route::post('cerrar-dia', [App\Http\Controllers\CierreController::class,'cerrar_dia']);
            Route::get('fechas_cierre', [App\Http\Controllers\CierreController::class,'fechas_cierre']);


            // 
            Route::post('cerrar-caja', [App\Http\Controllers\CierreController::class,'cerrar_caja']);
    
            Route::resource('devolucions', App\Http\Controllers\DevolucionController::class);
    
    
            Route::resource('detalleDevolucions', App\Http\Controllers\DetalleDevolucionController::class);
            Route::resource('metodoPagos', App\Http\Controllers\MetodoPagoController::class);
            Route::resource('pagos', App\Http\Controllers\PagoController::class);

    
            Route::group(['prefix'=>'reportes'],function(){
                Route::get('ventas', [App\Http\Controllers\ReporteController::class,'reporte_ventas']);
                Route::get('inventario', [App\Http\Controllers\ReporteController::class,'inventario']);
            });
    
            Route::resource('gastos', App\Http\Controllers\GastoController::class);

            Route::resource('permisos', App\Http\Controllers\PermisoController::class);

            Route::group(["prefix"=>"cambios-x-producto"],function(){
                Route::resource('/', App\Http\Controllers\CambiosXProductoController::class);
            });


            //CONFIGURACION PERMISOS
            Route::group(["prefix"=>"config"],function(){
                Route::get('/permisos-tipo-negocio', [App\Http\Controllers\ConfiguracionController::class, 'get_permisos_tipo_negocio']);
                Route::post('/permisos-tipo-negocio', [App\Http\Controllers\ConfiguracionController::class, 'permisos_tipo_negocio']);
            });

            
            Route::get('clientes-by-documento/{documento}',[ App\Http\Controllers\ClienteController::class, 'clientes_by_documento']);
            Route::resource('clientes', App\Http\Controllers\ClienteController::class);
            //
            Route::resource('manillaEntradas', App\Http\Controllers\ManillaEntradaController::class);
            Route::get('ventas-porteria', [App\Http\Controllers\IngresoPorteriaController::class,'ventas_porteria'])->name('ventas.porteria');
            Route::resource('ingreso-porteria', App\Http\Controllers\IngresoPorteriaController::class);
            Route::resource('stockManillas', App\Http\Controllers\StockManillaController::class);


            //TRASLADOS
            Route::resource('trasladoProductos', App\Http\Controllers\TrasladoProductoController::class);
            
            Route::get('ventas2', [App\Http\Controllers\VentaController::class, "ventas2"]);
            Route::resource('pedidos', App\Http\Controllers\PedidoController::class);
            Route::resource('sorteos', App\Http\Controllers\SorteoController::class);

            //asistencia empleados
            Route::resource('asistenciaEmpleados', App\Http\Controllers\AsistenciaEmpleadoController::class);

            Route::resource('caracteristicas', App\Http\Controllers\CaracteristicaController::class);
            
            Route::resource('valorCaracteristicas', App\Http\Controllers\ValorCaracteristicaController::class);
            Route::get('valores-caracteristica/{caracteristica_id}', [App\Http\Controllers\ValorCaracteristicaController::class,"valoresCaracteristica"]);

            Route::resource('variacionProductos', App\Http\Controllers\VariacionProductoController::class);
            Route::get('variaciones-producto/{producto_id}/{caracteristica_id}', [App\Http\Controllers\VariacionProductoController::class,"variacionesProducto"]);
            
            Route::resource('caracteristicaProductos', App\Http\Controllers\CaracteristicaProductoController::class);

            Route::resource('clases', App\Http\Controllers\ClaseController::class)->names("admon.clases");

            Route::get('/horarios_clases', [App\Http\Controllers\ClaseController::class, 'getHorarios']);
            Route::post('/horarios_clases_unicas', [App\Http\Controllers\ClaseController::class, 'createHorarioUnico']);
            Route::post('/clases_recurrentes', [App\Http\Controllers\ClaseController::class, 'createClaseRecurrente']);
            Route::put('/horarios_clases_unicas/{id}', [App\Http\Controllers\ClaseController::class, 'updateHorarioUnico']);
            Route::put('/clases_recurrentes/{id}', [App\Http\Controllers\ClaseController::class, 'updateClaseRecurrente']);
            Route::delete('/horarios_clases_unicas/{id}', [App\Http\Controllers\ClaseController::class, 'deleteHorarioUnico']);
            Route::delete('/clases_recurrentes/{id}', [App\Http\Controllers\ClaseController::class, 'deleteClaseRecurrente']);


            Route::resource('instructors', App\Http\Controllers\InstructorController::class);
            Route::resource('horarioClaseUnicas', App\Http\Controllers\HorarioClaseUnicaController::class);
            Route::resource('claseRecurrentes', App\Http\Controllers\ClaseRecurrenteController::class);
            Route::resource('/reservas', App\Http\Controllers\ReservaController::class);
            Route::get('inscritos-clase', [App\Http\Controllers\ReservaController::class,"inscritos_clase"]);

            //MEMBRESIAS
            Route::resource('membresias', App\Http\Controllers\MembresiaController::class);
            Route::resource('userMembresias', App\Http\Controllers\UserMembresiaController::class);
            Route::resource('pagoMembresias', App\Http\Controllers\PagoMembresiaController::class);


            /* EJERCICIOS */
            Route::resource('ejercicios', App\Http\Controllers\EjercicioController::class);
            Route::resource('rutinas', App\Http\Controllers\RutinaController::class)->names("admon.rutinas");
            Route::resource('rutinaEjercicios', App\Http\Controllers\RutinaEjercicioController::class)->names("admon.ejerciciosRutina");
            Route::resource('userRutinas', App\Http\Controllers\UserRutinaController::class);

            /* mensajes */
            Route::resource('smsTemplates', App\Http\Controllers\SmsTemplateController::class);
            Route::prefix('sms')->group(function () {
                Route::get('/send', [App\Http\Controllers\SmsSendController::class, 'create'])->name('sms.send.create');
                Route::post('/send', [App\Http\Controllers\SmsSendController::class, 'store'])->name('sms.send');
            });
            
              /* Servicios */
            Route::resource('servicios', App\Http\Controllers\ServicioController::class);
            Route::resource('musculos', App\Http\Controllers\MusculoController::class);

            /* SISTEMA DE PUNTOS */
            Route::resource('puntos', App\Http\Controllers\PuntoController::class);

            /* WOMPI */
            Route::resource('transaccions', App\Http\Controllers\TransaccionController::class);

            /* mediciones */
            Route::resource('medicions', App\Http\Controllers\MedicionController::class);
            /*  */
           

      
});


Route::group(["prefix"=>"app","middleware"=>"protectionAppRoute"],function(){
    Route::resource("/",App\Http\Controllers\App\HomeController::class);
    Route::resource("perfil",App\Http\Controllers\App\PerfilController::class)->names("app.perfil");
    Route::get("editar-perfil",[App\Http\Controllers\App\PerfilController::class,"editar_perfil"]);
    Route::get("editar-contrasena",[App\Http\Controllers\App\PerfilController::class,"editar_contrasena"])->name("changePassword");
    //Route::post("editar-contrasena",[App\Http\Controllers\App\PerfilController::class,"editar_contrasena"])->name("changePassword");

    Route::resource("/login",App\Http\Controllers\App\LoginController::class);
    Route::resource("clases",App\Http\Controllers\App\ClaseController::class);
    Route::get('/clase/detalle/{id}/{tipo}/{fecha}', [App\Http\Controllers\App\ClaseController::class, 'detalle'])->name('clase.detalle');
    //RESERVAS
    Route::post('/reservas', [App\Http\Controllers\App\ReservaController::class, 'store'])->name('reservas.store');

    /* rutinas configuracion */
    Route::resource("rutinas",App\Http\Controllers\App\RutinaController::class);
    Route::resource("plan-entrenamiento",App\Http\Controllers\App\PlanEntrenamientoController::class);
    Route::resource("ejercicio",App\Http\Controllers\App\EjercicioController::class);


  
    /*  */
    

});



/* pagos wompi */
Route::post('confirmacion-wompi', [App\Http\Controllers\WompiController::class,"confirmacion_wompi"]);


