<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTicketsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itExists(): void
    {
        $response = $this->get('/users/rcburley@icloud.com/tickets');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function itReturnsTicketsForAUser(): void
    {
        $ticket = Ticket::factory()->create(['email' => 'rcburley@icloud.com']);

        $response = $this->get('/users/rcburley@icloud.com/tickets');

        $response->assertSee($ticket->subject);
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotTicketsForAnotherUser(): void
    {
        $ticket = Ticket::factory()->create(['email' => 'not_rob_burley@icloud.com']);

        $response = $this->get('/users/rcburley@icloud.com/tickets');

        $response->assertDontSee($ticket->subject);
    }
}
