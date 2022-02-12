<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use App\Services\TicketProcessor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes a single ticket in chronological order';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(TicketProcessor $processor)
    {
        try {
            $ticket = Ticket::oldest()->first();

            if ($ticket) {
                $processor->setTicket($ticket)->process();

                return 0;
            }
        } catch (\Exception $e) {
            Log::error($e);
        }

        return 1;
    }
}
