<?php

namespace App\Services;

use App\Exceptions\TicketProcessorException;
use App\Models\Ticket;

class TicketProcessor
{
    public function __construct(private ?Ticket $ticket)
    {
    }

    public function setTicket(?Ticket $ticket): static
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function process(): bool
    {
        throw_if(!$this->ticket, new TicketProcessorException('No ticket set'));

        return $this->ticket->update(['status' => 1]);
    }
}
