<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AtividadeNotificacaoMail extends Mailable
{
    use Queueable, SerializesModels;

    // Declaração correta das propriedades
    public $mensagem;
    public $pontos;

    /**
     * O construtor recebe os dados que o Evento enviar
     */
    public function __construct($mensagem, $pontos = 0)
    {
        $this->mensagem = $mensagem;
        $this->pontos = $pontos;
    }

    /**
     * Define o assunto do e-mail
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔔 Nova Atividade e Pontos para Você!',
        );
    }

    /**
     * Define qual arquivo HTML será usado como corpo do e-mail
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notificacao_atividade',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}