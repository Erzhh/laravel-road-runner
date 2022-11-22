<?php

namespace API\Catalog\Resources;

use API\Handbook\Resources\WarehouseResource;
use Core\Resources\BaseJsonResource;
use Domain\Catalog\Models\Stock;

class StockResource extends BaseJsonResource
{
    protected string $type = 'stock';

    /** @var Stock $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'warehouse_id' => $this->resource->warehouse_id,
            'product_id' => $this->resource->product_id,
            'quality_id' => $this->resource->quality_id,
            'quantity' => $this->resource->quantity
        ];
    }

    public function getIncluded()
    {
        return [
            'warehouse' => new WarehouseResource($this->whenLoaded('warehouse')),
            'product' => new ProductResource($this->whenLoaded('product')),
            'quality' => new QualityResource($this->whenLoaded('quality')),
        ];
    }
}
