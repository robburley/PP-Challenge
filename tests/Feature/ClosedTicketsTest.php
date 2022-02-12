<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClosedTicketsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itExists(): void
    {
        $response = $this->get('/tickets/closed');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function itReturnsClosedTickets(): void
    {
        $ticket = Ticket::factory()->create(['status' => 1]);

        $response = $this->get('/tickets/closed');

        $response->assertSee($ticket->subject);
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotReturnOpenTickets(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get('/tickets/closed');

        $response->assertDontSee($ticket->subject);
    }
}
