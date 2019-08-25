<?php

namespace App\Models;

use App\Models\UserAddress;
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
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
