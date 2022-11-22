<?php

namespace App\Domain\Access\Permissions\Services;


use App\Domain\Access\Roles\Helpers\RoleHelper;
use App\Domain\Access\Services\DTO\ServiceStoreDto;
use App\Domain\Access\Services\Models\ServiceToken;

class PermissionStoreService extends  PermissionService{

    public function __construct(private array $permissions_services)
    {}

    public function run(): int
    {
        $permissions = RoleHelper::PermissionsUpsertGenerate($this->permissions_services);

        $service = $this->getModel()->newQuery()
                                    ->upsert(
                                        $permissions,
                                        ['alias'] , ['alias','service_id']
                                    );
        return $service;
    }

}

