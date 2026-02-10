<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SmsTemplate;
use App\Models\SmsMessage;
use App\Models\SmsDelivery;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;

class SmsSendController extends AppBaseController
{
    public function create()
    {
        $users = User::where('estado', 'activo')->get();
        $templates = SmsTemplate::pluck('name', 'id');
        return view('sms.send_sms', compact('users', 'templates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|array',
            'template_id' => 'nullable|exists:sms_templates,id',
            'message'     => 'required_without:template_id|string',
            'send_at'     => 'nullable|date|after_or_equal:now',
        ]);

        $isScheduled = $request->filled('send_at');
        $sendAt = $isScheduled ? $request->send_at : null;

        // Mensaje base: de plantilla o personalizado
        $rawMessage = $request->message;
        if ($request->filled('template_id')) {
            $template = SmsTemplate::findOrFail($request->template_id);
            $rawMessage = $template->content;
        }

        // Crear el mensaje
        $smsMessage = SmsMessage::create([
            'message' => $rawMessage,
            'send_at' => $sendAt,
            'is_scheduled' => $isScheduled,
        ]);

        foreach ($request->user_id as $userId) {
            $user = User::find($userId);
            if (!$user || !$user->celular) continue;

            $finalMessage = str_replace(
                ['[nombres]', '[apellidos]'],
                [$user->primer_nombre, $user->primer_apellido],
                $rawMessage
            );

            $delivery = SmsDelivery::create([
                'sms_message_id' => $smsMessage->id,
                'user_id' => $user->id,
                'status' => $isScheduled ? 'pendiente' : 'enviado',
                'sent_at' => $isScheduled ? null : now(),
            ]);

            if (!$isScheduled) {
                try {
                   // $this->sendSMS("57" . $user->celular, $finalMessage);
                   // sleep(1);
                } catch (\Exception $e) {
                    $delivery->update(['status' => 'fallo']);
                    Log::error("Fallo al enviar SMS a usuario {$user->id}: " . $e->getMessage());
                }
            }
        }

        $msg = $isScheduled ? 'Mensajes programados correctamente.' : 'SMS enviados correctamente.';
        return redirect()->route('sms.send.create')->with('success', $msg);
    }

    public function sendSMS($phone, $sms)
    {
        $url = "https://api103.hablame.co/api/sms/v3/send/priority";

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "account: 10030010",
            "apiKey: FbJM57Fj2R8aasdQH2jkxckajdhTcl",
            "token: f4edfc8d78f36e847401db4e61a73693"
        ];

        $data = json_encode([
            "toNumber" => $phone,
            "sms" => $sms,
            "flash" => "0",
            "sc" => "890030",
            "request_dlvr_rcpt" => "0"
        ]);

        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $data
        ]);

        $resp = curl_exec($curl);
        curl_close($curl);
        // Log::info("SMS response: " . $resp);
    }
}
