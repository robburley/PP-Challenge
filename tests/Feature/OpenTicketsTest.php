<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
    public function itReturnsOpenTicketsInOrder(): void
    {
        $tickets = Ticket::factory()
            ->count(3)
            ->state(new Sequence(
                ['created_at' => now()->subMinute()],
                ['created_at' => now()->subMinutes(2)],
                ['created_at' => now()->subMinutes(3)],
            ))
            ->create();

        $response = $this->get('/tickets/open');

        $response->assertJson($tickets->toArray());
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
