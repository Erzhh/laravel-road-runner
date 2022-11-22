<?php

namespace API\Prices\Resources;

use API\Catalog\Resources\ProductResource;
use App\Domain\Prices\Characteristic\Models\CharacteristicsProduct;
use Core\Resources\BaseFildsJsonResource;
use Illuminate\Database\Eloquent\Model;

class CharacteristicProductResources extends BaseFildsJsonResource
{
    protected string $type = 'characteristics-products';
    function getModel(): Model{
        return  new CharacteristicsProduct();
    }

    public function getIncluded()
    {
        return [
            'product' => new ProductResource($this->whenLoaded('product')),
            'characteristic' => new CharacteristicResources($this->whenLoaded('characteristic')),
            'value' => new CharacteristicValueResources($this->whenLoaded('value')),
        ];
    }

}
