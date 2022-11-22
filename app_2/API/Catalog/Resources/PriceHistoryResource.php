<?php

namespace API\Catalog\Resources;

use App\Support\Helpers\ServiceHelper;
use Core\Resources\BaseJsonResource;
use Domain\Catalog\Models\PriceDocument;


class PriceHistoryResource extends BaseJsonResource
{
    protected string $type = 'price-history';

    /** @var PriceDocument $resource */
    public $resource;

    public function getAttributes()
    {
        return [
            'doc_id' => $this->resource->doc_id,
            'product_id' => $this->resource->product_id,
            'price_old' => $this->resource->price_old,
            'price_new' => $this->resource->price_new,
        ];
    }

    public function geRelationships()
    {
        return [
            'product' => ServiceHelper::gatewayApi().'v1/catalog/products/'.$this->resource->product_id,
            'price_document' => ServiceHelper::gatewayApi().'v1/catalog/price-document/'.$this->resource->doc_id,
        ];
    }

    public function getIncluded()
    {
       return [
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }

    public function getLinks()
    {
        return [
            'self'=> ServiceHelper::gatewayApi().'v1/price_document/'.$this->resource->doc_id.'/price_history'.$this->resource->id
        ];
    }

}
