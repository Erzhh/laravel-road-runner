<?php

namespace App\Domain\Access\Permissions\Models;

use App\Domain\Access\Roles\Models\Role;
use Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends BaseModel
{
    use HasFactory;

    public $timestamps = false;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'alias',
        'title',
        'service_id'
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }
}
