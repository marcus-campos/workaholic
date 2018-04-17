<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class State extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'initials'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
