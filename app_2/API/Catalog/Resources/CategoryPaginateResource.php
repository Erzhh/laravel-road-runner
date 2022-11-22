<?php

namespace API\Catalog\Resources;

use API\Prices\Resources\LogotypeResources;
use Core\Resources\BasePaginatedResourceCollection;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryPaginateResource extends BasePaginatedResourceCollection
{
    protected string $type = 'categories';

    function getModel(): Model{
        return  new Category();
    }

    public function getIncluded()
    {
        return [
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'children' =>  CategoryResource::collection($this->whenLoaded('children')),
            'parent' => new CategoryResource($this->whenLoaded('parent')),
            'logotype' => new LogotypeResources($this->whenLoaded('logotype')),
        ];
    }
}
