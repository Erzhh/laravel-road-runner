<?php

namespace API\Prices\Resources;

use App\Domain\Prices\Format\Models\Format;
use Core\Resources\BaseJsonResource;

class CharacteristicValueResources extends BaseJsonResource
{
    protected string $type = 'characteristics-value';

    /** @var Format $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'title' => $this->resource->title,
            'characteristic_id' => $this->resource->characteristic_id,
        ];
    }
}
