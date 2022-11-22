<?php

namespace API\Access\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserOutSideResource extends JsonResource
{
    public static $wrap = 'users';

    public function toArray($request)
    {
        return UserResource::collection($this);
    }
}
