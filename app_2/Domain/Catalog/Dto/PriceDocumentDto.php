<?php

namespace Domain\Catalog\Dto;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class PriceDocumentDto extends  DataTransferObject {

    public string $uid;
    public string $name;
    public int $number;
    public int $user_id;
    public ?string $user_name;
    public Carbon $created_at;

}
