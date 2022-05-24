<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'employeeId',
        'ticketNumber',
        'paymentMethod'
    ];
    public function employees() {
        return $this->hasMany(Employee::class,'employeeId');
    }
    public function command() {
        return $this->belongsTo(Command::class,'commandId');
    }
}
    