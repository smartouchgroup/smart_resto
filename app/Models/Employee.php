<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'organizationId',
        'groupId',
        'identityCode',
        'first_login'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    public function organization() {
        return $this->belongsTo(Organization::class, 'organizationId');
    }
    public function group() {
        return $this->belongsTo(Group::class, 'groupId');
    }

    public function account() {
        return $this->hasOne(Account::class,'employeeId');
    }
    public function tickets() {
        return $this->hasMany(Ticket::class,'employeeId');
    }
    public function commands() {
        return $this->hasMany(Command::class,'employeeId');
    }
}
