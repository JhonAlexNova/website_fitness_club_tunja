<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDevolucionRequest;
use App\Http\Requests\UpdateDevolucionRequest;
use App\Repositories\DevolucionRepository;
use App\Repositories\ProductoRepository;
use App\Repositories\DetalleDevolucionRepository;


use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;


use App\Repositories\DetalleFacturaRepository;
use App\Repositories\HistorialProductoRepository;
use App\Repositories\FacturaRepository;

use App\Models\Devolucion;
use App\Models\Cierre;

class DevolucionController extends AppBaseController
{
    /** @var DevolucionRepository $devolucionRepository*/
    private $devolucionRepository;
    private $productoRepository;
    private $detalleFacturaRepository;
    private $historialProductoRepository;
    private $facturaRepository;
    private $detalleDevolucionRepository;
    
    public $PORCENTAJE_X_REINGRESO = 50;



    public function __construct(
        DevolucionRepository $devolucionRepo,
        ProductoRepository $productoRepo,
        DetalleFacturaRepository $detalleFacturaRepo,
        HistorialProductoRepository $HistorialProductoRepo,
        FacturaRepository $facturaRepo,
        DetalleDevolucionRepository $detalleDevolucionRepo
    )
    {
        $this->devolucionRepository = $devolucionRepo;
        $this->productoRepository = $productoRepo;
        $this->detalleFacturaRepository = $detalleFacturaRepo;
        $this->historialProductoRepository = $HistorialProductoRepo;
        $this->facturaRepository = $facturaRepo;
        $this->detalleDevolucionRepository = $detalleDevolucionRepo;
    }


    

    /**
     * Display a listing of the Devolucion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $devolucions = $this->devolucionRepository->withRelations();

        return view('devolucions.index')
            ->with('devolucions', $devolucions);
    }

    /**
     * Show the form for creating a new Devolucion.
     *
     * @return Response
     */
    public function create()
    {
        $tipos = Devolucion::get_tipos();
        $productos = $this->productoRepository->all();
        $bakcpack = [
            'tipos' => $tipos,
            'productos' => $productos
        ];
        return view('devolucions.create',$bakcpack);
    }

    /**
     * Store a newly created Devolucion in storage.
     *
     * @param CreateDevolucionRequest $request
     *
     * @return Response
     */
    public function store(CreateDevolucionRequest $request)
    {
        $input = $request->all();
        //devolver producto a inventario
        $cierre = Cierre::get()->last();

        $attributesDevolucion = [
            'cierre_id' => $cierre->id,
            'tipo' => $request->tipo
        ];

       $devolucion =  $this->devolucionRepository->create($attributesDevolucion);
       

       $producto = $this->productoRepository->withRelations()->find($request->producto_id);
       $valor_venta_actual = $producto->historial_precio->precio_venta;
       $valor_porcentaje_cambio =  $this->PORCENTAJE_X_REINGRESO;

       $valor_ingreso_x_devolucion = $valor_venta_actual * (50 / 100);

       $valor_real =  $producto->historial_precio->precio_venta * $request->cantidad_unidades_devolucion;
       $ganancia = $valor_real - $request->dinero_devolucion;

    //   dd($valor_ingreso_x_devolucion);

        //AttributesDetalle

        

        

        if($request->tipo=='X_PRODUCTO'){
            $attributesDetallesDevolucion = [
                'devolucion_id' => $devolucion->id,
                'producto_id' => $request->producto_id,
                'cantidad_unidades_devolucion' => $request->cantidad_unidades_devolucion,
                'valor_unit_de_cambio' => str_replace(array(',','.'), '', $request->valor_unit_de_cambio),
                'total_devuelto' => str_replace(array(',','.'), '',$request->dinero_devolucion),
                'total_ganancia' => $ganancia,
                'producto_cambio_id' => str_replace(array(',','.'), '',$request->producto_cambio_id),
                'dinero_adicional' => str_replace(array(',','.'),'',$request->dinero_pendiente)
            ];
        }else if($tipo='X-DINERO'){
            $attributesDetallesDevolucion = [
                'devolucion_id' => $devolucion->id,
                'producto_id' => $request->producto_id,
                'cantidad_unidades_devolucion' => $request->cantidad_unidades_devolucion,
                'valor_unit_de_cambio' => str_replace(".","",$request->valor_unit_de_cambio),
                'total_devuelto' =>  str_replace(".", "", $request->dinero_devolucion),
                'total_ganancia' => $ganancia
            ];

           // dd($input, $attributesDetallesDevolucion);
        }   

        $this->detalleDevolucionRepository->create($attributesDetallesDevolucion);


        $producto = $this->productoRepository->withRelations()->find($request->producto_id);
        $cantidad_nueva = intval($producto->historial_producto->cantidad_actual) + intval($request->cantidad_unidades_devolucion);

        //
        $attributesStcokNuevo = [
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad_unidades_devolucion,
            'cantidad_anterior' => $producto->historial_producto->cantidad,
            'cantidad_actual' => $cantidad_nueva
        ];
        $stock = $this->historialProductoRepository->create($attributesStcokNuevo);

        Flash::success('Devolucion realizada correctamente.');

        return redirect(route('devolucions.index'));
    }

    /**
     * Display the specified Devolucion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devolucion = $this->devolucionRepository->find($id);

        if (empty($devolucion)) {
            Flash::error('Devolucion not found');

            return redirect(route('devolucions.index'));
        }

        return view('devolucions.show')->with('devolucion', $devolucion);
    }

    /**
     * Show the form for editing the specified Devolucion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devolucion = $this->devolucionRepository->find($id);

        if (empty($devolucion)) {
            Flash::error('Devolucion not found');

            return redirect(route('devolucions.index'));
        }

        return view('devolucions.edit')->with('devolucion', $devolucion);
    }

    /**
     * Update the specified Devolucion in storage.
     *
     * @param int $id
     * @param UpdateDevolucionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevolucionRequest $request)
    {
        $devolucion = $this->devolucionRepository->find($id);

        if (empty($devolucion)) {
            Flash::error('Devolucion not found');

            return redirect(route('devolucions.index'));
        }

        $devolucion = $this->devolucionRepository->update($request->all(), $id);

        Flash::success('Devolucion updated successfully.');

        return redirect(route('devolucions.index'));
    }

    /**
     * Remove the specified Devolucion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devolucion = $this->devolucionRepository->find($id);

        if (empty($devolucion)) {
            Flash::error('Devolucion not found');

            return redirect(route('devolucions.index'));
        }

        $this->devolucionRepository->delete($id);

        Flash::success('Devolucion deleted successfully.');

        return redirect(route('devolucions.index'));
    }
}
