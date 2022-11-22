<?php
namespace App\Domain\Access\Roles\Services;

use App\Domain\Access\Roles\DTO\RoleStoreDTO;

class RolesStoreService extends  RoleGetModelService {

    public function __construct(
        private RoleStoreDTO $dto
    )
    {}

    public function run(): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return $this->getModel()
                ->query()
                ->create([
                    'title' => $this->dto->title
                ]);
    }
}
