<?php

namespace App\Providers;

use App\Events\NotificacaoAluno;
use App\Listeners\EnviarEmailNotificacao;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * O mapeamento de eventos para os ouvintes (listeners).
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // Registro da sua Notificação
        NotificacaoAluno::class => [
            EnviarEmailNotificacao::class,
        ],
    ];

   
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Determine se os eventos e ouvintes devem ser descobertos automaticamente.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}