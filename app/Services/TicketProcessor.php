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

        // This would be done via a repository which would be mockable in a unit test
        return $this->ticket->update(['status' => 1]);
    }
}
