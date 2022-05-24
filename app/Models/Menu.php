<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'dishId',
        'restaurantId',
        'dayId'
    ];

    public function restaurant() {
        return $this->belongsTo(Restaurant::class, 'restaurantId');
    }

    public function day() {
        return $this->belongsTo(Day::class, 'dayId');
    }

    public function getCustomAttribute() {
        $dishes = [];
        if ($dishesId = json_decode($this->dishId, true)) {
            foreach($dishesId as $id) {
                array_push($dishes, Dish::find($id));
            }
        }

        return $dishes;
    }
}
