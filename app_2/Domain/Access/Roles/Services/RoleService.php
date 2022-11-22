<?php

namespace App\Domain\Access\Roles\Services;

use App\Domain\Access\Permissions\Models\Permission;
use App\Domain\Access\Permissions\Services\PermissionFirstOrCreateService;
use App\Domain\Access\Roles\Models\Role;
use Core\BaseService;
use Illuminate\Database\Eloquent\Model;

class RoleService extends BaseService
{
    function getModel(): Model
    {
        return new Role();
    }

    public function store(array $data): Model
    {
        $role = parent::store($data);
        $this->syncPermissionsByAlias($role, $data['permissions']);
        return $role;
    }

    public function update(Model $model, array $data): bool
    {
        parent::update($model, $data);
        $this->syncPermissionsByAlias($model, $data['permissions']);
        return true;
    }

    private function syncPermissionsByAlias(Model $model, array $permissions): void
    {
        $permission_ids = [];
        foreach ($permissions as $permission){
            $permission = (new PermissionFirstOrCreateService($permission))->run();
            $permission_ids[] = $permission->id;
        }
        $model->permissions()->sync($permission_ids);
    }
}
