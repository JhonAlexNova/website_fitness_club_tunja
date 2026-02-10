<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\HistorialProducto;
use DB;
use App\Models\Cierre;
use App\Models\Pago;
use App\Models\MetodoPago;
use App\Models\Gasto;
use Auth;
use App\Models\IngresoPorteria;
use App\Models\Producto;
use App\Models\Descuadre;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('America/Bogota');
       // $this->middleware('auth');
    }



    
    public function index(Request $request)
    {
        return view('home');
    }



    
}
