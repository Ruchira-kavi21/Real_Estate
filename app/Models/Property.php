<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $fillable = [
        'user_id',
        'property_name',
        'property_price',
        'offer_type',
        'property_address',
        'property_status',
        'property_type',
        'finish_status',
        'property_description',
        'phone_number',
        'image_1',
        'image_2',
    ];
    protected $casts = [
        'property_price' => 'decimal:2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
