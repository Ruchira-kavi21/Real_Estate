<?php

namespace App\Models;

use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasProfilePhoto, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'role','phone', 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function properties()
    {
        return $this->hasMany(Property::class, 'user_id');
    }
}