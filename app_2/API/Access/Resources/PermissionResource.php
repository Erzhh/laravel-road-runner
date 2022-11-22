<?php

namespace API\Access\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'alias' => $this->alias,
            'roles' => $this->roles->pluck('id')
        ];
    }
}
