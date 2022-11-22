<?php

namespace API\Catalog\Resources;

use Core\Resources\BaseJsonResource;
use Domain\Catalog\Models\Category;

class CategoryShortResource extends BaseJsonResource
{
    protected string $type = 'categories';

    /** @var Category $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'name' => $this->resource->name,
        ];
    }

    public function getIncluded()
    {
        return [
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'children' => new CategoryResource($this->whenLoaded('children')),
        ];
    }
}
