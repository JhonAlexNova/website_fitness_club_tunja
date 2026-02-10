<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

use App\Repositories\ProductoRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\HistorialPrecioProductoRepository;
use App\Repositories\HistorialProductoRepository;
use App\Repositories\CaracteristicaRepository;
use App\Repositories\CaracteristicaProductoRepository;
use App\Repositories\VariacionProductoRepository;
use App\Repositories\ImagenProductoRepository;
use App\Repositories\FunctionsRepository;


use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Storage;
use DB;


use App\Models\DetalleFactura;
use App\Models\Devolucion;

class ProductoController extends AppBaseController
{
    /** @var ProductoRepository $productoRepository*/
    private $productoRepository;
    private $categoriaRepository;
    private $historialPrecioProductoRepository;
    private $historialProductoRepository;
    private $caracteristicaProductoRepository;
    private $variacionProductoRepository;
    private $imagenProductoRepository;
    private $functionsRepository;

    public $PORCENTAJE_X_REINGRESO = 50;

    public function __construct(
        ProductoRepository $productoRepo,
        CategoriaRepository $categoriaRepo,
        HistorialPrecioProductoRepository $historialPrecioProductoRepo,
        HistorialProductoRepository $HistorialProductoRepo,
        CaracteristicaRepository $caracteristicaRepo,
        CaracteristicaProductoRepository $caracteristicaProductoRepo,
        VariacionProductoRepository $variacionProductoRepo,
        ImagenProductoRepository $ImagenProductoRepo,
        FunctionsRepository $FunctionsRepo
    )
    {
        $this->productoRepository = $productoRepo;
        $this->categoriaRepository = $categoriaRepo;
        $this->historialPrecioProductoRepository = $historialPrecioProductoRepo;
        $this->historialProductoRepository = $HistorialProductoRepo;
        $this->caracteristicaRepository = $caracteristicaRepo;
        $this->caracteristicaProductoRepository = $caracteristicaProductoRepo;
        $this->variacionProductoRepository = $variacionProductoRepo;
        $this->imagenProductoRepository = $ImagenProductoRepo;
        $this->functionsRepository = $FunctionsRepo;
    }

    /**
     * Display a listing of the Producto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $productos = $this->productoRepository->withRelations();

        foreach($productos->whereNull("url") as $producto){
            $producto->url = $this->functionsRepository->set_url($producto->nombre);
            $producto->save();
        }

        
        if($request->type=="json"){
            return response()->json($productos);
        }

        $backpack = [
            'productos' => $productos
        ];  

        return view('productos.index',$backpack);
    }

    /**
     * Show the form for creating a new Producto.
     *
     * @return Response
     */
    public function create()
    {
        $categorias = $this->categoriaRepository->withPrincipales();

        $caracteristicas = $this->caracteristicaRepository->all();
        $subcategorias = $this->categoriaRepository->subcategorias();
        $caracteristicas_seleccionadas  = [];

        $backpack = [
            'categorias' => $categorias,
            "caracteristicas" => $caracteristicas,
            "subcategorias" => $subcategorias,
            "caracteristicasSeleccionadas" => $caracteristicas_seleccionadas
        ];  

        return view('productos.create',$backpack);
    }

