<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => null,
        ];
    }
}
