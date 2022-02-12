<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketStatisticsResource;
use App\Services\TicketStatistics;

class TicketStatisticsController extends Controller
{
    public function __construct(private TicketStatistics $ticketStatistics)
    {
    }

    public function index(): TicketStatisticsResource
    {
        return new TicketStatisticsResource($this->ticketStatistics->calculate());
    }
}
