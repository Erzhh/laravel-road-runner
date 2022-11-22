<?php

namespace App\Domain\Access\User\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Access\Roles\Models\Role;
use App\Domain\Prices\Bonus\Models\Bonus;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements  JWTSubject
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'uid',
        'full_name',
        'login',
        'password',
        'role_id',
        'warehouse_id',
        'remember_token',
        'refresh_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        "created_at",
        "updated_at",
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function bonus(): BelongsTo
    {
        return $this->belongsTo(Bonus::class,'uid','user_uid');
    }

    public function permissions()
    {
        return $this->role->permissions();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'id'        => $this->id,
            'full_name' => $this->login,
            'role'      => $this->role_id
        ];
    }
}
