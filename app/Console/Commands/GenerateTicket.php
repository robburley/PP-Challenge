<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;

class GenerateTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a single ticket';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        Ticket::factory()->create();

        return 0;
    }
}
