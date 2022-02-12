<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Repositories\TicketRepository;

class OpenTicketsController extends Controller
{
    public function __construct(private TicketRepository $ticketRepository)
    {
    }

    public function index(): TicketResource
    {
        return new TicketResource($this->ticketRepository->open());
    }
}
