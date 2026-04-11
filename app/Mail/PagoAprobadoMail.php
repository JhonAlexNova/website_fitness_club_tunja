<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PagoAprobadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $usuario,
        public $factura
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: '✅ Tu pago ha sido aprobado - Fitness Club');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.pago_aprobado');
    }
}