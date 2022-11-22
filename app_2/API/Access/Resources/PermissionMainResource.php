<?php

namespace API\Access\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionMainResource extends JsonResource
{
    public static $wrap = 'permissions';

    public function toArray($request)
    {
        return PermissionResource::collection($this);
    }
}
