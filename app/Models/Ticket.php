<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'content',
        'name',
        'email',
        'status',
    ];

    public function getStatusAttribute(): bool
    {
        return !is_null($this->attributes['processed_at']);
    }

    public function setStatusAttribute(?bool $value): void
    {
        $this->attributes['processed_at'] = $value ? now() : null;
    }
}
