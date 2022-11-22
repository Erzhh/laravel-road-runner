<?php

namespace App\Domain\Prices\Characteristic\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CharacteristicValueUpdateDTO extends DataTransferObject {

    public string  $title;
    public int     $characteristic_id;

    public function toArray():array
    {
        return [
            'title' => $this->title,
            'characteristic_id' => $this->characteristic_id,
        ];
    }
}
