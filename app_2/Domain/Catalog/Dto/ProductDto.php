<?php

namespace Domain\Catalog\Dto;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class ProductDto extends  DataTransferObject {

    public string $uid;
    public ?int $category_id;
    public string $full_name;
    public string $name;
    public string $code;
    public bool $status;

}
