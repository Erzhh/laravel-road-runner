<?php

namespace API\Prices\Resources;

use App\Domain\Prices\Format\Models\Format;
use Core\Resources\BaseJsonResource;

class CharacteristicResources extends BaseJsonResource
{
    protected string $type = 'characteristics';

    /** @var Format $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'property' => $this->resource->property,
            'maket_id' => $this->resource->maket_id,
            'created_at' => $this->resource->created_at,
        ];
    }

    public function getIncluded()
    {
        return [
            'values' => CharacteristicValueResources::collection($this->whenLoaded('values')),
            'products' => CharacteristicProductResources::collection($this->whenLoaded('products')),
            'maket' => new MaketResources($this->whenLoaded('maket')),
        ];
    }
}
