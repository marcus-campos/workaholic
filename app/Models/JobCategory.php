<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class JobCategory extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description'
    ];
}
