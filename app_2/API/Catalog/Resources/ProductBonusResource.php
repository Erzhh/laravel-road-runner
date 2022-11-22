<?php

namespace API\Catalog\Resources;

use Core\Resources\BaseJsonResource;
use Domain\Catalog\Models\PriceDocument;


class ProductBonusResource extends BaseJsonResource
{
    protected string $type = 'product_bonus';

    /** @var PriceDocument $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'bonus' => $this->resource->bonus,
        ];
    }

}
