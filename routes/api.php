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

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', [AuthApiController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthApiController::class, 'logout']);

// Rutas protegidas para el perfil
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', [PerfilApiController::class, 'show']); // Ver perfil
    Route::post('/perfil', [PerfilApiController::class, 'update']); // Actualizar perfil
    
    //reserva
    Route::post('/reserva-clase-usuario', [ReservaApiController::class, 'reserva_clase_usuario']);
    Route::post('/cancelar-reserva', [ReservaApiController::class, 'cancelarReserva']);
    Route::post('/reserva', [ReservaApiController::class, 'store']);

    // Rutas para calificaciones
    Route::prefix('classes/')->group(function () {
        Route::post('rating', [RatingApiController::class, 'rateClass']);
        Route::get('calificacion/{class_id}', [RatingApiController::class, 'getUserRating']);

        
        Route::get('/', [RatingController::class, 'getClassRatings']);
        Route::get('/user', [RatingController::class, 'getUserRating']);
        Route::delete('/', [RatingController::class, 'deleteRating']);
    });


    //MEDICIONES
    Route::get('/mediciones', [MedicionApiController::class, 'index']);
    Route::post('/mediciones', [MedicionApiController::class, 'store']);

    //FACTURA
    Route::post('/factura', [FacturaApiController::class, 'store']);

    /* productos */
    Route::post('/productos/categorias', [ProductoApiController::class, 'get_productos_by_categorias']);

    /* membresias */
    Route::get('membresias/usuario', [MembresiaApiController::class, 'membresia_usuario']);
    Route::resource("membresias", MembresiaApiController::class);

    /* rutinas */
    Route::get('/rutinas-generales', [RutinaApiController::class, 'rutinasGenerales']);
    Route::get('/rutinas-usuario', [RutinaApiController::class, 'rutinasUsuario']);
    /* ejericicios rutina */
    Route::get('/ejercicios-rutinas/{id}', [RutinaApiController::class, 'ejericiosRutina']);

});

//clases
Route::get('/clases', [ClaseApiController::class, 'index']); // Ver perfil
Route::get('/clases/{id}/{fecha}', [ClaseApiController::class, 'show']); // Ver perfil



