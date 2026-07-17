<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PagoAprobadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $factura;

    public function __construct($usuario, $factura)
    {
        $this->usuario = $usuario;
        $this->factura = $factura;
    }

    public function build()
    {
        return $this->subject('✅ Tu pago ha sido aprobado - Fitness Club')
            ->view('emails.pago_aprobado');
    }
}