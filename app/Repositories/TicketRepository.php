<?php

namespace App\Repositories;

use App\Interfaces\Repository;
use App\Models\Ticket;

/*
 * In a real world situation this would extend from a base repository
 * and would follow a structure similar to what is found in this article
 * https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5/
 *
 * I'm implementing a very stripped down version only include needed methods
 */
class TicketRepository implements Repository
{
    private Ticket $model;

    public function __construct()
    {
        $this->model = app(Ticket::class);
    }

    public function oldest(): ?Ticket
    {
        return $this->model->oldest()->first();
    }

    public function process(Ticket $ticket): bool
    {
        return $ticket->update(['status' => 1]);
    }
}
