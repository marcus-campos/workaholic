<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Service\Storage\StorageService;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
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
        'chat_user',
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    

    /**
     * @return mixed
     */
    public function getPhotoAttribute($value)
    {
        if (!$value) {
            $value = asset('assets/images/users/default-user.png');
            return $value;
        }

        return (new StorageService())->getFileUrl($value);
    }
}
