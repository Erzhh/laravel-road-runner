<?php

namespace API\Catalog\Resources;

use API\Prices\Resources\DocumentPrintedResources;
use App\Support\Helpers\ServiceHelper;
use Core\Resources\BaseJsonResource;
use Domain\Catalog\Models\PriceDocument;


class PriceDocumentResource extends BaseJsonResource
{
    protected string $type = 'price-document';

    /** @var PriceDocument $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'uid' => $this->resource->uid,
            'number' => $this->resource->number,
            'title' => $this->resource->name,
            'author' => $this->resource->user_name,
            'created_at' => $this->resource->created_at,
        ];
    }

    public function geRelationships()
    {
        return [
            'user' => ServiceHelper::gatewayApi().'v1/user/'.$this->resource->user_id,
            'price_history' => ServiceHelper::imsApi()."v1/catalog/price-history/".$this->resource->id
        ];
    }

    public function getIncluded()
    {
        return [
            'histories' => PriceHistoryResource::collection($this->whenLoaded('histories')),
            'print' =>      new DocumentPrintedResources($this->whenLoaded('print')),
        ];
    }

    public function getLinks()
    {
        return [
            'self'=> ServiceHelper::gatewayApi().'v1/price_document/'.$this->resource->id
        ];
    }

}
