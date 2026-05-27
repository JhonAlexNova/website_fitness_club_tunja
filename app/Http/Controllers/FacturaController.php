<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Repositories\FacturaRepository;
use App\Repositories\ProductoRepository;

use App\Repositories\DetalleFacturaRepository;
use App\Repositories\HistorialProductoRepository;
use App\Repositories\CierreDiaRepository;

use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PagoAprobadoMail;

use App\Models\Cierre;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;

use Auth;

use App\Models\UserMembresia;
use App\Models\Membresia;
use App\Models\DetalleFactura;
use Carbon\Carbon;

class FacturaController extends AppBaseController
{
    /** @var FacturaRepository $facturaRepository*/
    private $facturaRepository;
    private $productoRepository;
    private $detalleFacturaRepository;
    private $historialProductoRepository;
    private $cierreDiaRepository;
    

    public function __construct(
        FacturaRepository $facturaRepo,
        ProductoRepository $productoRepo,
        DetalleFacturaRepository $detalleFacturaRepo,
        HistorialProductoRepository $HistorialProductoRepo,
        CierreDiaRepository $cierreDiaRepo
    )
    {
        $this->facturaRepository = $facturaRepo;
        $this->productoRepository = $productoRepo;
        $this->detalleFacturaRepository = $detalleFacturaRepo;
        $this->historialProductoRepository = $HistorialProductoRepo;
        $this->cierreDiaRepository = $cierreDiaRepo;
    }

    /**
     * Display a listing of the Factura.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $facturas = $this->facturaRepository->all();


        return view('facturas.index')
            ->with('facturas', $facturas);
    }


    public function cambiarEstado(Request $request)
    {
        $factura = $this->facturaRepository->all()
            ->where("referencia", $request->referencia)
            ->first();

        if (empty($factura)) {
            Flash::error('Factura not found');
            return response()->json(['response' => false, 'message' => 'Factura not found']);
        }

        $estadoAnterior  = $factura->estado;
        $factura->estado     = $request->estado;
        $factura->comentario = $request->comentario;
        $factura->save();

        if ($request->estado === 'APPROVED' && $estadoAnterior !== 'APPROVED') {
            $usuario = User::find($factura->user_id);

            if ($usuario) {
                Notificacion::create([
                    'user_id' => $usuario->id,
                    'titulo'  => '✅ Pago aprobado',
                    'mensaje' => "Tu pago con referencia {$factura->referencia} ha sido aprobado. ¡Ya puedes disfrutar tu membresía!",
                ]);

                Mail::to($usuario->email)->send(new PagoAprobadoMail($usuario, $factura));
            }

            // Crear/activar membresía si la factura es de tipo membresia
            if ($factura->tipo === 'membresia') {
                $detalle   = DetalleFactura::where('factura_id', $factura->id)
                    ->whereNotNull('membresia_id')
                    ->first();

                if ($detalle) {
                    $membresia = Membresia::find($detalle->membresia_id);

                    $fechaInicio      = Carbon::today();
                    $fechaVencimiento = $membresia->tipo_duracion === 'meses'
                        ? $fechaInicio->copy()->addMonths($membresia->duracion)
                        : $fechaInicio->copy()->addDays($membresia->duracion);

                    $userMembresia = UserMembresia::where('user_id', $factura->user_id)
                        ->where('membresia_id', $detalle->membresia_id)
                        ->latest()
                        ->first();

                    if (!$userMembresia) {
                        $userMembresia = new UserMembresia();
                        $userMembresia->user_id      = $factura->user_id;
                        $userMembresia->membresia_id = $detalle->membresia_id;
                    }

                    $userMembresia->fecha_inicio      = $fechaInicio;
                    $userMembresia->fecha_vencimiento = $fechaVencimiento;
                    $userMembresia->estado            = 'activa';
                    $userMembresia->save();
                }
            }
        }

        Flash::success('Estado actualizado correctamente.');
        return response()->json(['response' => true]);
    }

    /**
     * Show the form for creating a new Factura.
     *
     * @return Response
     */
    public function create()
    {
        return view('facturas.create');
    }

    /**
     * Store a newly created Factura in storage.
     *
     * @param CreateFacturaRequest $request
     *
     * @return Response
     */
    public function store(CreateFacturaRequest $request)
    {

        DB::beginTransaction();
        
        try {
            $input = $request->all();
            $referencia = date('YmdHis');
            $cierre =  $this->cierreDiaRepository->validar_dia();


            $attributesfactura = [
                'cierre_id' => $cierre->id,
                'id' => $referencia,
                'total' => $request->total,
                "empleado_id" => Auth::user()->id
            ];
            
            $factura =  $this->facturaRepository->create($attributesfactura);
            
            foreach ($request->carrito as $item) {
                //$factura = $this->productoRepository->withRelations()->find($item->id);
                $attributesDetallesFactura = [
                    'factura_id' => $referencia,
                    'precio_id' => $item['historial_precio']['id'],
                    'producto_id' => $item['id'],
                    'cantidad' => $item['cantidad'],
                    'total' => $item['total']
                ];
    
    
                
                $producto = $this->productoRepository->withRelations()->find($item['id']);
                $cantidad_nueva = intval($producto->historial_producto->cantidad_actual) - intval($item['cantidad']);
    
                $this->detalleFacturaRepository->create($attributesDetallesFactura);
    
                $attributesStcokNuevo = [
                    'producto_id' => $item['id'],
                    'cantidad' => $item['cantidad'],
                    'cantidad_anterior' => $producto->historial_producto->cantidad,
                    'cantidad_actual' => $cantidad_nueva,
                    'tipo' => 'SALIDA'
                ];

                //return $attributesStcokNuevo;
                $stock = $this->historialProductoRepository->create($attributesStcokNuevo);
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
     * Display the specified Factura.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $factura = $this->facturaRepository->withRelations()->find($id);

        if($request->type=="json"){
            return $factura;
        }

        if (empty($factura)) {
            Flash::error('Factura not found');

            return redirect(route('facturas.index'));
        }

        return view('facturas.show')->with('factura', $factura);
    }

    /**
     * Show the form for editing the specified Factura.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $factura = $this->facturaRepository->find($id);

        if (empty($factura)) {
            Flash::error('Factura not found');

            return redirect(route('facturas.index'));
        }

        return view('facturas.edit')->with('factura', $factura);
    }

    /**
     * Update the specified Factura in storage.
     *
     * @param int $id
     * @param UpdateFacturaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacturaRequest $request)
    {
        $factura = $this->facturaRepository->find($id);

        if (empty($factura)) {
            Flash::error('Factura not found');

            return redirect(route('facturas.index'));
        }

        $factura = $this->facturaRepository->update($request->all(), $id);

        Flash::success('Factura updated successfully.');

        return redirect(route('facturas.index'));
    }

    /**
     * Remove the specified Factura from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $factura = $this->facturaRepository->find($id);

        if (empty($factura)) {
            Flash::error('Factura not found');

            return redirect(route('facturas.index'));
        }

        $this->facturaRepository->delete($id);

        Flash::success('Factura deleted successfully.');

        return redirect(route('facturas.index'));
    }
}
