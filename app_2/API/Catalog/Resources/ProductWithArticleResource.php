<?php

namespace API\Catalog\Resources;

use Core\Resources\BaseJsonResource;
use Domain\Catalog\Models\Product;

class ProductWithArticleResource extends BaseJsonResource
{
    protected string $type = 'products';

    /** @var Product $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'name' => $this->resource->name,
            'uid' => $this->resource->uid,
        ];
    }

    public function getIncluded()
    {
        return [
            'stock' =>  StockResource::collection($this->whenLoaded('stock')),
            'detail' => new ProductDetailResource($this->whenLoaded('detail')),
        ];
    }
}
