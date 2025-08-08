<?php

namespace App\Domain\Ticket;

interface TicketRepository
{
    public function findAll(): array;
    public function findByID(string $id): ?Ticket;
    public function create(Ticket $ticket): void;
     public function update(Ticket $ticket): void;

    public function delete(string $id): void;


   
}
