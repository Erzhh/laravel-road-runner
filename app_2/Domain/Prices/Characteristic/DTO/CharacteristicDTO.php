<?php

namespace App\Domain\Prices\Characteristic\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CharacteristicDTO extends DataTransferObject {

    public string   $property;
    public int      $maket_id;

}
