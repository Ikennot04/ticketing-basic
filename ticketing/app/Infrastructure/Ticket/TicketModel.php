<?php

namespace App\Infrastructure\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketModel extends Model
{
    // use SoftDeletes;

    protected $table = 'tickets';

    protected $fillable = ['user_id', 'subject', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
