<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['employeeId', 'amount'];

    public function amount()
    {
        return $this->belongsTo(Employee::class, 'employeeId');
    }
}
