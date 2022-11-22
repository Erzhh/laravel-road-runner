<?php

namespace API\Catalog\Resources;

use Core\Resources\BaseJsonResource;
use Domain\Catalog\Models\Product;

class ProductDetailResource extends BaseJsonResource
{
    protected string $type = 'product-details';

    /** @var Product $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'product_id' => $this->resource->product_id,
            'product_uid' => $this->resource->product_uid,
            'name_kz' => $this->resource->name_kz,
            'name_ru' => $this->resource->name_ru,
            'article' => $this->resource->article,
            'description' => $this->resource->description,
        ];
    }

}
