<?php
namespace App\Domain\Access\Roles\Helpers;

use App\Domain\Access\Permissions\Services\PermissionFirstOrCreateService;

class RoleHelper{

    public function generatePermissions(array $permissions): array
    {
        $permission_ids = [];
        foreach ($permissions as $permission){
            $permission = (new PermissionFirstOrCreateService($permission))->run();
            $permission_ids[] = $permission->id;
        }

        return $permission_ids;
    }


    public static function PermissionsUpsertGenerate($services): array
    {
        $array = [];

        foreach ($services as $service){

            foreach ($service['permissions'] as $permission){
                $array[] = [
                    'alias' => $permission,
                    'service_id' => $service['service_id'],
                ];
            }

        }

        return $array;
    }
}
