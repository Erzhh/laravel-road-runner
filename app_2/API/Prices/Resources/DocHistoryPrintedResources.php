<?php

namespace API\Prices\Resources;

use API\Access\Resources\UserResource;
use API\Catalog\Resources\PriceDocumentResource;
use API\Catalog\Resources\ProductResource;
use App\Domain\Prices\Format\Models\Format;
use Core\Resources\BaseJsonResource;

class DocHistoryPrintedResources extends BaseJsonResource
{
    protected string $type = 'characteristics-value';

    /** @var Format $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'document_uid' => $this->resource->document_uid,
            'history_uid' => $this->resource->history_uid,
            'user_uid' => $this->resource->user_uid,
        ];
    }

    public function getIncluded()
    {
        return [
            'user' => new UserResource($this->whenLoaded('user')),
            'history' => new ProductResource($this->whenLoaded('history')),
            'document' => new PriceDocumentResource($this->whenLoaded('document')),
        ];
    }
}
