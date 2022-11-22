<?php

namespace API\Catalog\Resources;

use Domain\Catalog\Models\Stock;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductStocksResource extends JsonResource
{
    /** @var Stock $resource */
    public $resource;

    public function toArray($request)
    {
        return [
            'warehouse_id' => $this->resource->warehouse_id,
            'quality_id' => $this->resource->quality_id,
            'quantity' => $this->resource->quantity
        ];
    }
}
