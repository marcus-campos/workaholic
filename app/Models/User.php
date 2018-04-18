<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'biography',
        'cpf',
        'cnpj',
        'score',
        'cep',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city_id',
        'state',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'biography',
        'cep',
        'address',
        'city_id',
        'complement',
        'neighborhood',
        'number',
        'phone',
        'photo',
        'role',
        'cnpj',
        'cpf',
        'updated_at',
        'deleted_at',
        'password',
        'remember_token',
    ];

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
