<?php

namespace App\Domain\Settings\CharMsg\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CharacteristicMessageDTO extends DataTransferObject {

    public string $product;
    public string $user;
    public bool $status = false;
    public array $characteristics;

    public function toArray(): array
    {
        return [
            'product_uid' => $this->product,
            'user_name' => $this->user,
            'is_view' => $this->status,
            'data' => $this->toString( $this->characteristics ),
        ];
    }

    private function toString(array $data){
        return collect($data)->toBase();
    }

}
