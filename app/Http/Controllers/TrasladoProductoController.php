<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTrasladoProductoRequest;
use App\Http\Requests\UpdateTrasladoProductoRequest;
use App\Repositories\TrasladoProductoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Repositories\ProductoRepository;
use App\Repositories\HistorialProductoRepository;

class TrasladoProductoController extends AppBaseController
{
    /** @var TrasladoProductoRepository $trasladoProductoRepository*/
    private $trasladoProductoRepository;
    private $productoRepository;
    private $historialProductoRepository;

    public function __construct(
        TrasladoProductoRepository $trasladoProductoRepo,
        ProductoRepository $productoRepo,
        HistorialProductoRepository $HistorialProductoRepo
    )
    {
        $this->trasladoProductoRepository = $trasladoProductoRepo;
        $this->productoRepository = $productoRepo;
        $this->historialProductoRepository = $HistorialProductoRepo;
    }

    /**
     * Display a listing of the TrasladoProducto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $trasladoProductos = $this->trasladoProductoRepository->all();


        $urlApi = "http://185.80.128.202/api/get_empresas.php";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlApi); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        $data = curl_exec($ch); 
        curl_close($ch); 
        $empresas = json_decode($data);

        // Cierra la conexión con cURL
        $backpack = [
            "empresas" => $empresas
        ];

        return view('traslado_productos.index',$backpack);
    }

    /**
     * Show the form for creating a new TrasladoProducto.
     *
     * @return Response
     */
    public function create()
    {
        return view('traslado_productos.create');
    }

    /**
     * Store a newly created TrasladoProducto in storage.
     *
     * @param CreateTrasladoProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateTrasladoProductoRequest $request)
    {

       // dd($request->all());

       $attributesTraslados = [
         "negocio_destino_id" => $request->negocio_destino_id
       ];
        
       $traslado = $this->trasladoProductoRepository->create($attributesTraslados);

        foreach($request->id as $index => $producto_id){

            $producto = $this->productoRepository->withRelations()->find($producto_id);



            $cantidad = $request->cantidad[$index];
            
            $cantidad_nueva = intval($producto->historial_producto->cantidad_actual) - intval($cantidad);
        
            //$this->detalleFacturaRepository->create($attributesDetallesFactura);

            $attributesStcokNuevo = [
                'producto_id' => $producto_id,
                'cantidad' => $cantidad,
                'cantidad_anterior' => $producto->historial_producto->cantidad,
                'cantidad_actual' => $cantidad_nueva,
                "tipo" => "TRASLADO",
                "traslado_producto_id" => $traslado->id
            ];

            

            //return $attributesStcokNuevo;
            $stock = $this->historialProductoRepository->create($attributesStcokNuevo);
        }

        Flash::success('Traslado creado correctamente, No olvide subir el nuevo inventario en el segundo negocio');

        return redirect(route('trasladoProductos.index'));
    }

    /**
     * Display the specified TrasladoProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $trasladoProducto = $this->trasladoProductoRepository->find($id);

        if (empty($trasladoProducto)) {
            Flash::error('Traslado Producto not found');

            return redirect(route('trasladoProductos.index'));
        }

        return view('traslado_productos.show')->with('trasladoProducto', $trasladoProducto);
    }

    /**
     * Show the form for editing the specified TrasladoProducto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $trasladoProducto = $this->trasladoProductoRepository->find($id);

        if (empty($trasladoProducto)) {
            Flash::error('Traslado Producto not found');

            return redirect(route('trasladoProductos.index'));
        }

        return view('traslado_productos.edit')->with('trasladoProducto', $trasladoProducto);
    }

    /**
     * Update the specified TrasladoProducto in storage.
     *
     * @param int $id
     * @param UpdateTrasladoProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTrasladoProductoRequest $request)
    {
        $trasladoProducto = $this->trasladoProductoRepository->find($id);

        if (empty($trasladoProducto)) {
            Flash::error('Traslado Producto not found');

            return redirect(route('trasladoProductos.index'));
        }

        $trasladoProducto = $this->trasladoProductoRepository->update($request->all(), $id);

        Flash::success('Traslado Producto updated successfully.');

        return redirect(route('trasladoProductos.index'));
    }

    /**
     * Remove the specified TrasladoProducto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $trasladoProducto = $this->trasladoProductoRepository->find($id);

        if (empty($trasladoProducto)) {
            Flash::error('Traslado Producto not found');

            return redirect(route('trasladoProductos.index'));
        }

        $this->trasladoProductoRepository->delete($id);

        Flash::success('Traslado Producto deleted successfully.');

        return redirect(route('trasladoProductos.index'));
    }
}
