<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cierre;
use Illuminate\Support\Facades\DB;

use App\Repositories\ProductoRepository;
use App\Repositories\HistorialProductoRepository;
use App\Repositories\CategoriaRepository;

class StockController extends Controller
{
    private $productoRepository;
    private $historialProductoRepository;
    private $categoriaRepository;

    public function __construct(
        ProductoRepository $productoRepo,
        HistorialProductoRepository $HistorialProductoRepo,
        CategoriaRepository $categoriaRepo
    )
    {
        $this->productoRepository = $productoRepo;
        $this->historialProductoRepository = $HistorialProductoRepo;
        $this->categoriaRepository = $categoriaRepo;
    }

    public function index()
    {
        $productos = $this->productoRepository->withRelations();

        $cierreGlobal = Cierre::latest()->first();
        if (!$cierreGlobal) {
            $cierreGlobal = (object)['fecha_fin' => null, 'cierre_caja' => null];
        }

        $configGlobal = DB::table('configuracion')->first();
        if (!$configGlobal) {
            $configGlobal = (object)[
                'razon_social'    => '',
                'nit'             => '',
                'direccion'       => '',
                'celular'         => '',
                'tipo_negocio_id' => null,
            ];
        }

        $categorias = $this->categoriaRepository->all();

        $backpack = [
            'productos'    => $productos,
            'cierreGlobal' => $cierreGlobal,
            'configGlobal' => $configGlobal,
            'categorias'   => $categorias,
        ];

        return view('stock.index', $backpack);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $producto = $this->productoRepository->withRelations()->find($id);

        $backpack = [
            'producto' => $producto
        ];

        return view('stock.edit', $backpack);
    }

    public function update(Request $request, $id)
    {
        $producto = $this->productoRepository->withRelations()->find($id);

        if ($request->action == 'create') {
            $cantidad_nueva = intval($producto->historial_producto->cantidad_actual) + intval($request->cantidad);

            $attributesStockNuevo = [
                'producto_id'      => $producto->id,
                'cantidad'         => $request->cantidad,
                'cantidad_anterior' => $producto->historial_producto->cantidad,
                'cantidad_actual'  => $cantidad_nueva,
                'precio_entrada'   => str_replace([',', '.'], '', $request->precio_entrada),
                'tipo'             => 'INGRESO'
            ];

            $this->historialProductoRepository->create($attributesStockNuevo);

        } else if ($request->action == 'edit') {
            $historial = $this->historialProductoRepository->all()
                ->where('producto_id', $producto->id)
                ->last();

            $attributesStockNuevo = [
                'cantidad_actual' => $request->cantidad
            ];

            $update = $this->historialProductoRepository->update($attributesStockNuevo, $historial->id);

            return $update;
        }

        return response()->json(['message' => 'Stock actualizado correctamente']);
    }

    public function destroy($id)
    {
        //
    }
}