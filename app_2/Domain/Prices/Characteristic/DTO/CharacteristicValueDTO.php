<?php

namespace App\Domain\Prices\Characteristic\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CharacteristicValueDTO extends DataTransferObject {

    public array  $titles;
    public int    $characteristic_id;

    public function toArray():array
    {
        $array  = [];
        foreach ($this->titles as $title){
            $array[] = [
                'title' => $title,
                'characteristic_id' => $this->characteristic_id
            ];
        }
        return $array;
    }
}
