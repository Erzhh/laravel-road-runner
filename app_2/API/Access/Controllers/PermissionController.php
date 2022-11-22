<?php

namespace API\Access\Controllers;

use API\Access\Resources\PermissionMainResource;
use App\Domain\Access\Permissions\Actions\PermissionExportAction;
use App\Domain\Access\Permissions\Actions\PermissionStoreImportAction;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
{

    public function import(): Response
    {
        (new PermissionStoreImportAction())->run();

        return response()->noContent();
    }

    public function export(int $service): PermissionMainResource
    {
        $permissions_with_roles = (new PermissionExportAction($service))->run();

        return new  PermissionMainResource($permissions_with_roles);
    }
}
