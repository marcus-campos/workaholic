<?php

namespace App\Models;

class UserAddress extends BaseModel
{
    protected $fillable = [
        'address',
        'number',
        'complement',
        'neighborhood',
        'zip_code',
        'city_id',
        'user_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
