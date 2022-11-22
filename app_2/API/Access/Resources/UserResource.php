<?php

namespace API\Access\Resources;

use App\Domain\Access\User\Models\User;
use App\Support\Helpers\ServiceHelper;
use Core\Resources\BaseJsonResource;
use API\Prices\Resources\BonusResources;

class UserResource extends BaseJsonResource
{
    protected string $type = 'users';

    /** @var User $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'uid' =>  $this->resource->uid,
            'full_name'=> $this->resource->full_name,
            'login'=> $this->resource->login,
            'role_id' => $this->resource->role_id
        ];
    }

    public function getLinks()
    {
        return [
            'role'=> ServiceHelper::gatewayApi().'v1/roles/'.$this->resource->role_id
        ];
    }

    public function getIncluded()
    {
        return [
            'role' => new RoleResource($this->whenLoaded('role')),
            'bonus' => new BonusResources($this->whenLoaded('bonus')),
        ];
    }
}
