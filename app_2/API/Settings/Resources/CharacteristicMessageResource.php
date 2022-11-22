<?php

namespace API\Settings\Resources;

use API\Access\Resources\UserResource;
use API\Catalog\Resources\ProductResource;
use App\Domain\Settings\CharMsg\Models\CharacteristicMessage;
use Core\Resources\BaseFildsJsonResource;
use Illuminate\Database\Eloquent\Model;

class CharacteristicMessageResource extends BaseFildsJsonResource
{
    protected string $type = 'characteristic-message';

    function getModel(): Model{
        return  new CharacteristicMessage();
    }

    function getAttributes()
    {
        return [
            "user_name" => $this->user_name,
            "product_uid" => $this->product_uid,
            "is_view" => $this->is_view,
            "data" => json_decode( $this->data ),
            "created_at" =>  $this->created_at
        ];
    }

    public function getIncluded()
    {
        return [
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }

}
