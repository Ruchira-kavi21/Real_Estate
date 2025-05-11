<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    //
    protected $fillable = [
        'email', 
        'subscribed_at'
    ];
    protected $dates = ['subscribed_at'];
}
