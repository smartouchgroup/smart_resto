<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Org_resto extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_id',
        'restaurant_id'
    ];

}