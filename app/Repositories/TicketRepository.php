<?php

namespace App\Repositories;

use App\Interfaces\Repository;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/*
 * In a real world situation this would extend from a base repository
 * and would follow a structure similar to what is found in this article
 * https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5/
 *
 * I'm implementing a very stripped down version only include needed methods
 */
class TicketRepository implements Repository
{
    private Ticket $model;

    public function __construct()
    {
        $this->model = app(Ticket::class);
    }

    public function oldest(): ?Ticket
    {
        return $this->model->query()->oldest()->first();
    }

    public function process(Ticket $ticket): bool
    {
        return $ticket->update(['status' => 1]);
    }

    public function open(): Collection
    {
        return $this->model->query()->whereNull('processed_at')->get();
    }

    public function closed(): Collection
    {
        return $this->model->query()->whereNotNull('processed_at')->get();
    }

    public function forUser($email): Collection
    {
        return $this->model->query()->where('email', $email)->get();
    }

    public function latestProcessed(): ?Ticket
    {
        return $this->model->query()->whereNotNull('processed_at')->latest()->first();
    }

    public function count(): int
    {
        return $this->model->query()->count();
    }

    public function countWhere(string $column, $operator, $value): int
    {
        return $this->model->query()->where($column, $operator, $value)->count();
    }

    // This method would be a lot easier if I'd used a relationship to a user
    public function topUser(): string
    {
        return $this->model->query()
            ->select([
                'email',
                DB::raw('count(email) as ticketCount'),
            ])
            ->groupBy('email')
            ->orderByDesc('ticketCount')
            ->first()
            ?->email ?? '';
    }
}
