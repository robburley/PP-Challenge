<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use Illuminate\Contracts\Support\Arrayable;

class TicketStatistics implements Arrayable
{
    private array $data = [];

    public function __construct(private TicketRepository $ticketRepository)
    {
    }

    public function calculate(): self
    {
        $this->data = [
            'total' => $this->ticketRepository->count(),
            'unprocessed' => $this->ticketRepository->countWhere('processed_at', '=', null),
            'biggest_pita' => $this->ticketRepository->topUser(),
            'last_ticket_processed_at' => $this->ticketRepository->latestProcessed()?->processed_at,
        ];

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
