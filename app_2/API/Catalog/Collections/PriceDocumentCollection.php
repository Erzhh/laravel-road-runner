<?php

namespace API\Catalog\Collections;

use Core\Resources\BasePaginatedResourceCollection;
use API\Catalog\Resources\PriceDocumentResource;

class PriceDocumentCollection extends BasePaginatedResourceCollection
{
    public $collects = PriceDocumentResource::class;
}
