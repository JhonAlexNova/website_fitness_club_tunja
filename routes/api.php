<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\PerfilApiController;
use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\ClaseApiController;
use App\Http\Controllers\API\ReservaApiController;
use App\Http\Controllers\API\RatingApiController;
use App\Http\Controllers\API\MedicionApiController;
use App\Http\Controllers\API\FacturaApiController;
use App\Http\Controllers\API\ProductoApiController;
use App\Http\Controllers\API\MembresiaApiController;
use App\Http\Controllers\API\PasadiaApiController;
use App\Http\Controllers\API\RutinaApiController;
use App\Http\Controllers\API\ClienteApiController;
use App\Http\Controllers\API\MusculoApiController;
use App\Http\Controllers\API\EjercicioApiController;
use App\Http\Controllers\CoffeeProductController;
use App\Http\Controllers\CoffeeCategoryController;
use App\Http\Controllers\API\PasswordResetController;
use App\Http\Controllers\API\SesionEntrenamientoApiController;
use App\Http\Controllers\API\CodigoPromocionalApiController;
use App\Http\Controllers\API\CategoriaApiController;
use App\Http\Controllers\API\NotificacionApiController;
use App\Http\Controllers\API\BuzonSugerenciaApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH PÚBLICO
Route::post('/auth/login',    [AuthApiController::class, 'login']);
Route::post('/auth/register', [AuthApiController::class, 'register']);
Route::post('/auth/verify-email', [AuthApiController::class, 'verifyEmailCode']);
Route::get('/codigo-promocional/{codigo}',  [CodigoPromocionalApiController::class, 'validar']);

// RECUPERACIÓN DE CONTRASEÑA (público)
Route::post('/forgot-password/send-code',   [PasswordResetController::class, 'sendCode']);
Route::post('/forgot-password/verify-code', [PasswordResetController::class, 'verifyCode']);
Route::post('/forgot-password/reset',       [PasswordResetController::class, 'resetPassword']);

// LOGOUT PROTEGIDO
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthApiController::class, 'logout']);

// RUTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function () {

    // CLIENTES
    Route::post('/clientes', [ClienteApiController::class, 'store']);

    // PERFIL
    Route::get('/perfil',  [PerfilApiController::class, 'show']);
    Route::post('/perfil', [PerfilApiController::class, 'update']);

    // RESERVAS
    Route::post('/reserva-clase-usuario', [ReservaApiController::class, 'reserva_clase_usuario']);
    Route::post('/cancelar-reserva',      [ReservaApiController::class, 'cancelarReserva']);
    Route::post('/reserva',               [ReservaApiController::class, 'store']);
    Route::post('/aplazar-reserva',       [ReservaApiController::class, 'aplazarReserva']);
    Route::get('/mis-reservas',           [ReservaApiController::class, 'misReservas']);

    // CALIFICACIONES
    Route::prefix('classes')->group(function () {
        Route::get('calificacion/{class_id}', [RatingApiController::class, 'getUserRating']);
        Route::get('/',                        [RatingApiController::class, 'getClassRatings']);
        Route::delete('/',                     [RatingApiController::class, 'deleteRating']);
    });

    // MEDICIONES
    Route::get('/mediciones',  [MedicionApiController::class, 'index']);
    Route::post('/mediciones', [MedicionApiController::class, 'store']);

    // FACTURA
    Route::post('/factura', [FacturaApiController::class, 'store']);
    Route::get('mis-facturas', [FacturaApiController::class, 'misFacturas']);
    Route::get('notificaciones', [NotificacionApiController::class, 'index']);
    Route::post('notificaciones/leer', [NotificacionApiController::class, 'marcarLeidas']);
    Route::get('historial-tienda', [FacturaApiController::class, 'historialTienda']);

    // PRODUCTOS
    Route::post('/productos/categorias', [ProductoApiController::class, 'get_productos_by_categorias']);
    Route::get('/coffee-products',       [CoffeeProductController::class, 'apiIndex']);
    Route::get('/coffee-categories',     [CoffeeCategoryController::class, 'apiIndex']);
    Route::get('historial-coffee', [FacturaApiController::class, 'historialCoffee']);

    // MEMBRESÍAS
    Route::get('membresias/usuario', [MembresiaApiController::class, 'membresia_usuario']);
    Route::resource('membresias', MembresiaApiController::class)->names('api.membresias');

    // PASADÍAS
    Route::resource('pasadias', PasadiaApiController::class)->names('api.pasadias');

    // RUTINAS
    Route::delete('rutinas/{id}', [\App\Http\Controllers\App\RutinaController::class, 'destroy'])->middleware('auth:sanctum');
    Route::put('/rutinas/{id}', [RutinaApiController::class, 'update']);
    Route::get('/rutinas-generales',          [RutinaApiController::class, 'rutinasGenerales']);
    Route::get('/rutinas-usuario',            [RutinaApiController::class, 'rutinasUsuario']);
    Route::get('/ejercicios-rutinas/{id}',    [RutinaApiController::class, 'ejericiosRutina']);
    Route::post('/rutinas-usuario',           [RutinaApiController::class, 'storeRutinaUsuario']);
    Route::get('rutinas-diarias-elite', [\App\Http\Controllers\App\RutinaDiariaEliteController::class, 'index'])->middleware('auth:sanctum');

    // MÚSCULOS
    Route::get('/musculos', [MusculoApiController::class, 'index']);

    // EJERCICIOS
    Route::get('/ejercicios', [EjercicioApiController::class, 'index']);
    Route::get('/ejercicios/{id}', [EjercicioApiController::class, 'show']);

    // SESIONES DE ENTRENAMIENTO
    Route::post('/rutinas/{rutinaId}/sesion/iniciar',        [SesionEntrenamientoApiController::class, 'iniciar']);
    Route::post('/sesiones/{sesionId}/finalizar',            [SesionEntrenamientoApiController::class, 'finalizar']);
    Route::post('/sesiones/{sesionId}/series',               [SesionEntrenamientoApiController::class, 'marcarSerie']);
    Route::get('/rutinas/{rutinaId}/historial',              [SesionEntrenamientoApiController::class, 'historial']);

    // GESTIÓN DE EJERCICIOS EN RUTINA (editar, agregar, eliminar)
    Route::put('/rutinas/{rutinaId}/ejercicios/{reId}',      [SesionEntrenamientoApiController::class, 'actualizarEjercicio']);
    Route::delete('/rutinas/{rutinaId}/ejercicios/{reId}',   [SesionEntrenamientoApiController::class, 'eliminarEjercicio']);
    Route::post('/rutinas/{rutinaId}/ejercicios',            [SesionEntrenamientoApiController::class, 'agregarEjercicio']);

    // BUZÓN DE SUGERENCIAS
    Route::post('/buzon-sugerencias', [BuzonSugerenciaApiController::class, 'store']);
    Route::get('/mis-mensajes-buzon', [BuzonSugerenciaApiController::class, 'misMensajes']);

});


// CLASES PÚBLICAS
Route::get('/clases',              [ClaseApiController::class, 'index']);
Route::get('/clases/{id}/{fecha}', [ClaseApiController::class, 'show']);

Route::get('/categorias', [CategoriaApiController::class, 'index']);