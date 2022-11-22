<?php

namespace API\Prices\Resources;

use API\Access\Resources\UserResource;
use API\Catalog\Resources\PriceDocumentResource;
use App\Domain\Prices\Format\Models\Format;
use Core\Resources\BaseJsonResource;

class DocumentPrintedResources extends BaseJsonResource
{
    protected string $type = 'price_history_printed';

    /** @var Format $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'price_document_uid' => $this->resource->price_document_uid,
            'user_uid' => $this->resource->user_uid,
        ];
    }

    public function getIncluded()
    {
        return [
            'user' => new UserResource($this->whenLoaded('user')),
            'document' => new PriceDocumentResource($this->whenLoaded('document')),
        ];
    }
}
