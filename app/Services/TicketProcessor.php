<?php

namespace App\Services;

use App\Exceptions\TicketProcessorException;
use App\Models\Ticket;
use App\Repositories\TicketRepository;

class TicketProcessor
{
    public function __construct(
        private TicketRepository $ticketRepository, private ?Ticket $ticket
    ) {
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

        return $this->ticketRepository->process($this->ticket);
    }
}