    /**
     * Store a newly created Producto in storage.
     *
     * @param CreateProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateProductoRequest $request)
    {
        $input = $request->all();

        if($request->file('file')){
            $input['icono'] = Storage::disk('uploads')->putFile('productos',$request->file);            
        }

        DB::beginTransaction();

        try {
            //code...
            $producto = $this->productoRepository->create($input);

            if($request->caracteristicas_seleccionadas){
                foreach($request->caracteristicas_seleccionadas as $caracteristica_id){
                    $attributesCaracteristicasProducto = [
                        "producto_id" => $producto->id,
                        "caracteristica_id" => $caracteristica_id,
                    ];
                    $this->caracteristicaProductoRepository->create($attributesCaracteristicasProducto);
                }
            }

           
    
           // dd($attributes);
         
           DB::commit();
        } catch (\Exception  $e) {

            dd($e);
            DB::rollback();
          /*   echo "Error: " . $e->getMessage(); */
            dd('A ocurrido un error interno.');
        }


        Flash::success('Producto creado correctamente.');

        return redirect(route('productos.edit',$producto->id));
    }



    public function producto_por_referencia(Request $request, $referencia){
        $producto = $this->productoRepository->withRelations()->where('sku',$referencia)->last();

        //return $producto;
        $categorias = $this->categoriaRepository->all();
        if(!is_null($producto)){

            $valor_venta_actual = $producto->historial_precio->precio_venta;
            $valor_porcentaje_cambio =  $this->PORCENTAJE_X_REINGRESO;

            $valor_ingreso_x_devolucion = $valor_venta_actual * (50 / 100);
            
            $backpack = [
                'producto' => $producto,
                'categorias' => $categorias,
                'porcentaje_x_devolucion' => $this->PORCENTAJE_X_REINGRESO,
                'valor_ingreso_x_devolucion' => $valor_ingreso_x_devolucion
            ];
            

            if($request->type=='json'){
                return response()->json($backpack);
            }else{
                return view('ventas.detalle-producto', $backpack);
            }

        }else{
            return response()->json(['error'=>'Producto no encontrado']);
        }

    }


    public function producto_por_categoria(Request $request, $categoria_id){
        $productos = $this->productoRepository->withRelations()->where('categoria_id',$categoria_id)->toArray();
        $data = array_values($productos);

        return $data;

        return response()->json($productos);

    }

    public function allProductos(Request $request, $categoria_id){
        $productos = $this->productoRepository->withRelations()->where('categoria_id',$categoria_id)->toArray();
        $data = array_values($productos);

        return $data;

        return response()->json($productos);

    }




    /**
     * Display the specified Producto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(Request $request, $reference)
    {
        if($request->attribute){
            $producto = $this->productoRepository->withRelations()->where("sku",$reference)->last();
        }else{
            $producto = $this->productoRepository->withRelations()->find($reference);
        }

        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified Producto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $producto = $this->productoRepository->withRelations($id);


        $categorias = $this->categoriaRepository->all();
        $subcategorias = $this->categoriaRepository->subcategorias();
        $caracteristicas = $this->caracteristicaRepository->withRelations();
        //dd($caracteristicas);
        $caracteristicasSeleccionadas = [];

        foreach($producto->caracteristicas_producto as $caracteristicaProcucto){
            $caracteristicasSeleccionadas[] = $caracteristicaProcucto->caracteristica_id;
        }

        //dd($caracteristicasSeleccionadas);

        if (empty($producto)) {
            Flash::error('Producto not found');

            return redirect(route('productos.index'));
        }

        $backpack = [
            'categorias' => $categorias,
            'producto' => $producto,
            "subcategorias" => $subcategorias,
            "caracteristicas" => $caracteristicas,
            "caracteristicasSeleccionadas" => $caracteristicasSeleccionadas
        ];

        return view('productos.edit',$backpack);
    }

    /**
     * Update the specified Producto in storage.
     *
     * @param int $id
     * @param UpdateProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductoRequest $request)
    {

        
        
        $producto = $this->productoRepository->withRelations($id);

        

        if (empty($producto)) {
            Flash::error('Producto not found');

            return redirect(route('productos.index'));
        }

        //VERIFICAR IMAGNES ELIMINADAS
        if(isset($request->imagenesEliminadas)){
            $arrayEliminadas = explode(",",$request->imagenesEliminadas);

            foreach($arrayEliminadas as $imagen_id){
                $imagen = $this->imagenProductoRepository->find($imagen_id);
                Storage::disk('public')->delete($imagen->url);
                $imagen->delete();
            }
        }

        $request["precio_venta"] = str_replace(array(',','.'),'',$request->precio_venta);

        /* if($request->file('file')){
            $request['icono'] = Storage::disk('uploads')->putFile('productos',$request->file);            
        }*/


        //if($)
        if($request->file("imagenPortada")){
            $url_portada = Storage::disk("public")->putFile("imagenes-productos",$request->imagenPortada);
            $attributesPortadaGaleria = [
                "producto_id" => $producto->id,
                "url"  => $url_portada,
                "es_portada" => 1
            ];
            $portadaModel = $this->imagenProductoRepository->create($attributesPortadaGaleria);
        }

        if(isset($request->imagenesGaleria)){
            foreach($request->imagenesGaleria as $imagen){
                $url_portada = Storage::disk("public")->putFile("imagenes-productos",$imagen);
                $attributesPortadaGaleria = [
                    "producto_id" => $producto->id,
                    "url"  => $url_portada,
                    "es_portada" => 0
                ];
                $imagenGaleriaModel = $this->imagenProductoRepository->create($attributesPortadaGaleria);
            }
        }

        /* vetrificar precio */
        if(is_null($producto->historial_precio)){
            $attributes = [
                "producto_id" => $producto->id,
                "fecha_actualizacion" => date("Y-m-d"),
                "valor" => $request->precio_venta
            ];

           $historial_precio =  $this->historialPrecioProductoRepository->create($attributes);
        }else if($producto->historial_precio->valor!=$request->precio_venta){
            $attributes = [
                "producto_id" => $producto->id,
                "fecha_actualizacion" => date("Y-m-d"),
                "valor" => $request->precio_venta
            ];
           $historial_precio =  $this->historialPrecioProductoRepository->create($attributes);
        }



        $producto = $this->productoRepository->update($request->all(), $id);

        Flash::success('Producto updated successfully.');

        return redirect(route('productos.index'));
    }

    /**
     * Remove the specified Producto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $producto = $this->productoRepository->find($id);

        if (empty($producto)) {
            Flash::error('Producto not found');

            return redirect(route('productos.index'));
        }

        //verificar las relaciones
        $detalles_factura = DetalleFactura::where('producto_id',$producto->id)->get();

        /* if(count($detalles_factura)>0){            
            Flash::error('No se a podido eliminar el producto porque tiene registro asociados.');
            return redirect()->back();
        } */


        $this->productoRepository->delete($id);
        Flash::success('Producto deleted successfully.');



        return redirect(route('productos.index'));
    }
}
