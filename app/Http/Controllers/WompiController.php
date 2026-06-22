<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Servicio;
use App\Models\DetalleFactura;
use App\Models\Clase;
use App\Models\ClaseRecurrente;
use App\Models\Punto;
use App\Models\UserMembresia;
use App\Models\Membresia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class WompiController extends Controller
{
    public function confirmacion_wompi(Request $request)
    {
        // 1. Validar que el evento realmente viene de Wompi
        if (!$this->validarFirmaWompi($request)) {
            Log::warning('Webhook Wompi rechazado: firma inválida', [
                'referencia' => $request['data']['transaction']['reference'] ?? null,
                'ip' => $request->ip(),
            ]);

            return response()->json(['message' => 'Firma inválida'], 401);
        }

        $customerData_fullName = $request['data']['transaction']['customer_data']['full_name'];
        $firstName = explode(' ', trim($customerData_fullName))[0];

        $status    = $request['data']['transaction']['status'];
        $celular   = str_replace("+", "", $request['data']['transaction']['customer_data']["phone_number"]);
        $reference = $request['data']['transaction']['reference'];

        $factura = Factura::where("referencia", $reference)->get()->last();

        if (!$factura) {
            Log::warning('Webhook Wompi: factura no encontrada', ['referencia' => $reference]);
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }

        $factura->estado = $status;
        $factura->save();

        if ($status == 'APPROVED') {
            $this->generarPuntosCompra($factura);
        }

        $detallesFactura = DetalleFactura::where('factura_id', $factura->id)->get();

        foreach ($detallesFactura as $detalle) {
            if (!is_null($detalle->clase_id)) {
                $claseRecurrente = ClaseRecurrente::find($detalle->clase_id);
                $clase           = Clase::find($claseRecurrente->clase_id);
                $nombreClase     = ucwords(strtolower($clase->nombre));
            }
        }

        // Activar membresía con duración correcta
        if ($factura->tipo == "membresia" && $status == 'APPROVED') {
            $detalle   = $detallesFactura->whereNotNull('membresia_id')->first();
            $membresia = Membresia::find($detalle->membresia_id);

            $fechaInicio      = Carbon::today();
            $fechaVencimiento = $membresia->tipo_duracion === 'meses'
                ? $fechaInicio->copy()->addMonths($membresia->duracion)
                : $fechaInicio->copy()->addDays($membresia->duracion);

            $userMembresia = UserMembresia::where("user_id", $factura->user_id)
                ->where("membresia_id", $detalle->membresia_id)
                ->get()->last();

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

        return response()->json(['message' => 'Evento procesado correctamente'], 200);
    }

    /**
     * Valida que el evento recibido realmente fue enviado por Wompi,
     * comparando el checksum calculado contra el recibido.
     */
    private function validarFirmaWompi(Request $request): bool
    {
        $properties       = $request['signature']['properties'] ?? null;
        $checksumRecibido = $request['signature']['checksum']   ?? null;
        $timestamp        = $request['timestamp']               ?? null;
        $data             = $request['data']                    ?? null;

        if (empty($properties) || empty($checksumRecibido) || empty($timestamp) || empty($data)) {
            return false;
        }

        $cadena = '';
        foreach ($properties as $propertyPath) {
            $cadena .= data_get($data, $propertyPath);
        }

        $cadena .= $timestamp;
        $cadena .= env('WOMPI_EVENTS_SECRET');

        $checksumCalculado = hash('sha256', $cadena);

        return hash_equals($checksumCalculado, $checksumRecibido);
    }

    public function generarPuntosCompra($factura)
    {
        $total  = is_array($factura) ? $factura['total'] : $factura->total;
        $puntos = floor($total / 10000);

        Punto::create([
            'user_id'      => $factura->user_id,
            'tipo_punto'   => "Compra",
            'descripcion'  => "Puntos por compra de clase {$factura->tipo}",
            'puntos'       => $puntos
        ]);

        return response()->json(["message" => "Puntos asignados correctamente"], 200);
    }

    public function sendSMS($phone, $sms)
    {
        $url  = "https://api103.hablame.co/api/sms/v3/send/priority";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "account: 10030010",
            "apiKey: FbJM57Fj2R8aasdQH2jkxckajdhTcl",
            "token: f4edfc8d78f36e847401db4e61a73693"
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = <<<DATA
        {
            "toNumber":"{$phone}",
            "sms":"{$sms}",
            "flash": "0",
            "sc": "890030",
            "request_dlvr_rcpt": "0"
        }
        DATA;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $resp = curl_exec($curl);
        curl_close($curl);
    }
}