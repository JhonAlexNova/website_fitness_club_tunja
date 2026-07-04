<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Membresia;
use App\Models\Pasadia;
use App\Models\Factura;
use App\Models\Servicio;
use App\Models\DetalleFactura;
use App\Models\Producto;
use App\Models\CoffeeProduct;
use Storage;

class FacturaApiController extends Controller
{
    public function getReferencia()
    {
        $cantidad_facturas = Factura::count() + 1;
        return date("YmdHis") . "{$cantidad_facturas}" . rand(1000, 9999);
    }

    public function store(Request $request)
    {
        $referencia = $this->getReferencia();

        $factura = Factura::create([
            "referencia" => $referencia,
            "user_id"    => $request->user()->id,
            "tipo"       => $request->tipo,
            "tipo_pago"  => $request->tipo_pago,
            "estado"     => "PENDING"
        ]);

        $total = 0;

        // ── Membresía ──────────────────────────────────────────────────────
        if ($request->membresia_id) {
            $membresia = Membresia::find($request->membresia_id);
            DetalleFactura::create([
                "factura_id"   => $factura->id,
                "membresia_id" => $membresia->id,
                "cantidad"     => 1,
                "total"        => $membresia->costo
            ]);
            $total += $membresia->costo;
        }

        // ── Pasadía ────────────────────────────────────────────────────────
        if ($request->pasadia_id) {
            $pasadia = Pasadia::find($request->pasadia_id);
            DetalleFactura::create([
                "factura_id" => $factura->id,
                "pasadia_id" => $pasadia->id,
                "cantidad"   => 1,
                "total"      => $pasadia->costo
            ]);
            $total += $pasadia->costo;
        }

        // ── Servicios ──────────────────────────────────────────────────────
        foreach ($request->servicios ?? [] as $servicio) {
            $servicioModel = Servicio::find($servicio["id"]);
            DetalleFactura::create([
                "factura_id"  => $factura->id,
                "servicio_id" => $servicioModel->id,
                "cantidad"    => 1,
                "total"       => $servicioModel->valor,
                "clase_id"    => $servicio["clase_id"] ?? null
            ]);
            $total += $servicioModel->valor;
        }

        // ── Productos Coffee Shop ────────────────────────────────────────────
        if ($request->tipo === 'coffee_shop') {
            foreach ($request->productos ?? [] as $item) {
                $productoId = $item["product"]["id"] ?? null;
                $quantity   = $item["quantity"] ?? 1;

                if (!$productoId) continue;

                $coffeeProducto = CoffeeProduct::find($productoId);

                if (!$coffeeProducto) continue;

                $totalProducto = $coffeeProducto->precio * $quantity;

                DetalleFactura::create([
                    "factura_id"  => $factura->id,
                    "producto_id" => $coffeeProducto->id,
                    "cantidad"    => $quantity,
                    "total"       => $totalProducto
                ]);

                $total += $totalProducto;
            }
        } else {
            // ── Productos Tienda ──────────────────────────────────────────────
            foreach ($request->productos ?? [] as $item) {
                $productoId = $item["product"]["id"] ?? null;
                $quantity   = $item["quantity"] ?? 1;

                if (!$productoId) continue;

                $productoModel = Producto::find($productoId);

                if (!$productoModel) continue;

                $productoModel->load("historial_precio");
                $precio = $productoModel->historial_precio
                    ? $productoModel->historial_precio->valor
                    : $productoModel->precio_venta;

                $totalProducto = $precio * $quantity;

                DetalleFactura::create([
                    "factura_id"  => $factura->id,
                    "precio_id"   => $productoModel->historial_precio?->id,
                    "producto_id" => $productoModel->id,
                    "cantidad"    => $quantity,
                    "total"       => $totalProducto
                ]);

                $total += $totalProducto;
            }
        }

        // ── Comprobante de transferencia ───────────────────────────────────
        if ($request->comprobante) {
            $ruta = $this->guardarBase64EnStorage($request->comprobante, 'comprobantes-pagos');
            $factura->comprobante = $ruta;
        }

        // ── Puntos ────────────────────────────────────────────────────────
        $factura->cantidad_puntos = $request->cantidad_puntos ?? 0;
        $factura->valor_puntos    = env("VALOR_PUNTOS", 500) * ($request->cantidad_puntos ?? 0);

        if ($factura->valor_puntos > 0) {
            $total = $total - $factura->valor_puntos;
        }

        $factura->total = $total;
        $factura->save();

        // ── Respuesta por tipo de pago ─────────────────────────────────────
        if ($request->tipo_pago === 'transfer') {
            return response()->json([
                'response' => "ok",
                'id'       => $factura->id,
                "message"  => "El pago está en proceso. Tan pronto sea aprobado se le enviará una notificación.",
            ]);
        }

        if ($request->tipo_pago === 'wompi') {
            $total = round($total * 1.05);
            $factura->total = $total;
            $factura->save();

            $prod_integrity     = env("PROD_INTEGRITY");
            $cadena_concatenada = "{$referencia}{$total}00COP{$prod_integrity}";
            $signature          = hash("sha256", $cadena_concatenada);

            return response()->json([
                'response'      => "ok",
                "publicKey"     => env("PUBLIC_KEY_PROD"),
                "currency"      => 'COP',
                "amountInCents" => $total . '00',
                "reference"     => $referencia,
                'signature'     => $signature
            ]);
        }
    }

