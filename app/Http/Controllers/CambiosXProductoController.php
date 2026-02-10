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

use DB;





use App\Repositories\EmpleadoRepository;
use App\Repositories\ProductoRepository;
use App\Repositories\CierreDiaRepository;



use App\Repositories\DetalleFacturaRepository;
use App\Repositories\HistorialProductoRepository;
use App\Repositories\FacturaRepository;

use App\Models\Devolucion;
use App\Models\Cierre;
use App\Models\CambioProducto;

class CambiosXProductoController extends Controller
{
    
    
    private $empleadoRepository;
    private $productoRepository;


    private $devolucionRepository;
    private $detalleFacturaRepository;
    private $historialProductoRepository;
    private $facturaRepository;
    private $detalleDevolucionRepository;
    
    public $PORCENTAJE_X_REINGRESO = 50;
    private $cierreDiaRepository;



    public function __construct(
        EmpleadoRepository $empleadoRepo,
        ProductoRepository $productoRepo,
        DevolucionRepository $devolucionRepo,
        DetalleFacturaRepository $detalleFacturaRepo,
        HistorialProductoRepository $HistorialProductoRepo,
        FacturaRepository $facturaRepo,
        DetalleDevolucionRepository $detalleDevolucionRepo,
        CierreDiaRepository $cierreDiaRepo
    )
    {
        $this->empleadoRepository = $empleadoRepo;

        $this->devolucionRepository = $devolucionRepo;
        $this->productoRepository = $productoRepo;
        $this->detalleFacturaRepository = $detalleFacturaRepo;
        $this->historialProductoRepository = $HistorialProductoRepo;
        $this->facturaRepository = $facturaRepo;
        $this->detalleDevolucionRepository = $detalleDevolucionRepo;
        $this->cierreDiaRepository = $cierreDiaRepo;
    }

    public function index()
    {
        $empleados = $this->empleadoRepository->withRelations();
        $productos = $this->productoRepository->withRelations();

        $backpack = [
            'empleados' => $empleados,
            'productos' => $productos
        ];



        return view('cambios-x-producto.index', $backpack);
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
        DB::beginTransaction();
        
        try {
            $input = $request->all();
            $referencia = date('YmdHis');
           $cierre =  $this->cierreDiaRepository->validar_dia();

            
            $attributesCambio = [
                'cierre_id' => $cierre->id,
                'valor' => $request->total
            ];

            $cambio_x_producto = CambioProducto::create($attributesCambio);


            
            foreach ($request->carrito as $item) {
                $producto = $this->productoRepository->withRelations()->find($item['id']);
                
                if($item["tipo"]=="SALIDA"){
                    //$factura = $this->productoRepository->withRelations()->find($item->id);
                    
                    /*$attributesDetallesFactura = [
                        'factura_id' => $referencia,
                        'precio_id' => $item['historial_precio']['id'],
                        'producto_id' => $item['id'],
                        'cantidad' => $item['cantidad'],
                        'total' => $item['total']
                    ];
                    */
                    
        

                   
                    $cantidad_nueva = intval($producto->historial_producto->cantidad_actual) - intval($item['cantidad']);
        
                    //$this->detalleFacturaRepository->create($attributesDetallesFactura);
        
                    $attributesStcokNuevo = [
                        'producto_id' => $item['id'],
                        'cantidad' => $item['cantidad'],
                        'cantidad_anterior' => $producto->historial_producto->cantidad,
                        'cantidad_actual' => $cantidad_nueva,
                        "tipo" => $item["tipo"],
                        "cambio_producto_id" => $cambio_x_producto->id
                    ];

                    //return $attributesStcokNuevo;
                    $stock = $this->historialProductoRepository->create($attributesStcokNuevo);
                }else {
                    $cantidad_nueva = intval($producto->historial_producto->cantidad_actual) + intval($item["cantidad"]);

                    
                    $attributesStcokNuevo = [
                        'producto_id' => $item['id'],
                        'cantidad' => $item['cantidad'],
                        'cantidad_anterior' => $producto->historial_producto->cantidad,
                        'cantidad_actual' => $cantidad_nueva,
                        'precio_entrada' => str_replace(array(',','.'),'',$producto->historial_producto->precio_entrada),
                        "tipo" => $item["tipo"],
                        "cambio_producto_id" => $cambio_x_producto->id
                    ];
        
                    $this->historialProductoRepository->create($attributesStcokNuevo);
                }
            }
            Flash::success('Venta realizada correctamente');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd('A ocurrido un error interno.',$e);
        }

        return response()->json(['response'=>true]);
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
