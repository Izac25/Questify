<?php

namespace App\Listeners;

use App\Events\NotificacaoAluno;
use App\Models\Aluno; // Trocamos User por Aluno aqui
use App\Mail\AtividadeNotificacaoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;

class EnviarEmailNotificacao 
{
    use InteractsWithQueue;

    public function handle(NotificacaoAluno $event): void
    {
        $aluno = Aluno::find($event->id_aluno);

        // Verifica se o aluno existe e se ele tem um e-mail cadastrado
        if ($aluno && $aluno->email) {
            // Envia o e-mail passando a mensagem e os pontos
            Mail::to($aluno->email)->send(
                new AtividadeNotificacaoMail($event->mensagem, $event->pontos)
            );
        }
    }
}