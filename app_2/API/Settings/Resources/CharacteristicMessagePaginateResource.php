<?php

namespace API\Settings\Resources;

use Core\Resources\BasePaginatedResourceCollection;

class CharacteristicMessagePaginateResource extends BasePaginatedResourceCollection
{
    public $collects = CharacteristicMessageResource::class;
}
