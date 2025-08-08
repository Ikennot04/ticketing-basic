<?php

namespace App\Infrastructure\Ticket;

use App\Domain\Ticket\Ticket;
use App\Domain\Ticket\TicketRepository;

class EloquentTicketRepository implements TicketRepository
{
    public function findAll(): array
    {
        $tickets = TicketModel::get();

        return $tickets->map(function ($ticketModel) {
            return new Ticket(
                $ticketModel->id,
                $ticketModel->user_id,
                $ticketModel->subject,
                $ticketModel->description,
                $ticketModel->status,
                
            );
        })->all();
    }

    public function create(Ticket $ticket): void
    {
        $ticketModel = TicketModel::find(id: $ticket->getID()) ?? new TicketModel;
        
        $ticketModel->user_id = $ticket->getUserID();
        $ticketModel->subject = $ticket->getSubject();
        $ticketModel->description = $ticket->getDescription();
        $ticketModel->status = $ticket->getStatus();
        $ticketModel->save();
    }
    public function update(Ticket $ticket): void
    {
        // dd($product);
        $existingTicket = TicketModel::where(column: 'user_id', operator: $ticket->getUserID())->first();
        if ($existingTicket) {
            $existingTicket->subject = $ticket->getSubject();
            $existingTicket->description = $ticket->getDescription();
            $existingTicket->status = $ticket->getStatus();
            
            $existingTicket->save();
        } else {
            $ticketModel = new TicketModel;
            $ticketModel->id = $ticket->getID();
            $ticketModel->user_id = $ticket->getUserID();
            $ticketModel->subject = $ticket->getSubject();
            $ticketModel->description = $ticket->getDescription();
            $ticketModel->status = $ticket->getStatus();
           
            $ticketModel->save();
        }
    }
    public function delete(string $id): void
    {
        TicketModel::where('id', $id)->delete();
    }
    public function findByID(string $id): ?Ticket
    {
        $ticketModel = TicketModel::where('id', $id)->first();

        if (!$ticketModel) {
            return null;
        }

        return new Ticket(
            $ticketModel->id,
            $ticketModel->user_id,
            $ticketModel->subject,
            $ticketModel->description,
            $ticketModel->status,
        );
    }
}