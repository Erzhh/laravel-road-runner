<?php

namespace API\Prices\Resources;

use App\Domain\Prices\Format\Models\Format;
use Core\Resources\BaseJsonResource;

class FormatResources extends BaseJsonResource
{
    protected string $type = 'formats';

    /** @var Format $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'title' => $this->resource->title,
            'alias' => $this->resource->alias,
        ];
    }
}
