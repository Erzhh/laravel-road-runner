<?php

namespace API\Settings\Resources;

use Core\Resources\BasePaginatedResourceCollection;

class ErrorPaginateResource extends BasePaginatedResourceCollection
{
    public $collects = ErrorResource::class;
}
