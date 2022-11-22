<?php

namespace API\Catalog\Collections;

use API\Catalog\Resources\ProductResource;
use Core\Resources\BasePaginatedResourceCollection;

class ProductCollection extends BasePaginatedResourceCollection
{
    public $collects = ProductResource::class;
}
