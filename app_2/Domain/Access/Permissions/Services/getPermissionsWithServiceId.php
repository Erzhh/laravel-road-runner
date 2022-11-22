<?php
namespace App\Domain\Access\Permissions\Services;

use App\Domain\Access\Services\QueryBuilder\GetServiceToken;
use App\Support\Helpers\PermissionHelper;

class getPermissionsWithServiceId{

    public function run():array
    {
        $service    = (new GetServiceToken())->run();
        $body       = explode('.', $service->token)[1];
        $service_id = json_decode( base64_decode( $body) )?->id;

        return array(
            'service_id'=>  $service_id,
            'permissions'=> PermissionHelper::getAllPermissions()
        );
    }

}
