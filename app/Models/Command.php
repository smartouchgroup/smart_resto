<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeId',
        'dishId',
        'restaurantId',
        'userId',
        'done'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class, 'employeeId');
    }

    public function dishes() {
        return $this->belongsTo(Dish::class, 'dishId');
    }
    public function tickets() {
        return $this->hasMany(Ticket::class, 'ticketId');
    }
    public function restaurant() {
        return $this->belongsTo(restaurant::class,'restaurantId');
    }
}
