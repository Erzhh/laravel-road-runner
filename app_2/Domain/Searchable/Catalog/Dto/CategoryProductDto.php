<?php

namespace Domain\Searchable\Catalog\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class  CategoryProductDto extends  DataTransferObject {

    public array $categories;
    public ?string $search;

}
