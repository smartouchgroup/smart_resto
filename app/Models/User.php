<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'roleId',
        'firstname',
        'lastname',
        'phone',
        'email',
        'profile',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo(Role::class, 'roleId');
    }

    public function getCustomAttribute() {
        switch ($this->roleId) {
            case 3:
                return Organization::whereRelation('User', 'uuid', '=', $this->uuid)->first();
                break;

            case 4:
                return Restaurant::whereRelation('User', 'uuid', '=', $this->uuid)->first();
                break;
            case 5:
                return Employee::whereRelation('User', 'uuid', '=', $this->uuid)->first();
            default:
                return;
                break;
        }
    }
}
