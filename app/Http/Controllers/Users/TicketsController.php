<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Repositories\TicketRepository;

class TicketsController extends Controller
{
    public function __construct(private TicketRepository $ticketRepository)
    {
    }

    /*
     * This method would use route model binding and link directly to a user
     * rather than a field for the user on the Ticket in a real world scenario.
     */
    public function index(string $email): TicketResource
    {
        return new TicketResource($this->ticketRepository->forUser($email));
    }
}
