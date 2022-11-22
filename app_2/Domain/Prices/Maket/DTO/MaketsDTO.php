<?php

namespace App\Domain\Prices\Maket\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class MaketsDTO extends DataTransferObject {

    public string $title;
    public string $image;
    public array|string $obj_property;
    public array|string $obj_value;

}
