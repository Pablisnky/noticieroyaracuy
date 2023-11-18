<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class acuseRecibo_mail extends Mailable
{
    use Queueable, SerializesModels;

    public $Datos;

    public function __construct($DatosCorreo)
    {
        $this->Datos = $DatosCorreo;
    }

    // Asunto en la bandeja de entrada del usuario que recibe el correo
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nota de prensa publicada',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.acuseCorreo_V',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
