<?php

namespace API\Prices\Resources;

use API\Access\Resources\UserResource;
use API\Catalog\Resources\PriceDocumentResource;
use App\Domain\Prices\Format\Models\Format;
use Core\Resources\BaseJsonResource;

class BonusResources extends BaseJsonResource
{
    protected string $type = 'bonuses';

    /** @var Format $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'bonus' => $this->resource->bonus,
            'installment' => $this->resource->installment,
            'visible' => $this->resource->visible,
            'user_uid' => $this->resource->user_uid,
        ];
    }

    public function getIncluded()
    {
        return [
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
