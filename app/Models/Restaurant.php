<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'description',
        'slogan',
        'schedules',
        'localization',
        'availability'
    ];

    public function user() {return $this->belongsTo(User::class, 'userId');}

    public function dishes() {return $this->hasMany(Dish::class, 'restaurantId');}

    public function menus() {return $this->hasMany(Menu::class,'restaurantId');}

    public function categories() {return $this->hasMany(Category::class, 'restaurantId');}

    public function motifs() {return $this->hasMany(Motif::class);}

    public function organizations() {return $this->belongsToMany(Organization::class, 'org_restos','organization_id','restaurant_id');}

    public function commands() {return $this->hasMany(Command::class,'restaurantId');}
}
