<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OpenTicketsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itExists(): void
    {
        $response = $this->get('/tickets/open');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function itReturnsOpenTickets(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get('/tickets/open');

        $response->assertSee($ticket->subject);
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotReturnClosedTickets(): void
    {
        $ticket = Ticket::factory()->create(['status' => 1]);

        $response = $this->get('/tickets/open');

        $response->assertDontSee($ticket->subject);
    }
}
