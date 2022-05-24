<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'background',
        'description',
        'slogan',
        'schedules',
        'ticketNumber',
        'ticketPrice',
        'allowedDishPerDay'
    ];

    public function user() {return $this->belongsTo(User::class, 'userId');}

    public function groups() {return $this->hasMany(Group::class, 'organizationId');}

    public function employees() {return $this->hasMany(Employee::class, 'organizationId');}

    public function restaurants() {return $this->belongsToMany(Restaurant::class, 'org_restos', 'organization_id','restaurant_id');}

}
