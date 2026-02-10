<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Http\Requests\CreateDevolucionRequest;
use App\Http\Requests\UpdateDevolucionRequest;
use App\Repositories\DevolucionRepository;
use App\Repositories\DetalleDevolucionRepository;


use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;







use App\Repositories\EmpleadoRepository;
use App\Repositories\ProductoRepository;




use App\Repositories\DetalleFacturaRepository;
use App\Repositories\HistorialProductoRepository;
use App\Repositories\FacturaRepository;

use App\Models\Devolucion;
use App\Models\Cierre;

class DevolucionSimpleController extends Controller
{
    
    
    private $empleadoRepository;
    private $productoRepository;


    private $devolucionRepository;
    private $detalleFacturaRepository;
    private $historialProductoRepository;
    private $facturaRepository;
    private $detalleDevolucionRepository;
    
    public $PORCENTAJE_X_REINGRESO = 50;



    public function __construct(
        EmpleadoRepository $empleadoRepo,
        ProductoRepository $productoRepo,
        DevolucionRepository $devolucionRepo,
        DetalleFacturaRepository $detalleFacturaRepo,
        HistorialProductoRepository $HistorialProductoRepo,
        FacturaRepository $facturaRepo,
        DetalleDevolucionRepository $detalleDevolucionRepo
    )
    {
        $this->empleadoRepository = $empleadoRepo;

        $this->devolucionRepository = $devolucionRepo;
        $this->productoRepository = $productoRepo;
        $this->detalleFacturaRepository = $detalleFacturaRepo;
        $this->historialProductoRepository = $HistorialProductoRepo;
        $this->facturaRepository = $facturaRepo;
        $this->detalleDevolucionRepository = $detalleDevolucionRepo;
    }

    public function index()
    {
        $empleados = $this->empleadoRepository->withRelations();
        $productos = $this->productoRepository->withRelations();

        $backpack = [
            'empleados' => $empleados,
            'productos' => $productos
        ];


        return view('devoluciones-simples.index', $backpack);
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
        $input = $request->all();
        //devolver producto a inventario
        $cierre = Cierre::get()->last();

        $attributesDevolucion = [
            'cierre_id' => $cierre->id,
            'tipo' => 'SIMPLE'
        ];

       $devolucion =  $this->devolucionRepository->create($attributesDevolucion);


       foreach ($request->carrito as $item) {
                //$factura = $this->productoRepository->withRelations()->find($item->id);
            

                $producto = $this->productoRepository->withRelations()->find($item['id']);
                $valor_cambio = $producto->historial_precio->precio_venta / 2;

                $attributesDetallesDevolucion = [
                    'producto_id' => $item['id'],
                    'devolucion_id' => $devolucion->id,
                    'valor_unit_de_cambio' => $valor_cambio,
                    'dinero_adicional' => $valor_cambio * $item['cantidad'],
                    'total_ganancia' => $valor_cambio * $item['cantidad'],
                ];

                $this->detalleDevolucionRepository->create($attributesDetallesDevolucion);
        }


        return response()->json(['response'=>'true']);


    
       

      /*  
            $producto = $this->productoRepository->withRelations()->find($request->producto_id);
            $valor_venta_actual = $producto->historial_precio->precio_venta;
            $valor_porcentaje_cambio =  $this->PORCENTAJE_X_REINGRESO;

            $valor_ingreso_x_devolucion = $valor_venta_actual * (50 / 100);
        
            $valor_real =  $producto->historial_precio->precio_venta * $request->cantidad_unidades_devolucion;
            $ganancia = $valor_real - $request->dinero_devolucion;
       */




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
        //
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
        //
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
