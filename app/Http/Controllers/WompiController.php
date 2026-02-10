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

class WompiController extends Controller
{



    public function confirmacion_wompi(Request $request)
    {
       

      /*   
      
        $amountInCents = $jsonToArray['data']['transaction']['amount_in_cents'];
        $createdAt = $jsonToArray['data']['transaction']['created_at'];
        $currency = $jsonToArray['data']['transaction']['currency'];
        $customerData_fullName = $jsonToArray['data']['transaction']['customer_data']['full_name'];
        $customerData_phoneNumber = $jsonToArray['data']['transaction']['customer_data']['phone_number'];
        $customerEmail = $jsonToArray['data']['transaction']['customer_email'];
        $id_transaction = $jsonToArray['data']['transaction']['id'];
        $paymentMethod_extra_brand = $jsonToArray['data']['transaction']['payment_method']['extra']['brand'];
        $paymentMethod_extra_externalIdentifier = $jsonToArray['data']['transaction']['payment_method']['extra']['external_identifier'];
        $paymentMethod_extra_lastFour = $jsonToArray['data']['transaction']['payment_method']['extra']['last_four'];
        $paymentMethod_extra_name = $jsonToArray['data']['transaction']['payment_method']['extra']['name'];
        $paymentMethod_installments = $jsonToArray['data']['transaction']['payment_method']['installments'];
        $paymentMethod_type = $jsonToArray['data']['transaction']['payment_method']['type'];
        $status = $jsonToArray['data']['transaction']['status'];
        
        $redirect_url = $jsonToArray['data']['transaction']['redirect_url'];
        
        //VALIDAR DE QUE PROVIENE LA COMPRA POR EL TIPO 
        // 
        // 
        // */
        
        //  $celular = $request['data']['transaction']['customer_data']["phone_number"];

        $customerData_fullName = $request['data']['transaction']['customer_data']['full_name'];
        $firstName = explode(' ', trim($customerData_fullName))[0];


        $status = $request['data']['transaction']['status'];
        $celular = str_replace("+", "", $request['data']['transaction']['customer_data']["phone_number"]);

        $reference = $request['data']['transaction']['reference'];

        $factura = Factura::where("referencia",$reference)->get()->last();
        $factura->estado = $status;
        $factura->save();

        $total = $factura->total;

        if($status=='APPROVED'){
            $puntos = $this->generarPuntosCompra($factura);
        }

        $detallesFactura = DetalleFactura::where('factura_id',$factura->id)->get();

        foreach($detallesFactura as $detalle){
            if(!is_null($detalle->clase_id)){
                $claseRecurrente = ClaseRecurrente::find($detalle->clase_id);
                $clase = Clase::find($claseRecurrente->clase_id);
                 $nombreClase = ucwords(strtolower($clase->nombre));
            }
        }

        /* membresias activar*/
        if($factura->tipo == "membresia"){
            $userMembresia = UserMembresia::where("user_id",$factura->user_id)
                ->where("membresia_id",$detalle->membresia_id)
                ->get()->last();

                if(!$userMembresia){
                    $userMembresia = new UserMembresia();
                    $userMembresia->user_id = $factura->user_id;
                    $userMembresia->membresia_id = $detalle->membresia_id;
                    $userMembresia->fecha_inicio = date("Y-m-d H:i:s");
                    $userMembresia->fecha_vencimiento = date("Y-m-d H:i:s", strtotime("+1 month"));
                }
            $userMembresia->estado = "activa";
            $userMembresia->save();
        }


        if(isset($clase)){
           //$this->sendSMS($celular,"Te has inscrito en la clase {$nombreClase} correctamente, no faltes");
        }else{
           // $this->sendSMS($celular, "Hola, {$firstName}, Gracias por tu compra. Revisa tu correo electrónico para conocer los detalles de tu pedido No {$reference}.");
        }
        
    }


    public function generarPuntosCompra($factura) {
        $total = is_array($factura) ? $factura['total'] : $factura->total;
        $puntos = floor($total / 10000);
        
        $attributes = [
            'user_id' => $factura->user_id,
            'tipo_punto' => "Compra",
            'descripcion' => "Puntos por compra de clase {$factura->tipo}",
            'puntos' => $puntos
        ];

        Punto::create($attributes);

        return response()->json(["message"=>"Puntos asignados correctamente"],200);

    }


    public function sendSMS($phone, $sms){

        $url = "https://api103.hablame.co/api/sms/v3/send/priority";
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "account: 10030010",
            "apiKey: FbJM57Fj2R8aasdQH2jkxckajdhTcl",
            "token: f4edfc8d78f36e847401db4e61a73693"
        );
        
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
        $celular = '"'.$phone.'"';
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
        //dd($data,$resp);
      //  writeSmsLog("Result trying to send SMS: ", $resp);
    }

    
}
