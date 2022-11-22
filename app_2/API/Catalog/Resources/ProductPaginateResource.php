<?php

namespace API\Catalog\Resources;

use Core\Resources\BasePaginatedResourceCollection;

class ProductPaginateResource extends BasePaginatedResourceCollection
{
    public $collects = ProductResource::class;

    public function getIncluded()
    {
        return [
//            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
