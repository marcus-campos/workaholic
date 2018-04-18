<?php
/**
 * User: marcus-campos
 * Date: 16/04/18
 * Time: 22:04
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Str::orderedUuid();
        });
    }
}