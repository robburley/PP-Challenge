<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateTicketTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function itRunsWithoutError(): void
    {
        $this->artisan('ticket:generate')->assertSuccessful();
    }

    /**
     * @test
     * @return void
     */
    public function itGeneratesAnUnprocessedTicket(): void
    {
        $this->artisan('ticket:generate')->assertSuccessful();

        $this->assertDatabaseCount('tickets', 1);
        $this->assertDatabaseHas('tickets', ['status' => null]);
    }
}
