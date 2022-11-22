<?php

namespace App\Domain\Prices\Format\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class FormatDTO extends DataTransferObject {

    public string $title;
    public string $alias;

}
