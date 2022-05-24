<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactionTypeId',
        'employeeId',
        'amount'
    ];

    public function transaction_type() {
        return $this->belongsTo(TransactionType::class, 'transactionTypeId');
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'employeeId');
    }
}
