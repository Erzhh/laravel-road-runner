<?php

namespace App\Domain\Access\Permissions\Actions;

use App\Domain\Access\Permissions\Services\getPermissionsWithServiceId;
use App\Domain\GateWay\Permissions\Services\getAllPermissionsService;

class PermissionImportAction {

    public function __construct()
    {}

    public function run()
    {

        $another_services = (new getAllPermissionsService())->run();

        $this_service = (new getPermissionsWithServiceId())->run();

        array_push($another_services, $this_service);

        return $another_services;
    }
}
