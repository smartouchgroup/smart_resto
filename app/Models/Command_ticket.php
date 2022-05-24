<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command_ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'command_id',
        'ticket_id'
    ];
}
