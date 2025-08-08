<?php

namespace App\Application\Ticket;

use App\Domain\Ticket\Ticket;
use App\Domain\Ticket\TicketRepository;

class RegisterTickets
{
    private TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function create(
        int $user_id,
        string $subject,
        string $description,
        string $status
        
    ): void {
        $data = new Ticket(
            null,
            $user_id,
            $subject,
            $description,
            $status, // Default status
        );
        $this->ticketRepository->create($data);
    }
    public function update(
        string $user_id,
        string $subject,
        string $description,
        string $status,
        
    ) {

        $ticketModel = $this->ticketRepository->findByID($id);
        // dd($product_stock);
        if (! $ticketModel) {
            return response()->json(['message' => 'Ticket not found.']);
        }
        $data = new Ticket(
            null,
            $user_id,
            $subject,
            $description,
            $status,
            
        );
        $this->ticketRepository->update($data);
    }
     public function findAll(): array
    {
        return $this->ticketRepository->findAll();
    }

    public function delete(string $id)
    {
        return $this->ticketRepository->delete($id);
    }
}