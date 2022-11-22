<?php

namespace API\Catalog\Resources;

use API\Prices\Resources\FormatResources;
use API\Prices\Resources\LogotypeResources;
use Core\Resources\BaseFildsJsonResource;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryResource extends BaseFildsJsonResource
{
    protected string $type = 'categories';

    function getModel(): Model{
        return  new Category();
    }

    public function getIncluded()
    {
        return [
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'formats' => FormatResources::collection($this->whenLoaded('formats')),
            'children' =>  CategoryResource::collection($this->whenLoaded('children')),
            'children_without_recursion' =>  CategoryResource::collection($this->whenLoaded('children_without_recursion')),
            'parent' => new CategoryResource($this->whenLoaded('parent')),
            'logotypes' => LogotypeResources::collection($this->whenLoaded('logotypes')),
        ];
    }
}
