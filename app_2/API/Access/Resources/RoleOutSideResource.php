<?php

namespace API\Access\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleOutSideResource extends JsonResource
{
    public static $wrap = 'roles';

    public function toArray($request)
    {
        return RoleResource::collection($this);
    }
}
