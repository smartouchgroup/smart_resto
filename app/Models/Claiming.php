<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claiming extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeId',
        'motif',
        'description'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class, 'employeeId');
    }

}
