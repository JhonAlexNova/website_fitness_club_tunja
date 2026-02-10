<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Membresia;
use App\Models\Factura;
use App\Models\Servicio;
use App\Models\DetalleFactura;
use App\Models\Producto;
use Storage;

class FacturaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getReferencia(){
        $cantidad_facturas = Factura::get()->count();
        $cantidad_facturas = $cantidad_facturas + 1;

        $referencia = date("YmdHis")."{$cantidad_facturas}".rand(1000, 9999);

        
        return $referencia;
    }

    public function store(Request $request)
    {
        
        $referencia = $this->getReferencia();

        $attributes = [
            "referencia" => $referencia,
            "user_id" => request()->user()->id,
            "tipo" => $request->tipo,
            "estado" => "PENDING"
        ];

        $factura = Factura::create($attributes);
        $total = 0;

        /* servicios */
        /* membresia */

        if($request->membresia_id){
            $membresia = Membresia::find($request->membresia_id);
            $attributesDetalle = [
                "factura_id" => $factura->id,
                "membresia_id" => $membresia->id,
                "cantidad" => 1,
                "total"	=> $membresia->costo
            ];

            $total += $membresia->costo;

            $DetalleFactura = DetalleFactura::create($attributesDetalle);
        }else{

        }

        foreach($request->servicios as $servicio){
            $servicioModel = Servicio::find($servicio["id"]);
            $valor =  $servicioModel->valor;
            $attributesDetalle = [
                "factura_id" => $factura->id,
                "servicio_id" => $servicioModel["id"],
                "cantidad" => 1,
                "total"	=> $servicioModel->valor,
                "clase_id" => $servicio["clase_id"]
            ];
            DetalleFactura::create($attributesDetalle);
            $total+=$valor;
        }


        /* compra de productos */
        foreach($request->productos as $item){
            $producto  = $item["product"];
            $productoModel = Producto::with("historial_precio")->find($producto["id"]);
            $totalProducto = $productoModel->historial_precio->valor * $item["quantity"];
           // $response = [$total, $productoModel->historial_precio->valor, $item["quantity"]];

            $attributesDetalle = [
                "factura_id" => $factura->id,
                "precio_id" => $productoModel->historial_precio->id,
                "producto_id" => $productoModel->id,
                "cantidad" => $item["quantity"],
                "total"	=>  $totalProducto
            ];
            DetalleFactura::create($attributesDetalle);
            $total+=$totalProducto;
        }

        


        if($request->comprobante){
            $ruta = $this->guardarBase64EnStorage($request->comprobante, 'comprobantes-pagos');
            $factura->comprobante = $ruta;
        }
        $factura->cantidad_puntos = $request->cantidad_puntos;
        $factura->valor_puntos = env("VALOR_PUNTOS") * $request->cantidad_puntos;

        if($request->valor_puntos>0){
            $total = $total - $request->valor_puntos;
        }

        $factura->total = $total;
        $factura->save();

        if($request->tipo_pago=='transfer'){
            return response()->json([
                'response' =>  "ok",
                "message" => "EL pago esta en proceso, tan pronto este aprobado se le enviara una notificiación.",
            ]);
        }elseif($request->tipo_pago=='wompi'){
            $prod_integryity = env("PROD_INTEGRITY");
            $cadena_concatenada = "{$referencia}{$total}00COP{$prod_integryity}";
            $signature = hash ("sha256", $cadena_concatenada);
            
            $backpack = [
              'response' =>  "ok",
              "publicKey" => env("PUBLIC_KEY_PROD"), 
              "currency" => 'COP',
              "amountInCents" => $total.'00',
              "reference" => $referencia,
              'signature' => $signature
            ];	
    
            return response()->json($backpack);
        }


    }


    function guardarBase64EnStorage($base64String, $folder = 'archivos', $fileName = null) {
        // Separar metadata del contenido
        @list($meta, $contenido) = explode(',', $base64String);
        
        // Detectar tipo MIME
        preg_match('/data:(.*?);base64/', $meta, $matches);
        $mime = $matches[1] ?? 'application/octet-stream';

        // Obtener extensión
        $ext = explode('/', $mime)[1] ?? 'bin';

        // Generar nombre de archivo si no se envía
        if (!$fileName) {
            $fileName = uniqid() . '.' . $ext;
        }

        // Decodificar base64
        $decoded = base64_decode($contenido);

        // Guardar en storage/app/public/{folder}
        $path = $folder . '/' . $fileName;
        Storage::disk('public')->put($path, $decoded);

        return $path;
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
