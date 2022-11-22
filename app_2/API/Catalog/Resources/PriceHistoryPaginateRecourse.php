<?php

namespace API\Catalog\Resources;

use Core\Resources\BasePaginatedResourceCollection;

class PriceHistoryPaginateRecourse extends BasePaginatedResourceCollection
{
    public $collects = PriceHistoryResource::class;

    public function getIncluded()
    {
        return [
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