    public function historialTienda(Request $request)
    {
        $facturas = Factura::with(['detalles.producto.portada'])
            ->where('user_id', $request->user()->id)
            ->where('tipo', 'COMPRA_TIENDA')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($factura) {
                return [
                    'id'         => $factura->id,
                    'referencia' => $factura->referencia,
                    'tipo_pago'  => $factura->tipo_pago,
                    'total'      => $factura->total,
                    'estado'     => $factura->estado,
                    'comentario' => $factura->comentario,
                    'fecha'      => $factura->created_at->format('d/m/Y H:i'),
                    'productos'  => $factura->detalles->map(function ($detalle) {
                        return [
                            'nombre'   => optional($detalle->producto)->nombre ?? 'Producto eliminado',
                            'imagen'   => optional(optional($detalle->producto)->portada)->url,
                            'cantidad' => $detalle->cantidad,
                            'total'    => $detalle->total,
                        ];
                    }),
                ];
            });

        return response()->json($facturas);
    }

    public function misFacturas(Request $request)
    {
        $facturas = Factura::with(['detalles.membresia', 'detalles.pasadia'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($factura) {
                return [
                    'id'         => $factura->id,
                    'referencia' => $factura->referencia,
                    'tipo'       => $factura->tipo,
                    'tipo_pago'  => $factura->tipo_pago,
                    'total'      => $factura->total,
                    'estado'     => $factura->estado,
                    'comentario' => $factura->comentario,
                    'membresia'  => optional($factura->detalles->first()?->membresia)->nombre ?? '—',
                    'pasadia'    => optional($factura->detalles->first()?->pasadia)->nombre ?? null,
                    'fecha'      => $factura->created_at->format('d/m/Y'),
                ];
            });

        return response()->json($facturas);
    }

    function guardarBase64EnStorage($base64String, $folder = 'archivos', $fileName = null)
    {
        @list($meta, $contenido) = explode(',', $base64String);
        preg_match('/data:(.*?);base64/', $meta, $matches);
        $mime     = $matches[1] ?? 'application/octet-stream';
        $ext      = explode('/', $mime)[1] ?? 'bin';
        $fileName = $fileName ?? uniqid() . '.' . $ext;
        $decoded  = base64_decode($contenido);
        $path     = $folder . '/' . $fileName;
        Storage::disk('public')->put($path, $decoded);
        return $path;
    }
}