<?php

namespace Domain\Catalog\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class ProductDetailDto extends  DataTransferObject {

    public ?string $product_id;
    public string $product_uid;
    public ?string $name_kz;
    public string $name_ru;
    public ?string $description;
    public ?string $article;

}
