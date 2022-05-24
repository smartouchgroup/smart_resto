<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'categoryId',
        'restaurantId',
        'picture1',
        'picture2',
        'picture3',
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class, 'restaurantId');
    }
}
