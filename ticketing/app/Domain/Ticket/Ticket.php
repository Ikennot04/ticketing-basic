<?php

namespace App\Domain\Ticket;

class Ticket
{
    

    private ?string $user_id;

    private ?string $subject;

    private ?string $description;

    /**
     * @var string|null
     */
    public ?string $status;

    private ?string $id;

    public function __construct(
        ?string $id = null,
        ?string $user_id = null,
        ?string $subject = null,
        ?string $description = null,
        ?string $status = null,
    ) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->subject = $subject;
        $this->description = $description;
        $this->status = $status;
    }

    public function getID(): ?string
    {
        return $this->id;
    }
     public function getUserID(): ?string
    {
        return $this->user_id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }
}
