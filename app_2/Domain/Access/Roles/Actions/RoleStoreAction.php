<?php
namespace App\Domain\Access\Roles\Actions;


use App\Domain\Access\Permissions\Services\PermissionFirstOrCreateService;
use App\Domain\Access\Roles\DTO\RoleStoreDTO;
use App\Domain\Access\Roles\Helpers\RoleHelper;
use App\Domain\Access\Roles\Services\RolesStoreService;
use Illuminate\Support\Facades\DB;

class RoleStoreAction{

    public function __construct(
        private RoleStoreDTO $dto
    )
    {}

    public function run(){

        try {
            DB::beginTransaction();

                $role = (new RolesStoreService($this->dto))->run();

                $permissions_id = (new RoleHelper())->generatePermissions($this->dto->permissions);

                $role->permissions()->sync($permissions_id);

            DB::commit();

            return $role;
        }
        catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
