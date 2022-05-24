<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'restaurantId'
    ];

    public function restaurant() {return $this->belongsTo(Restaurant::class, 'restaurantId');}
    public function dishes() {return $this->hasMany(Dish::class);}
}
