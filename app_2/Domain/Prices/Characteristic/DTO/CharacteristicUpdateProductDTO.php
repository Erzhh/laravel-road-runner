<?php

namespace App\Domain\Prices\Characteristic\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CharacteristicUpdateProductDTO extends DataTransferObject {

    public ?bool    $is_visible = true;
    public ?bool    $is_view_text = false;
    public ?int      $characteristic_id;
    public ?string   $product_uid;
    public ?int      $characteristic_value_id;
    public ?int     $order = 7;

    public function toArray(): array
    {
        return [
            'is_visible'=>$this->is_visible??false,
            'is_view_text'=>$this->is_view_text??false,
            'characteristic_id'=>$this->characteristic_id,
            'product_uid'=>$this->product_uid,
            'characteristic_value_id'=>$this->characteristic_value_id,
            'order'=>$this->order??7,
        ];
    }

}
