<?php
namespace App\Domain\Access\Roles\Services;

use App\Domain\Access\Roles\DTO\RoleStoreDTO;
use App\Domain\Access\Roles\Models\Role;

class RolesUpdateService extends  RoleGetModelService {

    public function __construct(
        private Role $role,
        private RoleStoreDTO $dto
    )
    {}

    public function run(): int
    {
        return $this->role->update([
                    'title' => $this->dto->title
                ]);
    }
}
