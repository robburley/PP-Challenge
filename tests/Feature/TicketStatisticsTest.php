<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketStatisticsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itExists(): void
    {
        $response = $this->get('/stats');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function itReturnsAccurateStatistics(): void
    {
        Ticket::factory()
            ->count(3)
            ->state(new Sequence(
                ['status' => 0, 'email' => 'rcburley@icloud.com'],
                ['status' => 0, 'email' => 'not_rcburley@icloud.com'],
                ['email' => 'rcburley@icloud.com', 'processed_at' => '2022-01-01 00:00:00'],
            ))
            ->create();

        $response = $this->get('/stats');

        $response->assertJson([
            'total' => 3,
            'unprocessed' => 2,
            'biggest_pita' => 'rcburley@icloud.com',
            'last_ticket_processed_at' => '2022-01-01 00:00:00',
        ]);
    }
}
