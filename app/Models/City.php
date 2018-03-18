<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'state_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function cityFromToId($name)
    {
        return $this->where('name', 'like', "%$name%")->first()->id;
    }
}
