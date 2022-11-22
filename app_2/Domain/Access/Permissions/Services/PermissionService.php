<?php

namespace App\Domain\Access\Permissions\Services;

use App\Domain\Access\Permissions\Models\Permission;
use App\Domain\Access\Roles\Models\Role;
use Core\BaseService;
use Illuminate\Database\Eloquent\Model;

class PermissionService
{
    function getModel(): Model
    {
        return new Permission();
    }


}
