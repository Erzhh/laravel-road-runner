<?php

namespace API\Catalog\Resources;

use API\Prices\Resources\CharacteristicProductResources;
use API\Prices\Resources\DocumentPrintedResources;
use API\Prices\Resources\FormatResources;
use App\Domain\Prices\Printed\Models\PriceHistoryPrinted;
use Core\Resources\BaseFildsJsonResource;
use Domain\Catalog\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends BaseFildsJsonResource
{
    protected string $type = 'products';

    function getModel(): Model{
        return  new Product();
    }

    public function getIncluded()
    {
        return [
            'detail' => new ProductDetailResource($this->whenLoaded('detail')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'formats' => FormatResources::collection($this->whenLoaded('formats')),
            'price_history' => new PriceHistoryResource($this->whenLoaded('price_history')),
            'price' => new PriceResource($this->whenLoaded('price')),
            'bonus' => new ProductBonusResource($this->whenLoaded('bonus')),
            'print' => new DocumentPrintedResources($this->whenLoaded('print')),
            'characteristic_product' => CharacteristicProductResources::collection($this->whenLoaded('characteristic_product')),
        ];
    }
}
