<?php

namespace API\Catalog\Resources;

use Core\Resources\BaseJsonResource;
use Domain\Catalog\Models\Quality;

class QualityResource extends BaseJsonResource
{
    protected string $type = 'qualities';

    /** @var Quality $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'name' => $this->resource->name,
            'code' => $this->resource->code,
            'alias' => $this->resource->alias,
            'status' => $this->resource->status,
        ];
    }
}
