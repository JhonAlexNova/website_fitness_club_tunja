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
use App\Http\Controllers\API\RutinaApiController;
use App\Http\Controllers\API\ClienteApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH PUBLICO
Route::post('/auth/login', [AuthApiController::class, 'login']);
Route::post('/auth/register', [AuthApiController::class, 'register']);

// LOGOUT PROTEGIDO
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthApiController::class, 'logout']);

// RUTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/clientes', [ClienteApiController::class, 'store']);
    // PERFIL
    Route::get('/perfil', [PerfilApiController::class, 'show']);
    Route::post('/perfil', [PerfilApiController::class, 'update']);

    // RESERVAS
    Route::post('/reserva-clase-usuario', [ReservaApiController::class, 'reserva_clase_usuario']);
    Route::post('/cancelar-reserva', [ReservaApiController::class, 'cancelarReserva']);
    Route::post('/reserva', [ReservaApiController::class, 'store']);

    // CALIFICACIONES
    Route::prefix('classes')->group(function () {
        Route::get('calificacion/{class_id}', [RatingApiController::class, 'getUserRating']);
        Route::get('/', [RatingApiController::class, 'getClassRatings']);
        Route::delete('/', [RatingApiController::class, 'deleteRating']);
    });

    // MEDICIONES
    Route::get('/mediciones', [MedicionApiController::class, 'index']);
    Route::post('/mediciones', [MedicionApiController::class, 'store']);

    // FACTURA
    Route::post('/factura', [FacturaApiController::class, 'store']);

    // PRODUCTOS
    Route::post('/productos/categorias', [ProductoApiController::class, 'get_productos_by_categorias']);

    // MEMBRESÍAS
    Route::get('membresias/usuario', [MembresiaApiController::class, 'membresia_usuario']);
    Route::resource("membresias", MembresiaApiController::class)->names("api.membresias");

    // RUTINAS
    Route::get('/rutinas-generales', [RutinaApiController::class, 'rutinasGenerales']);
    Route::get('/rutinas-usuario', [RutinaApiController::class, 'rutinasUsuario']);
    Route::get('/ejercicios-rutinas/{id}', [RutinaApiController::class, 'ejericiosRutina']);
});

// CLASES PUBLICAS
Route::get('/clases', [ClaseApiController::class, 'index']);
Route::get('/clases/{id}/{fecha}', [ClaseApiController::class, 'show']);