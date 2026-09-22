<?php

namespace App\Http\Controllers\WebSite;

use App\Http\Controllers\Controller;
use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Membresia;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PagoController extends Controller
{
    public function iniciar(Request $request)
    {
        // El carrito viaja en un campo oculto como JSON desde la vista.
        // Lo convertimos a array antes de ejecutar la validación de Laravel.
        if (is_string($request->input('items'))) {
            $decodedItems = json_decode($request->input('items'), true);
            $request->merge(['items' => is_array($decodedItems) ? $decodedItems : []]);
        }

        $data = $request->validate([
            'tipo' => 'required|in:tienda,membresia',
            'items' => 'required_if:tipo,tienda|array|min:1',
            'items.*.id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1|max:99',
            'membresia_id' => 'nullable|integer',
            'nombre' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'telefono' => 'required|string|max:30',
            'password' => auth()->check() ? 'nullable' : 'required|string|min:8|confirmed',
        ]);

        $reference = 'WEB-' . now()->format('YmdHis') . '-' . strtoupper(bin2hex(random_bytes(3)));

        [$total, $lines] = $data['tipo'] === 'membresia'
            ? $this->membershipLines($data['membresia_id'] ?? null)
            : $this->productLines($data['items']);

        if ($total <= 0 || !$lines) {
            return back()->withErrors(['items' => 'No encontramos productos disponibles para pagar.']);
        }

        $userId = auth()->id();
        if (!$userId) {
            $guest = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['nombre'],
                    'username' => $data['email'],
                    'celular' => $data['telefono'],
                    'tipo' => 'Cliente',
                    'estado' => 'activo',
                    'password' => Hash::make($data['password']),
                ]
            );
            $userId = $guest->id;
        }

        $factura = DB::transaction(function () use ($data, $reference, $total, $lines, $userId) {
            $factura = Factura::create([
                'referencia' => $reference,
                'user_id' => $userId,
                'tipo' => $data['tipo'] === 'membresia' ? 'membresia' : 'COMPRA_TIENDA',
                'tipo_pago' => 'wompi',
                'total' => $total,
                'estado' => 'PENDING',
                'comentario' => 'Compra web: ' . $data['nombre'] . ' | ' . $data['email'] . ' | ' . $data['telefono'],
            ]);

            foreach ($lines as $line) {
                DetalleFactura::create(array_merge(['factura_id' => $factura->id], $line));
            }

            return $factura;
        });

        $amountInCents = $total * 100;
        $signature = hash('sha256', $reference . $amountInCents . 'COP' . env('PROD_INTEGRITY'));

        return view('website.pagos.checkout', [
            'factura' => $factura,
            'customer' => $data,
            'amountInCents' => $amountInCents,
            'signature' => $signature,
            'publicKey' => env('PUBLIC_KEY_PROD'),
        ]);
    }

    public function respuesta(Request $request)
    {
        return view('website.pagos.respuesta', ['reference' => $request->query('id') ?: $request->query('reference')]);
    }

    private function productLines(array $items): array
    {
        $total = 0;
        $lines = [];

        foreach ($items as $item) {
            $producto = Producto::with('historial_precio')->find($item['id']);
            if (!$producto) continue;

            $price = (int) ($producto->historial_precio->valor ?? $producto->precio_venta ?? 0);
            $quantity = (int) $item['quantity'];
            $lineTotal = $price * $quantity;
            $total += $lineTotal;
            $lines[] = [
                'producto_id' => $producto->id,
                'precio_id' => optional($producto->historial_precio)->id,
                'cantidad' => $quantity,
                'total' => $lineTotal,
            ];
        }

        return [$total, $lines];
    }

    private function membershipLines(?int $id): array
    {
        $membership = $id ? Membresia::find($id) : null;
        if (!$membership) return [0, []];

        return [(int) $membership->costo, [[
            'membresia_id' => $membership->id,
            'cantidad' => 1,
            'total' => (int) $membership->costo,
        ]]];
    }
}
