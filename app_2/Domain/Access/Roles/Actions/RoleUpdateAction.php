<?php
namespace App\Domain\Access\Roles\Actions;


use App\Domain\Access\Roles\DTO\RoleStoreDTO;
use App\Domain\Access\Roles\Helpers\RoleHelper;
use App\Domain\Access\Roles\Models\Role;
use App\Domain\Access\Roles\Services\RolesStoreService;
use App\Domain\Access\Roles\Services\RolesUpdateService;
use Illuminate\Support\Facades\DB;

class RoleUpdateAction{

    public function __construct(
        private Role $role,
        private RoleStoreDTO $dto
    )
    {}

    public function run(){

        try {
            DB::beginTransaction();

                (new RolesUpdateService($this->role, $this->dto))->run();

                $permissions_id = (new RoleHelper())->generatePermissions($this->dto->permissions);

                $this->role->permissions()->sync($permissions_id);

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
