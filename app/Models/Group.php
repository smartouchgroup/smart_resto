<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'organizationId',
        'name',
        'localization',
        'phone',
        'isPrincipal'
    ];

    public function organization() {return $this->belongsTo(Organization::class, 'organizationId');}

    public function employees() {return $this->hasMany(Employee::class, 'groupId');}

    public function restaurants() {return $this->hasManyThrough(Restaurant::class, Prestation::class, 'restaurantId');}
}