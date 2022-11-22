<?php

namespace API\Access\Resources;

use Core\Resources\BaseJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends BaseJsonResource
{
    protected string $type = 'roles';

    public function getAttributes()
    {
        return [
            'title' => $this->resource->title,
        ];
    }
//
//    public function getIncluded()
//    {
//        return [
//            'permissions' => new PermissionResource($this->whenLoaded('permissions')),
//        ];
//    }
}
