<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessTicketTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function itRunsWithoutError(): void
    {
        Ticket::factory()->create();

        $this->artisan('ticket:process')->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function itProcessesASingleTicket(): void
    {
        Ticket::factory()->create();

        $this->assertDatabaseHas('tickets', ['processed_at' => null]);

        $this->artisan('ticket:process')->assertSuccessful();

        $this->assertDatabaseMissing('tickets', ['processed_at' => null]);
    }

    /**
     * @test
     * @return void
     */
    public function itFailsGracefullyWhenNoJobsAreAvailable(): void
    {
        $this->artisan('ticket:process')->assertFailed();
    }
}
