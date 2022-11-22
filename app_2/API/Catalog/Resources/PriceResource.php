<?php

namespace API\Catalog\Resources;

use Core\Resources\BaseJsonResource;
use Domain\Catalog\Models\PriceDocument;

class PriceResource extends BaseJsonResource
{
    protected string $type = 'price';

    /** @var PriceDocument $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'product_id' => $this->resource->product_id,
            'cost' => $this->resource->cost,
        ];
    }

}
