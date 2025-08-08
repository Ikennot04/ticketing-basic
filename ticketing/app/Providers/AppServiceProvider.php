<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Application\Ticket\RegisterTickets;
use App\Domain\Ticket\TicketRepository;
use App\Infrastructure\Ticket\EloquentTicketRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TicketRepository::class,
            EloquentTicketRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
